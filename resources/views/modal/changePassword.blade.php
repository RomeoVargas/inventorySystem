@php
    $urlFrom = explode('/', get_route_name());
    $formUrl = '/change-password';
    if ($urlFrom[0] == 'admin') {
        $formUrl = '/admin'.$formUrl;
        unset($urlFrom[0]);
    }
    $urlFrom = implode('/', $urlFrom);
@endphp
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="Login">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url($formUrl) }}" class="form-horizontal row">
                    <div class="col-md-offset-1 col-md-10">
                        <div class="form-group {{ $errors->has('oldPassword') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Old Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="oldPassword" placeholder="Old Password" value="{{ old('oldPassword') }}">
                                {!! $errors->first('oldPassword', "<p class='help-block'>:message</p>") !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('password') || $errors->has('confirmPassword') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">New Password</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="password" placeholder="Password" value="{{ old('password') }}">
                            </div>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password" value="{{ old('confirmPassword') }}">
                            </div>
                            {!! $errors->first('password', '<p class="help-block col-sm-offset-2 col-sm-10">:message</p>') !!}
                            {!! $errors->first('confirmPassword', '<p class="help-block col-sm-offset-2 col-sm-10">:message</p>') !!}
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="urlFrom" value="{{ $urlFrom }}">
                                <button class="btn btn-sm btn-primary btn-block" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>