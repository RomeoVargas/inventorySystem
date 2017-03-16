<div class="modal fade" id="addProductModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="addProduct">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ $id ? 'Edit' : 'Add' }} Product</h4>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data"
                      action="{{ url('admin/products/save') }}" class="form-horizontal row">
                    <div class="col-md-offset-1 col-md-10">
                        <div class="col-sm-4">
                            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                <div class="col-sm-12">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                            <img src="{{ $image ?: asset('img/no-image.jpg') }}" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                            <span class="btn btn-default btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="image" class="form-control">
                                            </span>
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                                {!! $errors->first('image', '<p class="help-block col-sm-offset-2 col-sm-10">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-sm-offset-1 col-sm-7 text-left">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label class="col-sm-12 text-left">Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" placeholder="Product Name" value="{{ old('name') ?: $name }}">
                                    {!! $errors->first('name', "<p class='help-block'>:message</p>") !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                                <label class="col-sm-12 text-left">Price</label>
                                <div class="col-sm-12">
                                    <input type=number step=0.01 min=0 class="form-control" name="price" placeholder="How much is this?" value="{{ old('price') ?: $price }}">
                                    {!! $errors->first('price', "<p class='help-block'>:message</p>") !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('stocks') ? 'has-error' : '' }}">
                                <label class="col-sm-12 text-left">Stocks left</label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="font-size: 0.8em">
                                            <input type="checkbox" name="isMadeToOrder" {{ !$isMadeToOrder ?: 'checked' }}> Made to order?
                                        </span>
                                        <input type="number" min=0 class="form-control" name="stocks" placeholder="How many are in stock?" value="{{ old('stocks') ?: $stocks }}">
                                    </div>
                                    {!! $errors->first('stocks', "<p class='help-block'>:message</p>") !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label class="col-sm-12 text-left">Description</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" rows="3" style="resize:none" name="description">{{ old('description') ?: $description }}</textarea>
                                    {!! $errors->first('description', "<p class='help-block'>:message</p>") !!}
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