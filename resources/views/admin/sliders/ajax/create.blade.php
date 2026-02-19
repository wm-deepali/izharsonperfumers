<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <form class="form form-horizontal" id="addformslider" method="POST" action="{{ route('admin.manage-slider.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="label-control label">Title <span class="required">*</span></label>
                        <input type="text" class="form-control" name="title" >
                         <div class="text-danger" id="title-err"></div>
                    </div>
                    @if($language)
                    <div class="col-sm-12">
                        <label class="label-control label">Title Ar<span class="required">*</span></label>
                        <input type="text" class="form-control" name="title_ar" >
                         <div class="text-danger" id="title_ar-err"></div>
                    </div>
                    @endif
                    <div class="col-sm-12">
                        <label class="label-control label">Sub-title <span class="required">*</span></label>
                        <input type="text" class="form-control" name="sub_title" >
                         <div class="text-danger" id="sub_title-err"></div>
                    </div>
                    <div class="col-sm-12">
                        <label class="label-control label">Description <span class="required">*</span></label>
                        <textarea type="text" class="form-control" name="content" ></textarea>
                         <div class="text-danger" id="content-err"></div>
                    </div>
                    <div class="col-sm-12">
                        <label class="label-control label">Description Colour </label>
                        <input type="color" class="form-control" name="color" >
                         <div class="text-danger" id="color-err"></div>
                    </div>
                    <div class="col-sm-12">
                        <label class="label-control label">Button Link <span class="required">*</span></label>
                        <input type="text" class="form-control" name="button_link" >
                         <div class="text-danger" id="button_link-err"></div>
                    </div>
                    @if($language)
                    <div class="col-sm-12">
                        <label class="label-control label">Sub-title Ar<span class="required">*</span></label>
                        <input type="text" class="form-control" name="sub_title_ar" >
                         <div class="text-danger" id="sub_title_ar-err"></div>
                    </div>
                    @endif
                    <div class="col-sm-12">
                        <label class="label-control label">Image <span class="required">*</span><span class="text-danger">(Image Size 1440*500)</span></label>
                        <input type="file" class="form-control" name="image" >
                         <div class="text-danger" id="image-err"></div>
                    </div>
                    <div class="col-sm-12">
                        <label class="label-control label">Status <span class="required">*</span></label>
                        <select class="form-control" name="status">
                            <option value="active" selected>Active</option>
                            <option value="block">Block</option>
                        </select>
                         <div class="text-danger" id="status-err"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary add-slider-btn">Add</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
<script>
    // CKEDITOR.replace('content', {
    //     filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
    //     filebrowserUploadMethod: 'form'
    // });
</script>
