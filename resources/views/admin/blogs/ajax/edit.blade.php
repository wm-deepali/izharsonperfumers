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
                        <input type="text" class="form-control" placeholder="Enter Title" name="title" id="title" value="{{ $blog->title }}">
                        <div class="text-danger" id="title-err"></div>
                    </div>
                    @if($language)
                    <div class="col-sm-6">
                        <label class="label-control label">Title Ar<span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Title Arabic" name="title_ar" id="title_ar" value="{{ $blog->title_ar }}">
                        <div class="text-danger" id="title_ar-err"></div>
                    </div>
                    @endif
                    <div class="col-sm-6">
                        <label class="label-control label">Url <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Url" name="url" id="url" value="{{ $blog->url }}">
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
                            <option value="active" @if ($blog->status == 'active') selected @endif>Active</option>
                            <option value="block" @if ($blog->active == 'block') selected @endif>Block</option>
                        </select>
                        <div class="text-danger" id="status-err"></div>
                    </div>
                    <div class="col-sm-4">
                        <label class="label-control label">Author <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Author" name="author" id="author" value="{{ $blog->author }}">
                        <div class="text-danger" id="author-err"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="label-control label">Content <span class="required">*</span></label>
                        <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ $blog->content }}</textarea>
                        <div class="text-danger" id="content-err"></div>
                    </div>
                    @if($language)
                    <div class="col-sm-12">
                        <label class="label-control label">Content Ar<span class="required">*</span></label>
                        <textarea class="form-control" name="content_ar" id="content_ar" cols="30" rows="10">{{ $blog->content_ar }}</textarea>
                        <div class="text-danger" id="content_ar-err"></div>
                    </div>
                    @endif
                </div>
                <div class="form-group row">
            <label class="col-md-2 label-control">Meta Title*</label>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Enter Meta Title" id="meta_title" name="meta_title" value="{{ $blog->meta->meta_title ?? null }}" >
                <div class="text-danger" id="meta_title-err"></div>
            </div>
            
            <div class="form-group row">
            <label class="col-md-2 label-control">Meta Description *</label>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Enter Meta Description" id="meta_description" name="meta_description" value="{{ $blog->meta->meta_description ?? null }}" >
                <div class="text-danger" id="meta_description-err"></div>
            </div>
            </div>
            <div class="form-group row">
            <label class="col-md-2 label-control">Meta Keywords *</label>
            <div class="col-md-4">
                <input type="text" id="meta_keyword" class="form-control" placeholder="Enter Meta Keywords" name="meta_keyword" value="{{ $blog->meta->meta_keyword ?? null }}" >
                <div class="text-danger" id="meta_keyword-err"></div>
            </div>
            
            <div class="form-group row">
            <label class="col-md-2 label-control">Canonical Tag *</label>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Enter Canonical Tag" id="canonical_tags" name="canonical_tags" value="{{ $blog->meta->canonical_tags ?? null }}" >
                <div class="text-danger" id="canonical_tags-err"></div>
            </div>
            </div>
            <div class="form-group row">
            <label class="col-md-2 label-control">Twitter Cards *</label>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Enter Twitter Cards" id="twitter_cards" name="twitter_cards" value="{{ $blog->meta->twitter_cards ?? null }}" >
                <div class="text-danger" id="twitter_cards-err"></div>
            
            </div>
            <div class="form-group row">
            <label class="col-md-2 label-control">OG Tags *</label>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Enter OG Tags" id="og_tags" name="og_tags" value="{{ $blog->meta->og_tags ?? null }}" >
                <div class="text-danger" id="og_tags-err"></div>
            </div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="update-blog-btn" blog_id="{{ $blog->id }}">Submit</button>
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
