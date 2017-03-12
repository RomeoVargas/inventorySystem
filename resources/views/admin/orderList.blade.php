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
                            <th>Customer</th>
                            <th>Ref #</th>
                            <th>Date Ordered</th>
                            <th>Status</th>
                            <th>Items Ordered</th>
                            <th>Total Price</th>
                            <th>Delivery Date</th>
                            </thead>

                            @foreach($orders as $order)
                                <tr class="{{ $order->getViewClass() }}">
                                    <td>{{ $order->getUser()->getFullName() }}</td>
                                    <td>{{ $order->getReferenceNumber() }}</td>
                                    <td>{{ to_time_format($order->created_at, 'F d, Y') }}</td>
                                    <td>
                                        {{ $statuses[$order->status] }}
                                        @if($order->isNew())
                                            <a href="#" class="btn btn-sm btn-primary">
                                                <i class="glyphicon glyphicon-send"></i> Deliver
                                            </a>
                                        @elseif($order->isForDeliver())
                                            <div class="col-sm-12">
                                                <a href="#" class="btn btn-sm btn-success">
                                                    <i class="glyphicon glyphicon-check"></i> Paid
                                                </a>
                                                <a href="#" class="btn btn-sm btn-danger">
                                                    <i class="glyphicon glyphicon-remove"></i> Unpaid
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ number_format($order->getItems()->count()) }}</td>
                                    <td>₱ {{ number_format($order->getTotalPrice()) }}</td>
                                    <td>{{ to_time_format($order->date_delivered, 'F d, Y') ?: 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div class="alert alert-warning">No results found</div>
                    @endif
                </div>
            @else
                <div class="col-md-offset-1 col-md-10">
                    <div class="alert alert-warning">You have not ordered anything yet</div>
                </div>
            @endif
        </div>

        <div class="col-md-3">
            @include('admin.partial.orderSummary')
        </div>
    </div>
@endsection