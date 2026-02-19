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
                    <div class="col-sm-6">
                        <label class="label-control label">Title <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Title" name="title" id="title">
                        <div class="text-danger" id="title-err"></div>
                    </div>
                    @if($language)
                    <div class="col-sm-6">
                        <label class="label-control label">Title Ar<span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Title Arabic" name="title_ar" id="title_ar">
                        <div class="text-danger" id="title_ar-err"></div>
                    </div>
                    @endif
                    <div class="col-sm-6">
                        <label class="label-control label">Url <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Url" name="url" id="url">
                        <div class="text-danger" id="url-err"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="label-control label">Image <span class="required">*</span><span class="text-danger">(Image Size 500*500)</span></label>
                        <input type="file" class="form-control" name="image" id="image">
                        <div class="text-danger" id="image-err"></div>
                    </div>
                    <div class="col-sm-4">
                        <label class="label-control label">Status <span class="required">*</span></label>
                        <select class="form-control" name="status" id="status">
                            <option value="active">Active</option>
                            <option value="block">Block</option>
                        </select>
                        <div class="text-danger" id="status-err"></div>
                    </div>
                    <div class="col-sm-4">
                        <label class="label-control label">Author <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Author" name="author" id="author">
                        <div class="text-danger" id="author-err"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="label-control label">Content <span class="required">*</span></label>
                        <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
                        <div class="text-danger" id="content-err"></div>
                    </div>
                    @if($language)
                    <div class="col-sm-12">
                        <label class="label-control label">Content Ar<span class="required">*</span></label>
                        <textarea class="form-control" name="content_ar" id="content_ar" cols="30" rows="10"></textarea>
                        <div class="text-danger" id="content_ar-err"></div>
                    </div>
                    @endif
                </div>

            
            <div class="form-group row">
            <div class="col-sm-6">
            <label class="label-control label">Meta Title *</label>
                <input type="text" class="form-control" placeholder="Enter Meta Title" name="meta_title"  id="meta_title">
                <div class="text-danger" id="meta_title-err"></div>
            </div>
            
            <div class="form-group row">
            <div class="col-sm-6">
            <label class="label-control label">Meta Description *</label>
                <input type="text" class="form-control" placeholder="Enter Meta Description" name="meta_description" id="meta_description" >
                 <div class="text-danger" id="meta_description-err"></div>
            </div>
            </div>
            <div class="form-group row">
            <div class="col-sm-6">
            <label class="label-control label">Meta Keywords *</label>
                <input type="text"  class="form-control" placeholder="Enter Meta Keywords" name="meta_keyword" id="meta_keyword" >
                <div class="text-danger" id="meta_keyword-err"></div>
            </div>
            
            <div class="form-group row">
            <div class="col-sm-6">
            <label class="label-control label">Canonical Tag *</label>
                <input type="text" class="form-control" placeholder="Enter Canonical Tag" name="canonical_tags" id="canonical_tags" >
                <div class="text-danger" id="canonical_tags-err"></div>
            </div>
            </div>
            <div class="form-group row">
            <div class="col-sm-6">
            <label class="label-control label">Twitter Cards *</label>
                <input type="text" class="form-control" placeholder="Enter Twitter Cards" name="twitter_cards" id="twitter_cards" >
                 <div class="text-danger" id="twitter_cards-err"></div>
            </div>
            <div class="form-group row">
            <div class="col-sm-6">
            <label class="label-control label">OG Tags *</label>
                <input type="text" class="form-control" placeholder="Enter OG Tags" name="og_tags" id="og_tags" >
                 <div class="text-danger" id="og_tags-err"></div>
            </div>
            </div>
           
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="add-blog-btn">Add</button>
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
