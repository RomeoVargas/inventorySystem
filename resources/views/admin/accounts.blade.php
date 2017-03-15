@extends('layout.main')
@section('content')
    <div class="col-md-12">
        <div class="col-sm-9">
            <div class="col-md-12 jumbotron">
                <table class="table table-hover">
                    <thead>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <td>{{ $admin->getFullName() }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->contact_number }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary"
                               data-toggle="modal" data-target="#updateAccountModal{{$admin->id}}">
                                <i class="glyphicon glyphicon-edit"></i>
                                My Profile
                            </a>
                        </td>
                    </tbody>
                    @foreach($users as $user)
                        <tbody>
                            <td>{{ $user->getFullName() }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->contact_number }}</td>
                            <td>
                                @if($admin->isSuperAdmin())
                                    <a data-href="{{ url('admin/accounts/reset-password', ['id' => $user->id]) }}"
                                       data-toggle="modal" data-admin-name="{{ $user->getFullName() }}"
                                       data-target="#confirm-changePassword" class="btn btn-sm btn-info">
                                        <i class="glyphicon glyphicon-lock"></i>
                                        Reset Password
                                    </a>
                                    <a data-href="{{ url('admin/accounts/delete', ['id' => $user->id]) }}"
                                       data-toggle="modal" data-item-type="admin" data-item-name="{{ $user->getFullName() }}"
                                       data-target="#confirm-delete" class="btn btn-sm btn-danger">
                                        <i class="glyphicon glyphicon-remove"></i>
                                        Delete
                                    </a>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tbody>
                    @endforeach
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
        $id             = $admin->id;
        $email          = $admin->email;
        $firstName      = $admin->first_name;
        $lastName       = $admin->last_name;
        $contactNumber  = $admin->contact_number;
    @endphp
    @include('admin.modal.updateAccount')
@endsection

@section('specificCustomJs')
    @if(count($errors) > 0)
        <script>
            $(window).load(function(){
                $('#updateAccountModal{{ session('userId') }}').modal('show');
            });
        </script>
    @endif
@endsection