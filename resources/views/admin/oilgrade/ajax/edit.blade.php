<div class="modal-dialog">
    <!-- Modal content-->
    <form class="form form-horizontal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">EDIT</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Fragrance Name <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Fragrance Name" name="title" id="title" value="{{ $carorigin->title }}">
                        <div class="text-danger" id="title-err"></div>
                    </div>
                   
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Status <span class="required">*</span></label>
                        <select class="form-control" name="status" id="status">
                            <option value="active" @if ($carorigin->status == 'active') selected @endif>Active</option>
                            <option value="block" @if ($carorigin->status == 'block') selected @endif>De-Active</option>
                        </select>
                        <div class="text-danger" id="status-err"></div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn adminbtn-blue btn-lg" id="update-carorigin-btn" carorigin_id="{{ $carorigin->id }}">Submit</button>
            </div>
        </div>
    </form>
</div>
<script>
    CKEDITOR.replace('content', {
        filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form'
    });
</script>
