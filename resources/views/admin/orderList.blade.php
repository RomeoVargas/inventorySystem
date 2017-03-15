@extends('layout.main')
@section('content')

    <div class="col-md-12">
        <div class="col-sm-9">
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

                <div class="col-md-12">
                    @if($orders->count())
                        <table class="table table-hover">
                            <thead>
                            <th>Date Ordered</th>
                            <th>Customer</th>
                            <th>Ref #</th>
                            <th>Status</th>
                            <th>Items Ordered</th>
                            <th>Total Price</th>
                            <th>Delivery Date</th>
                            </thead>

                            @foreach($orders as $order)
                                <tr class="{{ $order->getViewClass() }}">
                                    <td>{{ to_time_format($order->created_at, 'F d, Y') }}</td>
                                    <td>{{ $order->getUser()->getFullName() }}</td>
                                    <td><a data-toggle="modal" data-target="#orderDetailsModal{{$order->getReferenceNumber()}}">{{ $order->getReferenceNumber() }}</a></td>
                                    <td>
                                        {{ $statuses[$order->status] }}
                                        @if($order->isForDeliver())
                                            <div class="col-sm-12">
                                                <a data-href="{{ url('admin/order/updatePayment', ['refnum' => $order->getReferenceNumber(), 'isPaid' => 1]) }}"
                                                   data-action="paid" data-toggle="modal" data-item-name="Ref #{{ $order->getReferenceNumber() }}"
                                                   data-target="#confirm-payment" class="btn btn-sm btn-success">
                                                    <i class="glyphicon glyphicon-check"></i> Paid
                                                </a>
                                                <a data-href="{{ url('admin/order/updatePayment', ['refnum' => $order->getReferenceNumber(), 'isPaid' => 0]) }}"
                                                   data-action="unpaid" data-toggle="modal" data-item-name="Ref #{{ $order->getReferenceNumber() }}"
                                                   data-target="#confirm-payment" class="btn btn-sm btn-danger">
                                                    <i class="glyphicon glyphicon-remove"></i> Unpaid
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ number_format($order->getItems()->count()) }}</td>
                                    <td>₱ {{ number_format($order->getTotalPrice()) }}</td>
                                    <td>
                                        @if($order->isNew())
                                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#setDeliveryDateModal{{$order->id}}">
                                                <i class="glyphicon glyphicon-calendar"></i> Set Delivery Date
                                            </a>
                                        @else
                                            {{ to_time_format($order->date_delivered, 'F d, Y') ?: 'N/A' }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div class="alert alert-warning">No results found</div>
                    @endif
                </div>
            @else
                <div class="col-md-offset-1 col-md-10">
                    <div class="alert alert-warning"><strong>There are no orders yet</strong></div>
                </div>
            @endif
        </div>

        <div class="col-md-3">
            @include('admin.partial.orderSummary')
        </div>
    </div>
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
        @include('admin.modal.setDeliveryDate')
        @include('modal.orderDetails')
    @endforeach
@endsection

@section('specificCustomJs')
    @if(count($errors) > 0)
        <script>
            $(window).load(function(){
                $('#setDeliveryDateModal{{ session('orderId') }}').modal('show');
            });
        </script>
    @endif
@endsection