<div class="modal fade" id="orderDetailsModal{{$refNum}}" tabindex="-1" role="dialog" aria-labelledby="checkout">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Order Ref. #{{$refNum}}</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal row">
                    <div class="col-md-offset-1 col-md-10">
                        <div class="col-sm-8">
                            <table class="table table-hover">
                                <thead>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                </thead>
                                @foreach($orderItems as $orderItem)
                                    <tr>
                                        <td>{{ $orderItem->name }}</td>
                                        <td>{{ number_format($orderItem->quantity) }}</td>
                                        <td>{{ number_format($orderItem->price) }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-12 text-left">Current Status</label>
                                <div class="col-sm-12"><strong class="btn btn-sm btn-{{$viewClass}}">{{ $status }}</strong></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 text-left">Items ordered</label>
                                <div class="col-sm-12">{{ number_format($orderItems->count()) }}</div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 text-left">Total price</label>
                                <div class="col-sm-12">₱ {{ number_format($totalPrice) }}</div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 text-left">Mode of Payment</label>
                                <div class="col-sm-12">Cash on Delivery</div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 text-left">Delivery address</label>
                                <div class="col-sm-12">{{$address}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>