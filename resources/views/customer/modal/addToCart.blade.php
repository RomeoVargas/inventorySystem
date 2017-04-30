<div class="modal fade" id="addToCartModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="addToCart">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ $cartId ? 'Edit' : 'Add' }} Cart Item</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('cart/save') }}" class="form-horizontal row">
                    <div class="col-md-offset-1 col-md-10">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                            <img src="{{ $image }}" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-offset-1 col-sm-7 text-left">
                            <div class="form-group">
                                <label class="col-sm-12 text-left">Name</label>
                                <div class="col-sm-12">{{ $name }}</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-12 text-left">Price</label>
                                    <div class="col-sm-12">₱ {{ number_format($price) }}</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-12 text-left">Stocks left</label>
                                    <div class="col-sm-12">
                                        @if(!$madeToOrder)
                                            {{ number_format($stocks) }}
                                        @else
                                            Made to order
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                                <label class="col-sm-12 text-left">Quantity</label>
                                <div class="col-sm-12">
                                    <input type="number" min=0 class="form-control" name="quantity" placeholder="How many will you order?" value="{{ old('quantity') ?: $quantity }}">
                                    {!! $errors->first('quantity', "<p class='help-block'>:message</p>") !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-12 text-left">Description</label>
                                <div class="col-sm-12">{{ $description }}</div>
                            </div>
                        </div>

                        <hr/>
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="hidden" name="urlFrom" value="{{ $urlFrom }}">
                                <button class="btn btn-sm btn-primary btn-block" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>