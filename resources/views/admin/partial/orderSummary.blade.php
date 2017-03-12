@php
    $dateFrom = isset($dateFrom) ? $dateFrom : date('Y-m-d');
    $dateTo = isset($dateTo) ? $dateTo : date('Y-m-d');
    $summary = \App\Order::getSummary($dateFrom, $dateTo);
@endphp

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Orders</h3>
    </div>
    <div class="panel-body">
        <ul class="list-group">
            <li class="list-group-item alert-warning">
                <span class="badge">{{ $summary[\App\Order::STATUS_NEW] }}</span>
                For Review
            </li>
            <li class="list-group-item alert-info">
                <span class="badge">{{ $summary[\App\Order::STATUS_FOR_DELIVER] }}</span>
                Scheduled for Delivery
            </li>
            <li class="list-group-item alert-success">
                <span class="badge">{{ $summary[\App\Order::STATUS_COMPLETED] }}</span>
                Delivered
            </li>
            <li class="list-group-item alert-danger">
                <span class="badge">{{ $summary[\App\Order::STATUS_CANCELLED] }}</span>
                Cancelled
            </li>
            <li class="list-group-item alert-danger">
                <span class="badge">{{ $summary[\App\Order::STATUS_UNPAID] }}</span>
                Unpaid
            </li>
        </ul>
    </div>
</div>