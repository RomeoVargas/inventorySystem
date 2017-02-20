@extends('layout.main')
@section('content')
        <div class="col-md-4">
            @include('admin.partial.orderSummary')
        </div>
        <div class="col-md-4">
            @include('admin.partial.productSummary')
        </div>
        <div class="col-md-4">
            @include('admin.partial.userSummary')
        </div>
@endsection