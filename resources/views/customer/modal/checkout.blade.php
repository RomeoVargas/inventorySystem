@php($user = \Illuminate\Support\Facades\Auth::user())
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkout">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Checkout</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('order/checkout') }}" class="form-horizontal row">
                    <div class="col-md-offset-1 col-md-10">
                        <div class="col-sm-8">
                            <table class="table table-hover">
                                <thead>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                </thead>
                                @foreach($cartItems as $cartItem)
                                    @php($product = $cartItem->getProduct())
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ number_format($cartItem->quantity) }}</td>
                                        <td>{{ number_format($product->price) }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-12 text-left">Items in cart</label>
                                <div class="col-sm-12">{{ number_format($cartItems->count()) }}</div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 text-left">Total price</label>
                                <div class="col-sm-12">₱ {{ number_format($totalPrice) }}</div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 text-left">Mode of Payment</label>
                                <div class="col-sm-12">Cash on Delivery</div>
                            </div>
                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label class="col-sm-12 text-left">Delivery address</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" rows="3" style="resize:none" name="address">{{ old('address') ?: $user->address }}</textarea>
                                    {!! $errors->first('address', "<p class='help-block'>:message</p>") !!}
                                </div>
                            </div>
                        </div>

                        <hr/>
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-sm btn-primary btn-block" type="submit">Submit Order</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>