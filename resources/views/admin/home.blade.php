@extends('layout.main')
@section('content')
        <div class="col-md-4">
            @include('admin.partial.orderSummary')
        </div>
        @if($numNeedsRestock = \App\Product::getNumNeedsRestock())
            <div class="col-md-4">
                @include('admin.partial.productSummary')
            </div>
        @endif
        <div class="col-md-4">
            @include('admin.partial.userSummary')
        </div>
@endsection