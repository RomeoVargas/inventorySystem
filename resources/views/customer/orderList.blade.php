@extends('layout.main')
@section('pageTitle')
    My Orders
@endsection

@section('content')
    @if($allOrders->count())
        <form class="navbar-form" role="search" style="margin-top: 0;">
            <div class="input-group">
                <span class="input-group-addon" id="from">From: </span>
                <input type="date" value="{{ $dateFrom }}" class="form-control" name="dateFrom" aria-describedby="from" onchange="submit()">
            </div>
            <div class="input-group">
                <span class="input-group-addon" id="to">To: </span>
                <input type="date" value="{{ $dateTo }}" class="form-control" name="dateTo" aria-describedby="to" onchange="submit()">
            </div>
            <div class="input-group">
                <select name="status" class="form-control" onchange="submit()">
                    @foreach($statuses as $key => $value)
                        <option {{ $key != $status ?: 'selected'  }} value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
        </form>

        <div class="col-md-offset-1 col-md-10 jumbotron">
            <table class="table table-hover">
                <thead>
                <th>Ref #</th>
                <th>Date Ordered</th>
                <th>Status</th>
                <th>Items Ordered</th>
                <th>Total Price</th>
                <th>Delivery Date</th>
                </thead>

                @foreach($orders as $order)
                    <tr class="{{ $order->getViewClass() }}">
                        <td><a data-toggle="modal" data-target="#orderDetailsModal{{$order->getReferenceNumber()}}">{{ $order->getReferenceNumber() }}</a></td>
                        <td>{{ to_time_format($order->created_at, 'F d, Y') }}</td>
                        <td>
                            {{ $statuses[$order->status] }}
                            @if($order->isNew())
                                <a data-href="{{ url('order/cancel', ['refnum' => $order->getReferenceNumber()]) }}" data-action="cancel"
                                   data-toggle="modal" data-item-type="order" data-item-name="Ref #{{ $order->getReferenceNumber() }}"
                                   data-target="#confirm-delete" class="btn btn-sm btn-danger">
                                    <i class="glyphicon glyphicon-remove"></i> Cancel
                                </a>
                            @endif
                        </td>
                        <td>{{ number_format($order->getItems()->count()) }}</td>
                        <td>₱ {{ number_format($order->getTotalPrice()) }}</td>
                        <td>{{ to_time_format($order->date_delivered, 'F d, Y') ?: 'N/A' }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    @else
        <div class="col-md-offset-1 col-md-10">
            <div class="alert alert-warning"><strong>You have not ordered anything yet</strong></div>
        </div>
    @endif
@endsection
@section('modal')
    @foreach($orders as $order)
        @php
            $id = $order->id;
            $refNum = $order->getReferenceNumber();
            $orderItems = $order->getItems();
            $status = \App\Order::$statuses[$order->status];
            $totalPrice = $order->getTotalPrice();
            $address = $order->delivery_address;
            $viewClass = $order->getViewClass();
        @endphp
        @include('modal.orderDetails')
    @endforeach
@endsection