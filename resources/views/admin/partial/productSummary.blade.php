<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">Products</h3>
    </div>
    <div class="panel-body">
        <a href="{{ url('admin/products') }}">
            <ul class="list-group">
                <li class="list-group-item alert-danger">
                    <span class="badge">{{ $numNeedsRestock }}</span>
                    Needs Re-stock
                </li>
            </ul>
        </a>
    </div>
</div>