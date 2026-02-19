<div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <form id="update_form" class="form form-horizontal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="label-control label">Name <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="name" id="name" value="{{ $customer->name }}">
                        <div class="text-danger" id="name-err"></div>
                    </div>
                    <div class="col-sm-4">
                        <label class="label-control label">Email <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Email" name="email" id="email" value="{{ $customer->email }}">
                        <div class="text-danger" id="email-err"></div>
                    </div>
                </div>

                <div class="form-group row">
                      <div class="col-sm-4">
                        <label class="label-control label">Mobile <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Url" name="mobile" id="mobile" value="{{ $customer->mobile_number }}">
                        <div class="text-danger" id="mobile-err"></div>
                    </div>
                  
                    <div class="col-sm-3">
                        <label class="label-control label">Status <span class="required">*</span></label>
                        <select class="form-control" name="status" id="status">
                            <option value="active" @if ($customer->status == 'active') selected @endif>Active</option>
                            <option value="block" @if ($customer->status == 'block') selected @endif>Block</option>
                        </select>
                        <div class="text-danger" id="status-err"></div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="label-control label">Password <span class="required">(Enter password if need to be change)</span></label>
                        <input type="text" class="form-control" placeholder="Enter Password" name="password" id="password" value="">
                        <div class="text-danger" id="password-err"></div>
                    </div>
                </div>
          
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="update-brand-btn" brand_id="{{ $customer->id }}">Submit</button> 
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
    </form>
</div>
