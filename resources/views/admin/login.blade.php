@extends('layout.main')
@section('content')
    <form method="POST" action="{{ url('/admin/login') }}" class="col-md-offset-3 col-md-6 admin-login">
        <div class="col-md-offset-3 col-md-6">
            <img src="{{ asset('img/logo.jpg') }}" style="width: 100%;">
        </div>
        <div class="col-md-12 admin-loginRow">
            <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
        </div>
        <div class="col-md-12 admin-loginRow">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <div class="col-md-12 admin-loginRow">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </div>
    </form>
@endsection
@section('header')
@endsection