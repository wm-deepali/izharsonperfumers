<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <form class="form form-horizontal" id="updateslider" method="POST" action="{{ route('admin.manage-slider.update', $slider->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="label-control label">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $slider->title }}" >
                        <div class="text-danger" id="title-err"></div>
                    </div>
                
                    <div class="col-sm-12">
                        <label class="label-control label">Sub-title</label>
                        <input type="text" class="form-control" name="sub_title" value="{{ $slider->sub_title }}" >
                        <div class="text-danger" id="sub_title-err"></div>
                    </div>
                    <div class="col-sm-12">
                        <label class="label-control label">Description </label>
                        <textarea type="text" class="form-control" name="content" >{{$slider->content}}</textarea>
                        <div class="text-danger" id="content-err"></div>
                    </div>
                    <div class="col-sm-12">
                        <label class="label-control label">Text Colour </label>
                        <input type="color" class="form-control" name="color" value="{{ $slider->color }}" >
                         <div class="text-danger" id="color-err"></div>
                    </div>
                    <div class="col-sm-12">
                        <label class="label-control label">Button Link</label>
                        <input type="text" class="form-control" name="button_link" value="{{ $slider->button_link }}" >
                        <div class="text-danger" id="button_link-err"></div>
                    </div>
                    <div class="col-sm-12">
                        <label class="label-control label">Image <span class="required">*</span><span class="text-danger">(Image Size 1440*500)</span></label>
                        <input type="file" class="form-control" name="image">
                         <div class="text-danger" id="image-err"></div>
                        <img src="{{ URL::asset('storage/' . $slider->image) }}" class="img-fluid mx-2 mt-2" style="height:50px;">
                       
                    </div>
                    <div class="col-sm-12">
                        <label class="label-control label">Status <span class="required">*</span></label>
                        <select class="form-control" name="status">
                            <option value="active" @if ($slider->status == 'active') selected @endif>Active</option>
                            <option value="block" @if ($slider->status == 'block') selected @endif>Block</option>
                        </select>
                        <div class="text-danger" id="status-err"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary update-slider-btn">Update</button>
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
