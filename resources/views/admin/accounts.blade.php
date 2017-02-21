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
                            <a href="{{ url('admin/edit-profile') }}" class="btn btn-sm btn-primary">
                                <i class="glyphicon glyphicon-user"></i>
                                Update Profile
                            </a>
                        </td>
                    </tbody>
                    <tbody>
                        <td>{{ $user->first_name . ' ' .$user->last_name .' 2' }}</td>
                        <td>{{ $user->contact_number }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ date('F d, Y') }}</td>
                        <td>
                            <a class="btn btn-sm btn-info">
                                <i class="glyphicon glyphicon-lock"></i>
                                Reset Password
                            </a>
                            <a class="btn btn-sm btn-danger">
                                <i class="glyphicon glyphicon-remove"></i>
                                Delete
                            </a>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-3">
            @include('admin.partial.userSummary')
        </div>
    </div>
@endsection