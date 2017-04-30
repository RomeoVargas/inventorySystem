@extends('layout.main')
@section('content')
    @if($numTotalProducts)
        <form class="navbar-form" role="search" style="margin-top: 0;">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="key" id="srch-term" value="{{ $key }}">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </form>

        <div class="text-center">
            @if($products->count())
                @foreach($products as $product)
                    <div class="product-item">
                        <div class="col-sm-12">{{ $product->name }}</div>
                        <img class="product-image" src="{{ $product->getImage() }}">
                        @if($user = \Illuminate\Support\Facades\Auth::user())
                            <div class="price col-sm-12 text-right">₱ {{ number_format($product->price) }}</div>
                            <div class="price col-sm-12 text-right">
                                @if(!$product->is_made_to_order)
                                    {{ number_format($product->stocks_left) }} in stock
                                @else
                                    Made to order
                                @endif
                            </div>
                        @endif
                        <div class="col-sm-12">{{ $product->description }}</div>
                        @if($user)
                            <div class="col-sm-12 text-right">
                                <a data-toggle="modal" data-target="#addToCartModal{{$product->id}}" class="btn btn-sm btn-info">
                                    Add to cart <i class="glyphicon glyphicon-shopping-cart"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="col-sm-offset-1 col-sm-10 alert alert-warning">
                    No results found.
                </div>
            @endif
        </div>
    @else
        <div class="col-md-offset-1 col-md-10">
            <div class="alert alert-warning">
                <strong>There are no products added yet</strong>
            </div>
        </div>
    @endif
@endsection

@section('modal')
    @foreach($products as $product)
        @php
            $id = $product->id;
            $cartId = isset($cartItems[$id]) ? $cartItems[$id]->id : null;
            $quantity = isset($cartItems[$id]) ? $cartItems[$id]->quantity : null;
            $urlFrom = 'products';
            $name = $product->name;
            $image = $product->getImage();
            $price = $product->price;
            $stocks = $product->stocks_left;
            $description = $product->description;
            $madeToOrder = $product->is_made_to_order;
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