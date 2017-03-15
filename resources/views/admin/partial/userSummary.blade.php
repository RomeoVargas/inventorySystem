<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Users</h3>
    </div>
    <div class="panel-body">
        <ul class="list-group">
            <li class="list-group-item">
                <span class="badge">{{ \App\User::getCountByType(\App\User::AUTH_TYPE_CUSTOMER) }}</span>
                Registered Customers
            </li>
            <li class="list-group-item">
                <span class="badge">{{ \App\User::getCountByType(\App\User::AUTH_TYPE_ADMIN) + 1 }}</span>
                Admin Accounts
            </li>
        </ul>
    </div>
</div>