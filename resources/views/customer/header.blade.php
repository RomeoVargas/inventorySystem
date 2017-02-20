@include('customer.partial.login')
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
                        <a class="navbar-item" href="{{ url('products') }}">Products</a>
                    </li>
                    <li class="{{ trim($routeName, '/') == 'about-us' ? 'active' : '' }}">
                        <a class="navbar-item" href="{{ url('about-us') }}">About Us</a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                @if($user = \Illuminate\Support\Facades\Auth::user())
                    <li class="dropdown">
                        <a href="#" class="welcome-note dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Hi {{ $user->first_name }}! How may i help you? <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="glyphicon glyphicon-shopping-cart"></i> View my Cart <span class="badge">42</span></a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-list-alt"></i> View my Orders</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-user"></i> Update Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="#" data-toggle="popover" data-content='@yield("login")'>Login</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#registerModal">Register</a></li>
                @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
@endsection

@section('modal')
    @include('customer.modal.register')
@endsection

@section('generalCustomJs')
    @if(session('loginError'))
        <script>
            $(document).ready(function() {
                $('[data-toggle="popover"]').popover('show');
            });
        </script>
    @endif
@endsection