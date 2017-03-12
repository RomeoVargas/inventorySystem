<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}