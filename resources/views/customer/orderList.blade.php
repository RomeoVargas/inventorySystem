@extends('layout.main')
@section('content')
    <form class="navbar-form" role="search" style="margin-top: 0;">
        <div class="input-group">
            <span class="input-group-addon" id="from">From: </span>
            <input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="dateFrom" aria-describedby="from">
        </div>
        <div class="input-group">
            <span class="input-group-addon" id="to">To: </span>
            <input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="dateTo" aria-describedby="to">
        </div>
        <div class="input-group">
            <select name="status" class="form-control">
                <option>All Orders</option>
                <option>Scheduled For Delivery</option>
                <option>Pending</option>
                <option>Delivered</option>
                <option>Cancelled</option>
            </select>
        </div>
    </form>

    <div class="col-md-offset-1 col-md-10 jumbotron">
        <table class="table table-hover">
            <thead>
                <th>Reference #</th>
                <th>Items Ordered</th>
                <th>Status</th>
                <th>Date Created</th>
                <th>Date Last Updated</th>
            </thead>
            <tr class="info">
                <td>{{ md5(rand()) }}</td>
                <td>{{ rand(1, 100) }}</td>
                <td>Scheduled For Delivery</td>
                <td>{{ date('F d, Y') }}</td>
                <td>{{ date('F d, Y') }}</td>
            </tr>
            <tr class="warning">
                <td>{{ md5(rand()) }}</td>
                <td>{{ rand(1, 100) }}</td>
                <td>Pending</td>
                <td>{{ date('F d, Y') }}</td>
                <td>{{ date('F d, Y') }}</td>
            </tr>
            <tr class="success">
                <td>{{ md5(rand()) }}</td>
                <td>{{ rand(1, 100) }}</td>
                <td>Delivered</td>
                <td>{{ date('F d, Y') }}</td>
                <td>{{ date('F d, Y') }}</td>
            </tr>
            <tr class="danger">
                <td>{{ md5(rand()) }}</td>
                <td>{{ rand(1, 100) }}</td>
                <td>Cancelled</td>
                <td>{{ date('F d, Y') }}</td>
                <td>{{ date('F d, Y') }}</td>
            </tr>
        </table>
    </div>
@endsection