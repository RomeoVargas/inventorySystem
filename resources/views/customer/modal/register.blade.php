<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="Login">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">User Registration</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('/register') }}" class="form-horizontal row">
                    <div class="col-md-offset-1 col-md-10">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                                {!! $errors->first('email', "<p class='help-block'>:message</p>") !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('password') || $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="password" placeholder="Password" value="{{ old('password') }}">
                            </div>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" value="{{ old('password_confirmation') }}">
                            </div>
                            {!! $errors->first('password', '<p class="help-block col-sm-offset-2 col-sm-10">:message</p>') !!}
                            {!! $errors->first('password_confirmation', '<p class="help-block col-sm-offset-2 col-sm-10">:message</p>') !!}
                        </div>

                        <hr/>
                        <div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Company</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="company" placeholder="Leave this blank if account is for personal use" value="{{ old('company') }}">
                            </div>
                            {!! $errors->first('company', '<p class="help-block col-sm-offset-2 col-sm-10">:message</p>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('firstName') || $errors->has('lastName') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="firstName" placeholder="First Name" value="{{ old('firstName') }}">
                                {!! $errors->first('firstName', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="lastName" placeholder="Last Name" value="{{ old('lastName') }}">
                                {!! $errors->first('lastName', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('contactNumber') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Contact #</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" name="contactNumber" placeholder="Can be mobile or landline number" value="{{ old('contactNumber') }}">
                            </div>
                            {!! $errors->first('contactNumber', '<p class="help-block col-sm-offset-2 col-sm-10">:message</p>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="address" placeholder="Company address, if account is affiliated to a company" value="{{ old('address') }}">
                            </div>
                            {!! $errors->first('address', '<p class="help-block col-sm-offset-2 col-sm-10">:message</p>') !!}
                        </div>

                        <hr/>
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-sm btn-primary btn-block" type="submit">Register</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('specificCustomJs')
    @if(count($errors) > 0)
        <script>
            $(window).load(function(){
                $('#registerModal').modal('show');
            });
        </script>
    @endif
@endsection