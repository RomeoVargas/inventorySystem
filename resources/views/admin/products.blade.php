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
                    <div class="product-item {{ $product->isNeedsRestock() ? 'needs-restock' : '' }}">
                        <div class="col-sm-12">
                            <a href="#" data-toggle="modal" data-target="#addProductModal{{$product->id}}">
                                {{ $product->name }}
                            </a>
                        </div>
                        <img class="product-image" src="{{ $product->getImage() }}">
                        <div class="price col-sm-12 text-right">₱ {{ number_format($product->price) }}</div>
                        <div class="price col-sm-12 text-right">{{ number_format($product->stocks_left) }} in stock</div>
                        <div class="col-sm-12">{{ $product->description }}</div>
                        <div class="col-sm-12 text-right">
                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addProductModal{{$product->id}}">
                                <i class="glyphicon glyphicon-edit"></i> Edit
                            </a>
                            <a data-href="{{ url('admin/products/delete', ['id' => $product->id]) }}"
                               data-toggle="modal" data-item-type="product" data-item-name="{{ $product->name }}"
                               data-target="#confirm-delete" class="btn btn-sm btn-danger">
                                <i class="glyphicon glyphicon-remove"></i> Delete
                            </a>
                        </div>
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

    <a href="#" class="fixed-fab" data-toggle="modal" data-target="#addProductModal"><i class="glyphicon glyphicon-plus-sign"></i></a>
@endsection

@section('modal')
    @php
        $id = null;
        $name = null;
        $image = null;
        $price = null;
        $isMadeToOrder = false;
        $stocks = 0;
        $description = null;
    @endphp
    @include('admin.modal.addProduct')
    @foreach($products as $product)
        @php
            $id = $product->id;
            $name = $product->name;
            $image = $product->getImage();
            $price = $product->price;
            $isMadeToOrder = (bool) $product->is_made_to_order;
            $stocks = $product->stocks_left;
            $description = $product->description;
        @endphp
        @include('admin.modal.addProduct')
    @endforeach
@endsection

@section('specificCustomJs')
    @if(count($errors) > 0)
        <script>
            $(window).load(function(){
                $('#addProductModal{{ session('productId') }}').modal('show');
            });
        </script>
    @endif
@endsection