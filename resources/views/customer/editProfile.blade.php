@extends('layout.main')
@section('content')
    <form method="POST" class="form-horizontal row">
        <div class="col-md-offset-1 col-md-10">
            <h1>Edit Profile</h1>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-4">
                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $user->email }}">
                    {!! $errors->first('email', "<p class='help-block'>:message</p>") !!}
                </div>
                <div class="col-sm-4">
                    <a href="#" data-toggle="modal" data-target="#changePassword" class="btn btn-sm btn-info">Change Password</a>
                </div>
            </div>
            <div class="form-group {{ $errors->has('firstName') || $errors->has('lastName') ? 'has-error' : '' }}">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="firstName" placeholder="First Name" value="{{ $user->first_name }}">
                    {!! $errors->first('firstName', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="lastName" placeholder="Last Name" value="{{ $user->last_name }}">
                    {!! $errors->first('lastName', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('contactNumber') ? 'has-error' : '' }}">
                <label class="col-sm-2 control-label">Contact #</label>
                <div class="col-sm-8">
                    <input type="tel" class="form-control" name="contactNumber" placeholder="Can be mobile or landline number" value="{{ $user->contact_number }}">
                </div>
                {!! $errors->first('contactNumber', '<p class="help-block col-sm-offset-2 col-sm-10">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                <label class="col-sm-2 control-label">Address</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="address" placeholder="Company address, if account is affiliated to a company" value="{{ $user->address }}">
                </div>
                {!! $errors->first('address', '<p class="help-block col-sm-offset-2 col-sm-10">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">
                <label class="col-sm-2 control-label">Company</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="company" placeholder="Leave this blank if account is for personal use" value="{{ $user->company }}">
                </div>
                {!! $errors->first('company', '<p class="help-block col-sm-offset-2 col-sm-10">:message</p>') !!}
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8 text-center">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Save Changes</button>
                </div>
            </div>
        </div>
    </form>
@endsection