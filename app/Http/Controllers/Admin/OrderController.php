<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class OrderController extends BaseController
{
    public function index(Request $request)
    {
        $status = $request->get('status');
        $firstDay = new Carbon('first day of this month');
        $lastDay = new Carbon('last day of this month');
        $dateFrom = $request->get('dateFrom', $firstDay->toDateString());
        $dateTo = $request->get('dateTo', $lastDay->toDateString());

        if (strtotime($dateTo) < strtotime($dateFrom)) {
            session()->flash('error', 'End date must be a later date');
            $dateTo = $dateFrom;
        }

        return view('admin.orderList')->with([
            'statuses'  => Order::$statuses,
            'dateFrom'  => $dateFrom,
            'dateTo'    => $dateTo,
            'status'    => $status,
            'allOrders' => Order::all(),
            'orders'    => Order::search($dateFrom, $dateTo, null, $status)
        ]);
    }

    public function setDeliveryDate(Request $request)
    {
        DB::beginTransaction();
        try {
            $orderId = $request->get('id');
            $dayYesterday = Carbon::yesterday();
            $validator = Validator::make(
                $request->all(),
                ['deliveryDate' => 'required|date|after:'.$dayYesterday->format('F d, Y')]
            );
            if ($validator->fails()) {
                return $this->redirectTo('order/list')
                    ->with(['orderId' => $orderId])
                    ->withErrors($validator)
                    ->withInput();
            }

            if (!$order = Order::find($orderId)) {
                throw new ModelNotFoundException('Order does not exist');
            }

            $order->status = Order::STATUS_FOR_DELIVER;
            $order->date_delivered = to_time_format($request->get('deliveryDate'), 'Y-m-d H:i:s');
            $order->save();
            $message = array('success' => 'Your order has been successfully submitted');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = array(
                'error' => $e->getMessage()
            );
        }

        return $this->redirectTo('order/list')->with($message);
    }

    public function approvePayment($refNum, $isPaid = false)
    {
        DB::beginTransaction();
        try {
            if (!$order = Order::getByReferenceNumber($refNum)) {
                throw new ModelNotFoundException('Order does not exist');
            }
            $newStatus = $isPaid ? Order::STATUS_COMPLETED : Order::STATUS_UNPAID;

            if ($order->isCompleted()) {
                throw new \InvalidArgumentException('That order is already completed');
            }

            if (!$order->isForDeliver()) {
                throw new \InvalidArgumentException('Cannot update status! That order is already '.Order::$statuses[$order->status]);
            }

            $order->status = $newStatus;
            $order->save();

            if ($order->isCompleted()) {
                foreach ($order->getItems() as $orderItem) {
                    $product = $orderItem->getProduct();
                    $product->stocks_left = min(0, $product->stocks_left - $orderItem->quantity);
                    $product->save();
                }
            }
            $message = array('success' => 'Order #'.$order->getReferenceNumber().' has been successfully updated');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = array(
                'error' => $e->getMessage()
            );
        }

        return $this->redirectTo('order/list')->with($message);
    }
}