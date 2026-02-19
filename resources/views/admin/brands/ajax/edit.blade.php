<div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <form class="form form-horizontal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="label-control label">Quantity<span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Quantity" name="quantity" id="quantity" value="{{ $brand->quantity }}">
                        <div class="text-danger" id="quantity-err"></div>
                    </div>
                    <div class="col-sm-4">
                        <label class="label-control label">Quantity IN<span class="required">*</span></label>
                        <select class="form-control" name="quantity_in" id="quantity_in">
                            <option @if($brand->quantity_in=="ml") selected @endif value="ml">ml</option>
                            <option @if($brand->quantity_in=="lit") selected @endif value="lit">lit</option>
                        </select>
                        <div class="text-danger" id="name-err"></div>
                    </div>
                     <div class="col-sm-4">
                        <label class="label-control label">Status <span class="required">*</span></label>
                        <select class="form-control" name="status" id="status">
                            <option value="active" @if ($brand->status == 'active') selected @endif>Active</option>
                            <option value="block" @if ($brand->status == 'block') selected @endif>De-Active</option>
                        </select>
                        <div class="text-danger" id="status-err"></div>
                    </div>
                </div>

                
                
            <div class="modal-footer">
                <button type="button" class="btn adminbtn-blue btn-lg" id="update-brand-btn" brand_id="{{ $brand->id }}">Submit</button>
            </div>
    </form>
</div>
