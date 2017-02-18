@include('customer.modal.login')
@section('header')
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand">CHECON INDUSTRIES</div>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            @php($routeName = get_route_name())
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="{{ trim($routeName, '/') == 'home' ? 'active' : '' }}">
                        <a class="navbar-item" href="{{ url('home') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="{{ trim($routeName, '/') == 'products' ? 'active' : '' }}">
                        <a class="navbar-item" href="#">Products</a>
                    </li>
                    <li class="{{ trim($routeName, '/') == 'about-us' ? 'active' : '' }}">
                        <a class="navbar-item" href="{{ url('about-us') }}">About Us</a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" data-toggle="popover" data-content='@yield("login")'>Login</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#registerModal">Register</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
@endsection

@section('modal')
    @include('customer.modal.register')
@endsection

@section('customJs')
    @if(session('loginError'))
        <script>
            $(document).ready(function() {
                $('[data-toggle="popover"]').popover('show');
            });
        </script>
    @endif
@endsection