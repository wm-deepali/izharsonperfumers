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
                            <section>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card-body collapse in">
                                <div class="card-block card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Date &amp; Time</th>
                                                    <th>Page</th>
                                                    <th>Heading</th>
                                                    <th>Content</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($homepage_setting) && count($homepage_setting) > 0)
                                                    @foreach ($homepage_setting as $data)
                                                        <tr>
                                                            <td>{{ $data->created_at }}</td>
                                                            <td>{{ $data->page }}</td>
                                                            <td>{{ $data->heading }}</td>
                                                            <td>{!! Str::limit($data->content,80) !!}</td>
                                                            <!--<td>-->
                                                            <!--    @if (isset($data->image) && Storage::exists($data->image))-->
                                                            <!--        <img src="{{ URL::asset('storage/' . $data->image) }}" class="img-fluid" style="height:50px;">-->
                                                            <!--    @else-->
                                                            <!--        NA-->
                                                            <!--    @endif-->
                                                            <!--</td>-->
                                                            
                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="{{route('admin.manage-homepage-setting.edit',$data->id)}}" class="edit-garage" garage_id="{{ $data->id }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                                    <!--<li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $data->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>-->
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@include('admin.footer')
<script>
 CKEDITOR.replace('content1', {
            filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
         CKEDITOR.replace('content2', {
            filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
         CKEDITOR.replace('content3', {
            filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
         CKEDITOR.replace('content4', {
            filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('content5', {
            filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('content6', {
            filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('content7', {
            filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
        
        
        
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ajaxStart(function() {
        $("#loader").modal('show');
    });
    $(document).ajaxComplete(function() {
        $("#loader").modal('hide');
    });
    $(document).ready(function() {
        $(document).on("click", ".update-widget-btn", function(event) {
            $(this).attr('disabled', true);
            $('#heading1-err').html('');
            $('#subtitle1-err').html('');
            $('#showas1-err').html('');
            $('#category1-err').html('');
            $('#heading2-err').html('');
            $('#subtitle2-err').html('');
            $('#showas2-err').html('');
            $('#category2-err').html('');
            $('#heading3-err').html('');
            $('#subtitle3-err').html('');
            $('#showas3-err').html('');
            $('#category3-err').html('');
            $('#heading4-err').html('');
            $('#subtitle4-err').html('');
            $('#showas4-err').html('');
            $('#category4-err').html('');
            let formData = new FormData();
            formData.append('heading1', $('#heading1').val());
            formData.append('subtitle1', $('#subtitle1').val());
            formData.append('showas1', $('#showas1').val());
            formData.append('category1', $(".category1:checked").map(function() {
                return $(this).val();
            }).toArray());
            formData.append('heading2', $('#heading2').val());
            formData.append('subtitle2', $('#subtitle2').val());
            formData.append('showas2', $('#showas2').val());
            formData.append('category2', $(".category2:checked").map(function() {
                return $(this).val();
            }).toArray());
            formData.append('heading3', $('#heading3').val());
            formData.append('subtitle3', $('#subtitle3').val());
            formData.append('showas3', $('#showas3').val());
            formData.append('category3', $(".category3:checked").map(function() {
                return $(this).val();
            }).toArray());
            formData.append('heading4', $('#heading4').val());
            formData.append('subtitle4', $('#subtitle4').val());
            formData.append('showas4', $('#showas4').val());
            formData.append('category4', $(".category4:checked").map(function() {
                return $(this).val();
            }).toArray());
            $.ajax({
                url: "{{ URL::to('submit-homepage-widget') }}",
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
                        if (result.errors.heading1) {
                            $('#heading1-err').html(result.errors.heading1[0]);
                        }
                        if (result.errors.subtitle1) {
                            $('#subtitle1-err').html(result.errors.subtitle1[0]);
                        }
                        if (result.errors.showas1) {
                            $('#showas1-err').html(result.errors.showas1[0]);
                        }
                        if (result.errors.category1) {
                            $('#category1-err').html(result.errors.category1[0]);
                        }
                        if (result.errors.heading2) {
                            $('#heading2-err').html(result.errors.heading2[0]);
                        }
                        if (result.errors.subtitle2) {
                            $('#subtitle2-err').html(result.errors.subtitle2[0]);
                        }
                        if (result.errors.showas2) {
                            $('#showas2-err').html(result.errors.showas2[0]);
                        }
                        if (result.errors.category2) {
                            $('#category2-err').html(result.errors.category2[0]);
                        }
                        if (result.errors.heading3) {
                            $('#heading3-err').html(result.errors.heading3[0]);
                        }
                        if (result.errors.subtitle3) {
                            $('#subtitle3-err').html(result.errors.subtitle3[0]);
                        }
                        if (result.errors.showas3) {
                            $('#showas3-err').html(result.errors.showas3[0]);
                        }
                        if (result.errors.category3) {
                            $('#category3-err').html(result.errors.category3[0]);
                        }
                        if (result.errors.heading4) {
                            $('#heading4-err').html(result.errors.heading4[0]);
                        }
                        if (result.errors.subtitle4) {
                            $('#subtitle4-err').html(result.errors.subtitle4[0]);
                        }
                        if (result.errors.showas4) {
                            $('#showas4-err').html(result.errors.showas4[0]);
                        }
                        if (result.errors.category4) {
                            $('#category4-err').html(result.errors.category4[0]);
                        }
                    }
                }
            });
        });
    });
</script>
