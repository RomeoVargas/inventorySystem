@extends('layout.main')
@section('content')
    <div class="col-md-12">
        <h1>My Cart</h1>
        <div class="alert alert-info col-md-12">
            <div class="col-md-offset-2 col-md-3"><strong>Total item(s) in Cart:</strong> 42</div>
            <div class="col-md-offset-2 col-md-3"><strong>Total Price:</strong> ₱ {{ number_format(rand(1000000, 99999999)) }}</div>
        </div>
    </div>
    <div class="text-center">
        @for($i = 0; $i <= 10; $i++)
            <div class="product-item">
                <img class="product-image" src="{{ url('uploads/product'.($i % 2 == 0 ? '1' : '2').'.jpg') }}">
                <div class="col-sm-12">Product {{ $i }} title here title here title here title here title here title here title here</div>
                <div class="price col-sm-12 text-right">₱ {{ number_format(1000000) }}</div>
                <div class="price col-sm-12 text-right">
                    x {{ rand(1, 5) }}
                    <a href="#" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus-sign"></i></a>
                    <a href="#" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-minus-sign"></i></a>
                </div>
            </div>
        @endfor
    </div>
@endsection