<div class="modal fade" id="updateAccountModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="updateAccount">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ $id ? 'Edit Profile' : 'User Registration' }}</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('/admin/edit-profile') }}" class="form-horizontal row">
                    <div class="col-md-offset-1 col-md-10">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') ?: $email }}">
                                {!! $errors->first('email', "<p class='help-block'>:message</p>") !!}
                            </div>
                        </div>

                        <hr/>
                        <div class="form-group {{ $errors->has('firstName') || $errors->has('lastName') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="firstName" placeholder="First Name" value="{{ old('firstName') ?: $firstName }}">
                                {!! $errors->first('firstName', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="lastName" placeholder="Last Name" value="{{ old('lastName') ?: $lastName }}">
                                {!! $errors->first('lastName', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('contactNumber') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Contact #</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" name="contactNumber" placeholder="Active contact number of admin" value="{{ old('contactNumber') ?: $contactNumber }}">
                            </div>
                            {!! $errors->first('contactNumber', '<p class="help-block col-sm-offset-2 col-sm-10">:message</p>') !!}
                        </div>

                        <hr/>
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button class="btn btn-sm btn-primary btn-block" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>