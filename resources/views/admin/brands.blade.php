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
                <img class="product-image" src="{{ url('uploads/brand1.jpg') }}">
                <div class="col-sm-12">Brand {{ $i }} title here title here title here title here title here title here title here</div>
                <div class="col-sm-12 text-right">
                    <button class="btn btn-sm btn-primary">Edit <i class="glyphicon glyphicon-edit"></i></button>
                    <button class="btn btn-sm btn-danger">Delete <i class="glyphicon glyphicon-remove"></i></button>
                </div>
            </div>
        @endfor
    </div>

    <a href="#" class="fixed-fab"><i class="glyphicon glyphicon-plus-sign"></i></a>
@endsection