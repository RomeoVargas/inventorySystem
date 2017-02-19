@extends('layout.customer.main')
@section('content')
    <div class="text-center">
        @for($i = 0; $i <= 100; $i++)
            <div class="product-item">
                <img class="product-image" src="uploads/product{{ $i % 2 == 0 ? '1' : '2' }}.jpg">
                <div class="col-sm-12">Product {{ $i }} title here</div>
                <div class="col-sm-offset-1 col-sm-11">₱ {{ number_format(1000) }}</div>
            </div>
        @endfor
    </div>
@endsection