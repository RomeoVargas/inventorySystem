<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Notification;
use App\Order;
use App\OrderItem;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $allOrders = $user->getOrders();

        $status = $request->get('status');
        $firstDay = new Carbon('first day of this month');
        $lastDay = new Carbon('last day of this month');
        $dateFrom = $request->get('dateFrom', $firstDay->toDateString());
        $dateTo = $request->get('dateTo', $lastDay->toDateString());

        if (strtotime($dateTo) < strtotime($dateFrom)) {
            session()->flash('error', 'End date must be a later date');
            $dateTo = $dateFrom;
        }

        return view('customer.orderList')->with([
            'statuses'  => Order::$statuses,
            'dateFrom'  => $dateFrom,
            'dateTo'    => $dateTo,
            'status'    => $status,
            'allOrders' => $allOrders,
            'orders'    => Order::search($dateFrom, $dateTo, $user->id, $status)
        ]);
    }

    public function checkout(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make(
                $request->all(),
                ['address' => 'required|min:1']
            );
            if ($validator->fails()) {
                return redirect('cart')
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = Auth::user();
            $order = new Order();
            $order->fill([
                'user_id'           => $user->id,
                'status'            => Order::STATUS_NEW,
                'delivery_address'  => $request->get('address')
            ])->save();

            foreach ($user->getCartItems() as $cartItem) {
                $product = $cartItem->getProduct();
                $orderItem = new OrderItem();
                $orderItem->fill([
                    'order_id'      => $order->id,
                    'product_id'    => $product->id,
                    'name'          => $product->name,
                    'price'         => $product->price,
                    'quantity'      => $cartItem->quantity
                ])->save();

                $cartItem->delete();
            }

            $message = array('success' => 'Your order has been successfully submitted');
            $dateToday = Carbon::now()->toDateString();
            $notification = new Notification();
            $notification->fill([
                'type' => Notification::TYPE_NEW_ORDER,
                'content' => $user->getFullName() . ' just placed a new order',
                'link' => sprintf(
                    'order/list?dateFrom=%s&dateTo=%s&status=%s',
                    $dateToday, $dateToday, Order::STATUS_NEW
                )
            ])->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = array(
                'error' => $e->getMessage()
            );
        }

        return redirect('order/list')->with($message);
    }

    public function cancel($refNum)
    {
        DB::beginTransaction();
        try {
            if (!$order = Order::getByReferenceNumber($refNum)) {
                throw new ModelNotFoundException('Order does not exist');
            }

            if ($order->isCancelled()) {
                throw new \InvalidArgumentException('That order is already cancelled');
            }

            if (!$order->isNew()) {
                throw new \InvalidArgumentException('Cannot cancel! That order is already '.Order::$statuses[$order->status]);
            }

            $order->status = Order::STATUS_CANCELLED;
            $order->save();
            $message = array('success' => 'Your order has been successfully cancelled');

            $dateToday = Carbon::now()->toDateString();
            $notification = new Notification();
            $notification->fill([
                'type' => Notification::TYPE_CANCELLED_ORDER,
                'content' => $order->getUser()->getFullName() . ' just cancelled an order',
                'link' => sprintf(
                    'order/list?dateFrom=%s&dateTo=%s&status=%s',
                    $dateToday, $dateToday, Order::STATUS_CANCELLED
                )
            ])->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = array(
                'error' => $e->getMessage()
            );
        }

        return redirect('order/list')->with($message);
    }
}