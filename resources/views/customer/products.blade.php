@extends('layout.main')
@section('content')
    <form class="navbar-form" role="search" style="margin-top: 0;">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="key" id="srch-term">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
    </form>

    <div class="text-center">
        @for($i = 0; $i <= 100; $i++)
            <div class="product-item">
                <img class="product-image" src="{{ url('uploads/product'.($i % 2 == 0 ? '1' : '2').'.jpg') }}">
                <div class="col-sm-12">Product {{ $i }} title here title here title here title here title here title here title here</div>
                <div class="price col-sm-12 text-right">₱ {{ number_format(1000000) }}</div>
                <div class="col-sm-12 text-right">
                    <button class="btn btn-sm btn-info">Add to cart <i class="glyphicon glyphicon-shopping-cart"></i></button>
                </div>
            </div>
        @endfor
    </div>
@endsection