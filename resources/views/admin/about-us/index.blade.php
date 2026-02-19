@include('admin.header')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">Manage About Us</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Content Management</li>
                            <li class="breadcrumb-item active">Manage About Us</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Content Management - Manage About Us</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <section>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card-body collapse in">
                                <div class="card-block card-dashboard">
                                    <div class="table-responsive">
                                        <div class="card-body collapse in">
                                            <div class="card-block">
                                                <form method="post" id="aboutform" action="{{ route('admin.manage-about-us.store') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-body">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control">Title <span class="required">*</span></label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="Enter Title" name="title" value="{{ $about_us->title ?? null }}" >
                                                                 <div class="text-danger" id="title-err"></div>
                                                            </div>
                                                            @if($language)
                                                            <div class="form-group row">
                                                                <label class="col-md-2 label-control">Title ar <span class="required">*</span></label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" placeholder="Enter Title Arabic" name="title_ar" value="{{ $about_us->title_ar ?? null }}" >
                                                                     <div class="text-danger" id="title_ar-err"></div>
                                                                </div>
                                                                @endif
                                                            <label class="col-md-2 label-control">Image</label>
                                                            <div class="col-md-4">
                                                                <input type="file" class="form-control" name="image">
                                                                 <div class="text-danger" id="image-err"></div>
                                                                 
                                                                @if (isset($about_us->image) && Storage::exists($about_us->image))
                                                                    <img src="{{ URL::asset('storage/' . $about_us->image) }}" class="img-fluid mt-3 mb-3" style="height:100px;" alt="">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control">Description <span class="required">*</span> </label>
                                                            <div class="col-md-10">
                                                                <textarea class="form-control" name="description"  cols="30" rows="10" >{!! $about_us->description ?? null !!}</textarea>
                                                                 <div class="text-danger" id="description-err"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control">Content <span class="required">*</span> </label>
                                                            <div class="col-md-10">
                                                                <textarea class="form-control" name="content" id="editor" cols="30" rows="10" >{!! $about_us->content ?? null !!}</textarea>
                                                                 <div class="text-danger" id="content-err"></div>
                                                            </div>
                                                        </div>
                                                        @if($language)
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control">Content ar <span class="required">*</span> </label>
                                                            <div class="col-md-10">
                                                                <textarea class="form-control" name="content_ar" id="editor_ar" cols="30" rows="10" >{!! $about_us->content_ar ?? null !!}</textarea>
                                                                 <div class="text-danger" id="content_ar-err"></div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control">Meta Title <span class="required">*</span></label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="Enter Meta Title" name="meta_title" value="{{ $about_us->meta->meta_title ?? null }}" >
                                                                 <div class="text-danger" id="meta_title-err"></div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                            <label class="col-md-2 label-control">Meta Description <span class="required">*</span></label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="Enter Meta Description" name="meta_description" value="{{ $about_us->meta->meta_description ?? null }}" >
                                                             <div class="text-danger" id="meta_description-err"></div>
                                                            </div>
                                                            </div>
                                                            <div class="form-group row">
                                                            <label class="col-md-2 label-control">Meta Keywords <span class="required">*</span></label>
                                                            <div class="col-md-4">
                                                                <input type="text" id="metakeywords" class="form-control" placeholder="Enter Meta Keywords" name="meta_keywords" value="{{ $about_us->meta->meta_keywords ?? null }}" >
                                                             <div class="text-danger" id="meta_keywords-err"></div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                            <label class="col-md-2 label-control">Canonical Tag <span class="required">*</span></label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="Enter Canonical Tag" name="canonical_tags" value="{{ $about_us->meta->canonical_tags ?? null }}" >
                                                             <div class="text-danger" id="canonical_tags-err"></div>
                                                            </div>
                                                            </div>
                                                            <div class="form-group row">
                                                            <label class="col-md-2 label-control">Twitter Cards <span class="required">*</span></label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="Enter Twitter Cards" name="twitter_cards" value="{{ $about_us->meta->twitter_cards ?? null }}" >
                                                             <div class="text-danger" id="twitter_cards-err"></div>
                                                            </div>
                                                            <div class="form-group row">
                                                            <label class="col-md-2 label-control">OG Tags <span class="required">*</span></label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="Enter OG Tags" name="og_tags" value="{{ $about_us->meta->og_tags ?? null }}" >
                                                                 <div class="text-danger" id="og_tags-err"></div>
                                                            </div>
                                                            </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-12 text-center">
                                                                <button type="submit" class="btn btn-primary update-aboutus">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@include('admin.footer')
<script>
    CKEDITOR.replace('editor', {
        filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form'
    });
     $(document).on("click", ".update-aboutus", function(event) {
    event.preventDefault();
    $('#title-err').html('');
     $('#sub_title-err').html('');
     $('#content-err').html('');
     $('#button_link-err').html('');
     $('#image-err').html('');
     $('#status-err').html('');
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            //  $(this).attr('disabled', true);
              var frm = $('#aboutform');
             var formData = new FormData(frm[0]);
            $.ajax({
                url: $('#aboutform').attr('action'),
                 type: 'POST',
                 processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        window.location = "{{ URL::to('admin/manage-about-us') }}";
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });
    
</script>
