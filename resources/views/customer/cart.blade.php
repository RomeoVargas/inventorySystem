@extends('layout.main')
@section('pageTitle')
    My Cart
@endsection

@section('content')
    <div class="alert alert-info col-md-2">
        <div class="col-md-12"><strong>Items in Cart: </strong></div>
        <div class="col-md-offset-1 col-md-11">{{ number_format($cartItems->count()) }}</div>
        <div class="col-md-12"><strong>Total Price: </strong></div>
        <div class="col-md-offset-1 col-md-11">₱ {{ number_format($totalPrice) }}</div>
        @if($cartItems->count())
            <a href="#" class="btn btn-primary col-md-12" data-toggle="modal" data-target="#checkoutModal">
                Checkout <i class="glyphicon glyphicon-check"></i>
            </a>
        @endif
    </div>
    <div class="col-md-10 text-center">
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
            $id = $product->id;
            $cartId = $cartItem->id;
            $quantity = $cartItem->quantity;
            $urlFrom = 'cart';
            $name = $product->name;
            $image = $product->getImage();
            $price = $product->price;
            $stocks = $product->stocks_left;
            $description = $product->description;
            $madeToOrder = $product->is_made_to_order;
        @endphp
        @include('customer.modal.addToCart')
    @endforeach
    @if($cartItems->count())
        @include('customer.modal.checkout')
    @endif
@endsection

@section('specificCustomJs')
    @if(count($errors) > 0)
        @php($modalId = session()->has('productId') ? 'addToCartModal' . session('productId') : 'checkoutModal')
        <script>
            $(window).load(function(){
                $('#{{$modalId}}').modal('show');
            });
        </script>
    @endif
@endsection