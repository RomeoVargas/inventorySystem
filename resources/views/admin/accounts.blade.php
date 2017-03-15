@extends('layout.main')
@section('content')
    @php($user = \App\Services\Session::get('admin'))
    <div class="col-md-12">
        <div class="col-sm-9">
            <div class="col-md-12 jumbotron">
                <table class="table table-hover">
                    <thead>
                        <th>Full Name</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>Date Last Logged In</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <td>{{ $user->first_name . ' ' .$user->last_name }}</td>
                        <td>{{ $user->contact_number }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ date('F d, Y') }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary"
                               data-toggle="modal" data-target="#updateAccountModal{{$user->id}}">
                                <i class="glyphicon glyphicon-edit"></i>
                                My Profile
                            </a>
                        </td>
                    </tbody>
                    {{--<tbody>--}}
                        {{--<td>{{ $user->first_name . ' ' .$user->last_name .' 2' }}</td>--}}
                        {{--<td>{{ $user->contact_number }}</td>--}}
                        {{--<td>{{ $user->address }}</td>--}}
                        {{--<td>{{ date('F d, Y') }}</td>--}}
                        {{--<td>--}}
                            {{--<a class="btn btn-sm btn-info">--}}
                                {{--<i class="glyphicon glyphicon-lock"></i>--}}
                                {{--Reset Password--}}
                            {{--</a>--}}
                            {{--<a class="btn btn-sm btn-danger">--}}
                                {{--<i class="glyphicon glyphicon-remove"></i>--}}
                                {{--Delete--}}
                            {{--</a>--}}
                        {{--</td>--}}
                    {{--</tbody>--}}
                </table>
            </div>
        </div>

        <div class="col-md-3">
            @include('admin.partial.userSummary')
        </div>
    </div>
    <a href="#" class="fixed-fab" data-toggle="modal" data-target="#updateAccountModal"><i class="glyphicon glyphicon-plus-sign"></i></a>
@endsection

@section('modal')
    @php
        $id             = null;
        $email          = null;
        $firstName      = null;
        $lastName       = null;
        $contactNumber  = null;
    @endphp
    @include('admin.modal.updateAccount')
    @php
        $id             = $user->id;
        $email          = $user->email;
        $firstName      = $user->first_name;
        $lastName       = $user->last_name;
        $contactNumber  = $user->contact_number;
    @endphp
    @include('admin.modal.updateAccount')
@endsection