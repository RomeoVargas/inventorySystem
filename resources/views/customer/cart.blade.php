@extends('layout.main')
@section('pageTitle')
    My Cart
@endsection

@section('content')
    <div class="col-md-12">
        <div class="alert alert-info col-md-12">
            <div class="col-md-offset-2 col-md-3"><strong>Total item(s) in Cart:</strong> {{ number_format($cartItems->count()) }}</div>
            <div class="col-md-offset-2 col-md-3"><strong>Total Price:</strong> ₱ {{ number_format($totalPrice) }}</div>
        </div>
    </div>
    <div class="text-center">
        @foreach($cartItems as $cartItem)
            @php($product = $cartItem->getProduct())
            <div class="product-item">
                <img class="product-image" src="{{ $product->getImage() }}">
                <div class="col-sm-12">{{ $product->name }}</div>
                <div class="price col-sm-12 text-right">₱ {{ number_format($product->price) }}</div>
                <div class="price col-sm-12 text-right">
                    x {{ number_format($cartItem->quantity) }}
                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addToCartModal{{$product->id}}">
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>
                    <a data-href="{{ url('cart/delete', ['id' => $product->id]) }}"
                       data-toggle="modal" data-item-type="cart item" data-item-name="{{ $product->name }}"
                       data-target="#confirm-delete" class="btn btn-sm btn-danger">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('modal')
    @foreach($cartItems as $cartItem)
        @php
            $product = $cartItem->getProduct();
            $cartId = $cartItem->id;
            $quantity = $cartItem->quantity;
            $id = $product->id;
            $name = $product->name;
            $image = $product->getImage();
            $price = $product->price;
            $stocks = $product->stocks_left;
            $description = $product->description;
        @endphp
        @include('customer.modal.addToCart')
    @endforeach
@endsection

@section('specificCustomJs')
    @if(count($errors) > 0)
        <script>
            $(window).load(function(){
                $('#addToCartModal{{ session('productId') }}').modal('show');
            });
        </script>
    @endif
@endsection