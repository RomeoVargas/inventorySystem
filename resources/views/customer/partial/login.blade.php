@section('login')
    <form method="POST" action="{{ url('/login') }}" class="loginContainer" onsubmit="validateModalSubmit(event, this)">
        @if($error = session('loginError'))
            <div class="loginRow">
                <div class="has-error alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>{{ $error }}</strong>
                </div>
            </div>
        @endif
        <div class="loginRow">
            <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
        </div>
        <div class="loginRow">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <div class="loginRow">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="btn btn-sm btn-primary btn-block" type="submit">Sign in</button>
        </div>
    </form>
@endsection