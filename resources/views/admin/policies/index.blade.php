@include('admin.header')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">MANAGE POLICY</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">DASHBOARD</a></li>
                            <li class="breadcrumb-item">CONTENT MANAGEMENT</li>
                            <li class="breadcrumb-item active">MANAGE POLICY
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">CONTENT MANAGEMENT - {{ Str::title(str_replace('_', ' ', $name)) }}</h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <section>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card-body collapse in">
                                <div class="card-block card-dashboard">
                                    <div class="table-responsive">
                                        <form method="post" action="{{ route('admin.manage-policy', $name) }}" id="policyform">
                                            @csrf
                                            <div class="form-group row">

                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                    <label class="label-control">Title </label>
                                                    <input type="text" class="form-control" placeholder="Enter Title"
                                                        name="title" value="{{ $policy->title }}">
                                                    <div class="text-danger validation-err" id="title-err">

                                                    </div>
                                                </div>
                                                @if($language)
                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                    <label class="label-control">Title Arabic </label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Title Arabic" name="title_ar"
                                                        value="{{ $policy->title_ar }}">
                                                    <div class="text-danger validation-err" id="title_ar-err">

                                                    </div>
                                                </div>
                                                @endif

                                            </div>

                                            <label class="label-control">Description </label>
                                            <textarea id="editor" class="form-control" placeholder="Add description"
                                                name="content">{{ $policy->content ?? null }}</textarea>
                                         <div class="text-danger validation-err" id="content-err">
                                            @if($language)
                                            <label class="label-control">Description Arabic</label>
                                            <textarea id="editor" class="form-control" placeholder="Add description"
                                                name="content_ar">{{ $policy->content_ar ?? null }}</textarea>
                                                 <div class="text-danger validation-err" id="content_ar-err">
                                            @endif
                                            <button type="submit" class="btn btn-primary updatepolicy-btn">Update</button>
                                        </form>
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
@include('admin.footer')
<script>
CKEDITOR.replace('editor', {
    filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
    filebrowserUploadMethod: 'form'
});

 $(document).on("click", ".updatepolicy-btn", function(event) {
    event.preventDefault();
    $('#faq_category-err').html('');
     $('#question-err').html('');
     $('#answer-err').html('');
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            //  $(this).attr('disabled', true);
              var frm = $('#policyform');
             var formData = new FormData(frm[0]);
            $.ajax({
                url: $('#policyform').attr('action'),
                 type: 'POST',
                 processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        location.reload();
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