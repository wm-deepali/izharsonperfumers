@include('admin.header')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">HOMEPAGE</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Homepage Setting</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="horizontal-form-layouts">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>HOMEPAGE SETTING</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                          <li><a data-action="reload" href="javascript:location.reload()"><i class="fa fa-refresh"></i> Refresh</a></li>
                                        <li><a href="javascript:history.go(-1)"><i class="fa fa-backward"></i> Go Back</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body collapse in">
                                <div class="card-block">
                                    <!--<h4 class="form-section"><i class="fa fa-chevron-right"></i> Setting</h4>-->
                                    <!--<hr />-->
                                    <form id="widgetform" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label class="label label-control">Page</label>
                                                <input type="text" class="form-control" value="{{ $homepage_setting->page ?? '' }}" placeholder="Enter page" name="page" id="page" readonly>
                                                <div class="text-danger" id="page-err"></div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="label label-control">Heading</label>
                                                <input type="text" class="form-control" value="{{ $homepage_setting->heading ?? '' }}" placeholder="Enter Heading" name="heading" id="heading">
                                                <div class="text-danger" id="heading-err"></div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="label label-control">Button Text</label>
                                                <input type="text" class="form-control" value="{{ $homepage_setting->url_txt ?? '' }}" placeholder="Enter Button Text" name="url_txt" id="url_txt">
                                                <div class="text-danger" id="url_txt-err"></div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="label label-control">Button Url</label>
                                                <input type="text" class="form-control" value="{{ $homepage_setting->url ?? '' }}" placeholder="Enter Button" name="url" id="url">
                                                <div class="text-danger" id="url-err"></div>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="label label-control">Image</label>
                                                <input type="file" class="form-control"  name="image" id="image">
                                                <div class="text-danger" id="image-err"></div>
                                            </div>
                                            @if($homepage_setting->image)
                                             <div class="col-sm-4">
                                                <img src="{{ URL::asset('storage/' . $homepage_setting->image) }}" class="img-fluid" style="height:50px;">
                                            </div>
                                            @endif
                                            
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="label label-control">Content</label>
                                               <textarea class="form-control" name="content" id="content">{{$homepage_setting->content}}</textarea>
                                                <div class="text-danger" id="content-err"></div>
                                            </div>

                                            

                                            
                                        </div>

                                      

                                        <div class="form-group row">
                                            <div class="col-sm-12 text-center">
                                                <button type="button" widget_id="{{$homepage_setting->id}}" class="btn btn-primary update-widget-btn">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@include('admin.footer')
<script>
CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    // $(document).ajaxStart(function() {
    //     $("#loader").modal('show');
    // });
    // $(document).ajaxComplete(function() {
    //     $("#loader").modal('hide');
    // });
   $(document).on("click", ".update-widget-btn", function(event) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            let id = $(this).attr('widget_id');
            //  $(this).attr('disabled', true);
              var frm = $('#widgetform');
             var formData = new FormData(frm[0]);
            formData.append('image', (typeof $('#image')[0].files[0] == 'undefined') ? '' : $('#image')[0].files[0]);
             formData.append('_method', 'PUT');
            $.ajax({
                url: `{{ URL::to('admin/manage-homepage-setting/${id}') }}`,
                 type: 'POST',
                 processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        window.location = "{{ URL::to('admin/manage-homepage-setting') }}";
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
