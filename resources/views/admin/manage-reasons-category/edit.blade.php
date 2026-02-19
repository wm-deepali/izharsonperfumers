<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reason Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-25px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="reasonupdate">
            <form>
                @csrf
                <div class="form-group">
                <label for="type">Select Reason Type</label>
                <select class="form-control" name="type" id="type">
                    <option value="">Select</option>
                  <option @if($reason->type=="return") selected @endif value="return">Return </option>
                  <option @if($reason->type=="cancelled") selected @endif value="cancelled">Cancelled</option>
                </select>
                <div class="text-danger validation-err" id="type-err"></div>
              </div>
              <div class="form-group">
                <label for="title">Enter Reason Title</label>
                <input type="text" value="{{$reason->title}}" class="form-control" name="title" id="title" placeholder="Enter Reason Title">
                <div class="text-danger validation-err" id="title-err"></div>
              </div>
              <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" id="status">
                    <option value="">Select</option>
                    <option @if($reason->status=="active") selected @endif value="active">Active</option>
                    <option @if($reason->status=="block") selected @endif value="block">De-Active</option>
                </select>
                <div class="text-danger validation-err" id="status-err"></div>
              </div>
              <div class="form-group">
                <button type="button" id="update-reason-btn" reason_id="{{$reason->id}}" class="btn adminbtn-blue btn-lg">Submit</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>