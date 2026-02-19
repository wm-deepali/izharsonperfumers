<style>
    .modal-body {
    height: 30vh;
    overflow-y: auto;
}
</style>

<div class="modal-dialog">
    <!-- Modal content-->
    <form class="form form-horizontal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="label-control label">Brand Name <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Brand Name" name="title" id="title">
                        <div class="text-danger" id="title-err"></div>
                    </div>
                    <div class="col-sm-3">
                        <label class="label-control label">Status <span class="required">*</span></label>
                        <select class="form-control" name="status" id="status">
                            <option value="active">Active</option>
                            <option value="block">De-Active</option>
                        </select>
                        <div class="text-danger" id="status-err"></div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="add-carorigin-btn">Add</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
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
