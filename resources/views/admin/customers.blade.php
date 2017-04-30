@extends('layout.main')
@section('pageTitle')
    Customer Accounts
@endsection

@section('content')
    <div class="col-md-12">
        <div class="col-sm-9">
            <div class="col-md-12 jumbotron">
                <table class="table table-hover">
                    <thead>
                    <th>Status</th>
                    <th>Company</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Contact #</th>
                    <th>Address</th>
                    <th>Actions</th>
                    </thead>
                    @foreach($users as $user)
                        <tbody>
                        <td>{{ $user->is_active ? 'Active' : 'Inactive' }}</td>
                        <td>{{ $user->company ?: 'N/A' }}</td>
                        <td>{{ $user->getFullName() }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->contact_number }}</td>
                        <td>{{ $user->address }}</td>
                        <td>
                            @if(!$user->is_active)
                                <a data-href="{{ url('admin/accounts/activate', ['id' => $user->id]) }}"
                                   data-toggle="modal" data-customer-name="{{ $user->getFullName() }}"
                                   data-target="#confirm-activateUser" class="btn btn-sm btn-success">
                                    <i class="glyphicon glyphicon-check"></i>
                                    Activate
                                </a>
                                <a data-href="{{ url('admin/accounts/delete', ['isCustomer' => 1, 'id' => $user->id]) }}"
                                   data-toggle="modal" data-item-type="customer" data-item-name="{{ $user->getFullName() }}"
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
@endsection