<div class="modal fade" id="setDeliveryDateModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="setDeliveryDate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delivery Date for Order #{{$refNum}}</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('admin/order/setDelivery') }}" class="form-horizontal row">
                    <div class="col-md-offset-1 col-md-10">
                        <div class="col-sm-12">
                            <div class="form-group {{ $errors->has('deliveryDate') ? 'has-error' : '' }}">
                                <label class="col-sm-12 text-left">Delivery Date</label>
                                <div class="col-sm-12">
                                    <input type="date" value="{{ old('deliveryDate') ?: date('Y-m-d') }}" class="form-control" name="deliveryDate" onchange="submit()">
                                    {!! $errors->first('deliveryDate', "<p class='help-block'>:message</p>") !!}
                                </div>
                            </div>
                        </div>

                        <hr/>
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button class="btn btn-sm btn-primary btn-block" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>