<style>
    .modal-body{
    max-height: calc(100vh - 200px);
    overflow-y: auto;
}
</style>

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
                        <label class="label-control label">Package Name <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="name" id="name">
                        <div class="text-danger validation-err" id="name-err"></div>
                    </div>

                    <div class="col-sm-4">
                        <label class="label-control label">Slug <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Slug" name="slug" id="slug">
                        <div class="text-danger validation-err" id="slug-err"></div>
                    </div>

                    <div class="col-sm-4">
                        <label class="label-control label">Sub Title <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Sub Title" name="sub_title" id="sub_title">
                        <div class="text-danger validation-err" id="sub_title-err"></div>
                    </div>

                    <div class="col-sm-4">
                        <label class="label-control label">Currency <span class="required">*</span></label>
                        <select class="form-control" name="currency_type" id="currency_type">
                            <option value="SAR">SAR</option>
                            <option value="USD">USD</option>
                        </select>
                        <div class="text-danger validation-err" id="currency_type-err"></div>
                    </div>

                    <div class="col-sm-4">
                        <label class="label-control label">Price <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Price" name="price" id="price">
                        <div class="text-danger validation-err" id="price-err"></div>
                    </div>

                    <div class="col-sm-4">
                        <label class="label-control label">Discounted Price <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Discounted Price" name="discountable_price" id="discountable_price">
                        <div class="text-danger validation-err" id="discountable_price-err"></div>
                    </div>

                    <div class="col-sm-12">
                        <label class="label-control label">Package Features <span class="required">*</span></label>
                        <textarea id="pkg_features" class="form-control" placeholder="Add description" name="pkg_features"></textarea>
                        <div class="text-danger validation-err" id="pkg_features-err"></div>
                    </div>

                     <div class="col-md-4">
                        <label class="label-control label">Image <span class="required">*</span> <span class="text-danger">(Image Size 500*500)</span></label>
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

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="add-category-btn">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

    </form>

</div>

<script>
    CKEDITOR.replace('pkg_features', {
        filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form'
    });
</script>
