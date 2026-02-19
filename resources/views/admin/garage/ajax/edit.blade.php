<div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <form class="form form-horizontal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">EDIT</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="label-control label">Title <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Title" name="title" id="title" value="{{ $garage->title }}">
                        <div class="text-danger" id="title-err"></div>
                    </div>
                    @if($language)
                    <div class="col-sm-6">
                        <label class="label-control label">Title Ar<span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Title Arabic" name="title_ar" id="title_ar" value="{{ $garage->title_ar }}">
                        <div class="text-danger" id="title_ar-err"></div>
                    </div>
                    @endif
                    <div class="col-sm-6">
                        <label class="label-control label">Url <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Url" name="url" id="url" value="{{ $garage->url }}">
                        <div class="text-danger" id="url-err"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="label-control label">Image <span class="required">*</span></label>
                        <input type="file" class="form-control" name="image" id="image">
                        <div class="text-danger" id="image-err"></div>
                    </div>
                    <div class="col-sm-6">
                        <label class="label-control label">Status <span class="required">*</span></label>
                        <select class="form-control" name="status" id="status">
                            <option value="active" @if ($garage->status == 'active') selected @endif>Active</option>
                            <option value="block" @if ($garage->active == 'block') selected @endif>Block</option>
                        </select>
                        <div class="text-danger" id="status-err"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="label-control label">Content <span class="required">*</span></label>
                        <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ $garage->content }}</textarea>
                        <div class="text-danger" id="content-err"></div>
                    </div>
                    @if($language)
                    <div class="col-sm-12">
                        <label class="label-control label">Content Ar<span class="required">*</span></label>
                        <textarea class="form-control" name="content_ar" id="content_ar" cols="30" rows="10">{{ $garage->content_ar }}</textarea>
                        <div class="text-danger" id="content_ar-err"></div>
                    </div>
                    @endif
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="update-garage-btn" garage_id="{{ $garage->id }}">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
