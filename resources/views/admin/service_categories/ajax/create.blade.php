<div class="modal-dialog modal-lg">

    <!-- Modal content-->

    <form class="form form-horizontal">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Add</h4>

            </div>

            <div class="modal-body">

                <div class="form-group row">

                    <div class="col-sm-4">

                        <label class="label-control label">Service Name <span class="required">*</span></label>

                        <input type="text" class="form-control" placeholder="Enter Service Name" name="name" id="name">

                        <div class="text-danger validation-err" id="name-err"></div>

                    </div>
                    @if($language)

                    <div class="col-sm-4">
                        <label class="label-control label">Service Name (ar) <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Arabic Service Name" name="name_ar" id="name_ar">
                        <div class="text-danger validation-err" id="name_ar-err"></div>
                    </div>
                    @endif
                    <div class="col-sm-4">
                        <label class="label-control label">Other Services</label>
                        <label class="switch">
                        <input type="checkbox" class="form-control" name="other_service" id="other_service">
                        <span class="slider round"></span>
                        </label>
                       
                        <div class="text-danger validation-err" id="other_service-err"></div>
                    </div>
                    <div class="col-sm-4">
                        <label class="label-control label">Value Added Services</label>
                        <label class="switch">
                        <input type="checkbox" class="form-control"  name="value_added_service" id="value_added_service">
                        <span class="slider round"></span>
                    </label>
                        <div class="text-danger validation-err" id="value_added_service-err"></div>
                    </div>
                    <div class="col-sm-4">

                        <label class="label-control label">Slug URL <span class="required">*</span></label>

                        <input type="text" class="form-control" placeholder="Enter Slug URL" name="slug" id="slug">

                        <div class="text-danger validation-err" id="slug-err"></div>

                    </div>

                     <div class="col-md-4">

                        <label class="label-control label">Service Icon <span class="required">*</span> <span class="text-danger">(Image Size 500*500)</span></label>

                        <input type="file" class="form-control" name="image" id="image">

                        <div class="text-danger validation-err" id="image-err"></div>

                    </div>


                     <div class="col-sm-4">

                        <label class="label-control label">Status <span class="required">*</span></label>

                        <select class="form-control" name="status" id="status">

                            <option value="active">Active</option>

                            <option value="block">Block</option>

                        </select>

                        <div class="text-danger validation-err" id="status-err"></div>

                    </div>

                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="label-control">
                        Service Description* </label>
                        <textarea class="form-control" cols="4" rows="2"
                            placeholder="Enter Detail"
                            name="description"
                            id="description"></textarea>
                        <div class="text-danger validation-err"
                            id="description-err"></div>
                    </div>
                </div>
                @if($language)
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="label-control">
                        Service Description Arabic </label>
                        <textarea class="form-control" cols="4" rows="2"
                            placeholder="Enter Detail"
                            name="description_ar"
                            id="description_ar"></textarea>
                        <div class="text-danger validation-err"
                            id="description_ar-err"></div>
                    </div>
                </div>
                @endif

                <div class="form-group row">

                    <div class="col-sm-12">

                        <label class="label-control label">Meta Title <span class="required">*</span></label>

                        <input type="text" class="form-control" placeholder="Enter Meta Title" name="meta_title" id="meta_title" maxlength="60">

                        <span class="note-span" id="meta_title-limit">We recommend title between 50–60 characters.(0 character)</span>

                        <div class="text-danger validation-err" id="meta_title-err"></div>

                    </div>



                    <div class="col-sm-6">

                        <label class="label-control label">Meta Keywords <span class="required">*</span></label>

                        <textarea class="form-control" rows="4" cols="7" placeholder="Enter Meta Keywords" name="meta_keyword" id="meta_keyword"></textarea>

                        <div class="text-danger validation-err" id="meta_keyword-err"></div>

                    </div>



                    <div class="col-sm-6">

                        <label class="label-control label">Meta Description <span class="required">*</span></label>

                        <textarea class="form-control" rows="4" cols="7" placeholder="Enter Meta Description" name="meta_description" id="meta_description" maxlength="160"></textarea>

                        <span class="note-span" id="meta_description-limit">We recommend descriptions between 50–160 characters.(0 character)</span>

                        <div class="text-danger validation-err" id="meta_description-err"></div>

                    </div>

                </div>
                {{--
                <div class="form-group row">

                    <div class="col-sm-12">
                        <label class="label-control label">Meta Title  (ar)<span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Meta Title" name="meta_title_ar" id="meta_title_ar" maxlength="60">
                        <span class="note-span" id="meta_title-limit">We recommend title between 50–60 characters.(0 character)</span>
                        <div class="text-danger validation-err" id="meta_title_ar-err"></div>
                    </div>

                    <div class="col-sm-6">
                        <label class="label-control label">Meta Keywords  (ar)<span class="required">*</span></label>
                        <textarea class="form-control" rows="4" cols="7" placeholder="Enter Meta Keywords" name="meta_keyword_ar" id="meta_keyword_ar"></textarea>
                        <div class="text-danger validation-err" id="meta_keyword_ar-err"></div>
                    </div>

                    <div class="col-sm-6">
                        <label class="label-control label">Meta Description  (ar)<span class="required">*</span></label>
                        <textarea class="form-control" rows="4" cols="7" placeholder="Enter Meta Description" name="meta_description_ar" id="meta_description_ar" maxlength="160"></textarea>
                        <span class="note-span" id="meta_description-limit">We recommend descriptions between 50–160 characters.(0 character)</span>
                        <div class="text-danger validation-err" id="meta_description_ar-err"></div>
                    </div>

                </div>
                --}}
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-primary" id="add-category-btn">Submit</button>

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>

    </form>

</div>
<script>
//     $(document).ready(function() {
//     CKEDITOR.replace('description', {
//         filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
//         filebrowserUploadMethod: 'form'
//     });
// });
</script>

