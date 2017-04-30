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
                    <li class="{{ trim($routeName, '/') == 'admin/order/list' ? 'active' : '' }}">
                        <a class="navbar-item" href="{{ url('admin/order/list') }}">Orders</a>
                    </li>
                    <li class="{{ trim($routeName, '/') == 'admin/products' ? 'active' : '' }}">
                        <a class="navbar-item" href="{{ url('admin/products') }}">Products</a>
                    </li>
                    <li class="dropdown">
                        @php
                            $notifications = \App\Notification::getAllUnread();
                            $numNeedsRestock = \App\Product::getNumNeedsRestock();
                            $totalNumNotifs = $notifications->count() + $numNeedsRestock;
                        @endphp
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Notifications
                            <span class="badge">{{ $totalNumNotifs }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            @if($totalNumNotifs)
                                @foreach($notifications as $notification)
                                    <li><a href="{{ url('admin/'.$notification->link) }}">{{ $notification->content }}</a></li>
                                @endforeach
                                @if($numNeedsRestock)
                                        <li>
                                            <a href="{{ url('admin/products') }}">
                                                <span class="badge">{{ $numNeedsRestock }}</span>
                                                Needs Re-stock
                                            </a>
                                        </li>
                                @endif
                            @else
                                <li><a href="#">There are no notifications</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="welcome-note dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Admin Settings <span class="glyphicon glyphicon-cog"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('admin/accounts') }}"><i class="glyphicon glyphicon-log-in"></i> Manage Accounts</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#changePassword"><i class="glyphicon glyphicon-lock"></i> Change Password</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ url('admin/logout') }}"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
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