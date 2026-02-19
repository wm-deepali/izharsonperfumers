@include('admin.header')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">Manage Fleet Service</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Service Management</li>
                            <li class="breadcrumb-item active">Manage Fleet Service</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Content Management - Manage Fleet Service</h4>
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
                                                <form method="post" action="{{ route('admin.manage-service-fleets.store') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-body">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control">Title *</label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="Enter Title" name="title" value="{{ $fleets->title ?? null }}" required>
                                                            </div>
                                                            <div class="form-group row">
                                                                @if($language)
                                                                <label class="col-md-2 label-control">Title ar*</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" placeholder="Enter Title Arabic" name="title_ar" value="{{ $fleets->title_ar ?? null }}" required>
                                                                </div>
                                                                @endif

                                                            <label class="col-md-2 label-control">Image</label>
                                                            <div class="col-md-4">
                                                                <input type="file" class="form-control" name="image">
                                                                @if (isset($fleets->image) && Storage::exists($fleets->image))
                                                                    <img src="{{ URL::asset('storage/' . $fleets->image) }}" class="img-fluid" style="height:100px;" alt="">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control">Content * </label>
                                                            <div class="col-md-10">
                                                                <textarea class="form-control" name="content" id="editor" cols="30" rows="10" required>{!! $fleets->content ?? null !!}</textarea>
                                                            </div>
                                                        </div>
                                                        @if($language)
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control">Content ar* </label>
                                                            <div class="col-md-10">
                                                                <textarea class="form-control" name="content_ar" id="editor_ar" cols="30" rows="10" required>{!! $fleets->content_ar ?? null !!}</textarea>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control">Meta Title *</label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="Enter Meta Title" name="meta_title" value="{{ $fleets->meta_title ?? null }}" >
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                            <label class="col-md-2 label-control">Meta Description *</label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="Enter Meta Description" name="meta_description" value="{{ $fleets->meta_description ?? null }}" >
                                                            </div>
                                                            </div>
                                                            <div class="form-group row">
                                                            <label class="col-md-2 label-control">Meta Keywords *</label>
                                                            <div class="col-md-4">
                                                                <input type="text" id="metakeywords" class="form-control" placeholder="Enter Meta Keywords" name="meta_keywords" value="{{ $fleets->meta_keywords ?? null }}" >
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                            <label class="col-md-2 label-control">Canonical Tag *</label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="Enter Canonical Tag" name="canonical_tags" value="{{ $fleets->canonical_tags ?? null }}" >
                                                            </div>
                                                            </div>
                                                            <div class="form-group row">
                                                            <label class="col-md-2 label-control">Twitter Cards *</label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="Enter Twitter Cards" name="twitter_cards" value="{{ $fleets->twitter_cards ?? null }}" >
                                                            
                                                            </div>
                                                            <div class="form-group row">
                                                            <label class="col-md-2 label-control">OG Tags *</label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" placeholder="Enter OG Tags" name="og_tags" value="{{ $fleets->og_tags ?? null }}" >
                                                            </div>
                                                            </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-12 text-center">
                                                                <button type="submit" class="btn btn-primary">Submit</button>
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
    
</script>
