@if($isAdmin = explode('/', get_route_name())[0] == 'admin')
    @include('admin.header')
@else
    @include('customer.header')
@endif

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSS -->
        <link href="{{ asset('css/bootstrap-theme.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jasny-bootstrap/jasny-bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/customer/main.css') }}" rel="stylesheet">

    </head>
    <body>
        @yield('header')

        <div class="container">
            <h1 style="margin-top: 0;">@yield('pageTitle')</h1>
            @if($error = session('error'))
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>{{ $error }}</strong>
                </div>
            @elseif($success = session('success'))
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>{{ $success }}</strong>
                </div>
            @endif
            @yield('content')
        </div>

        @yield('footer')
        @yield('modal')
        @if(!$isAdmin && !\Illuminate\Support\Facades\Auth::user())
            @include('customer.modal.register')
        @endif
        @include('modal.confirmDelete')

        <!-- JAVASCRIPT -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jasny-bootstrap/jasny-bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>

        @yield('generalCustomJs')
        @yield('specificCustomJs')
    </body>
</html>