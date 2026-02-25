<div class="modal-dialog modal-lg">

    <!-- Modal content-->

    <form class="form form-horizontal">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Add</h4>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-sm-6 form-group">
                        <label class="label-control label">@if(url()->previous() == url('admin/manage-category'))
                        Category @else Sub-Category @endif Name <span class="required">*</span></label>
                        <input type="text" class="form-control"
                            placeholder="Enter @if(url()->previous() == url('admin/manage-category')) Category @else Sub-Category @endif Name"
                            name="name" id="name">
                        <div class="text-danger validation-err" id="name-err"></div>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label class="label-control label">URL Slug <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter URL Slug" name="slug" id="slug">
                        <div class="text-danger validation-err" id="slug-err"></div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Status <span class="required">*</span></label>
                        <select class="form-control" name="status" id="status">
                            <option value="active">Active</option>
                            <option value="block">De-Active</option>
                        </select>
                        <div class="text-danger validation-err" id="status-err"></div>

                    </div>

                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Premium Category</label>
                        <select class="form-control" name="is_premium" id="is_premium">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                        <div class="text-danger validation-err" id="is_premium-err"></div>
                    </div>

                </div>



                @if(url()->previous() == url('admin/manage-category'))
                    <div class="row">
                        @if(!isset($category->parent_id))
                            <div class="col-md-6 form-group">
                                <label class="label-control label">@if(isset($category->parent_id)) Sub-Category @else Category
                                @endif Icon <span class="required">*</span> <span
                                        class="text-danger">(@if(isset($category->parent_id)) Sub-Category @else Category @endif
                                        Icon Size 500*500)</span></label>
                                <input type="file" class="form-control" name="image" id="image">
                                <div class="text-danger validation-err" id="image-err"></div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="label-control label">Category Banner Image <span class="required">*</span></label>
                                <input type="file" class="form-control" name="banner_image" id="banner_image">
                                <div class="text-danger validation-err" id="banner_image-err"></div>
                            </div>
                        @endif
                    </div>
                @endif
                <div class="row">

                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Meta Title </label>
                        <input type="text" class="form-control" placeholder="Enter Meta Title" name="meta_title"
                            id="meta_title" maxlength="60">
                        <span class="note-span" id="meta_title-limit">We recommend title between 50–60 characters.(0
                            character)</span>
                        <div class="text-danger validation-err" id="meta_title-err"></div>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Meta Keywords </label>
                        <textarea class="form-control" rows="2" cols="7" placeholder="Enter Meta Keywords"
                            name="meta_keyword" id="meta_keyword"></textarea>
                        <div class="text-danger validation-err" id="meta_keyword-err"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 form-group">
                        <label class="label-control label">Canonical Tag</label>
                        <textarea class="form-control" rows="2" cols="7" placeholder="Enter Canonical Tag"
                            name="canonical_tags" id="canonical_tags"></textarea>

                        <div class="text-danger" id="canonical_tags-err"></div>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label class="label-control label">Twitter Cards</label>
                        <textarea class="form-control" rows="2" cols="7" placeholder="Enter Twitter Cards"
                            name="twitter_cards" id="twitter_cards"></textarea>

                        <div class="text-danger" id="twitter_cards-err"></div>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label class="label-control label">OG Tags</label>
                        <textarea class="form-control" rows="2" cols="7" placeholder="Enter OG Tags" name="og_tags"
                            id="og_tags"></textarea>

                        <div class="text-danger" id="og_tags-err"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label class="label-control label">Meta Description </label>
                        <textarea class="form-control" rows="4" cols="7" placeholder="Enter Meta Description"
                            name="meta_description" id="meta_description" maxlength="160"></textarea>
                        <span class="note-span" id="meta_description-limit">We recommend descriptions between 50–160
                            characters.(0 character)</span>
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