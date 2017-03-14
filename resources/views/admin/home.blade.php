@extends('layout.main')
@section('pageTitle')
    Summary report for {{ date('F d, Y') }}
@endsection

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