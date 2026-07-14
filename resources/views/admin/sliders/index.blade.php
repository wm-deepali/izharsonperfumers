@include('admin.header')
<style>
    .modal-body {
        max-height: 65vh;
        overflow-y: auto;
    }
</style>
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">CATALOG</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Content Management</li>
                            <li class="breadcrumb-item active">Manage Slider
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">MANAGE - SLIDER</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a href="javascript:void(0)" id="add-slider"><i class="fa fa-plus"></i> Add </a></li>
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
                                        <table class="table table-striped table-bordered" id="for_all">
                                            <thead>
                                                <tr>
                                                    <th>Date &amp; Time</th>
                                                    <th>Title</th>
                                                    <th>Sub-title</th>
                                                    <th>Image</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($sliders) && count($sliders) > 0)
                                                    @foreach ($sliders as $slider)
                                                        <tr>
                                                            <td>{{ $slider->created_at }}</td>
                                                            <td>{{ $slider->title }}</td>
                                                            <td>{{ $slider->sub_title }}</td>
                                                            <td>
                                                                @if (isset($slider->image) && Storage::exists($slider->image))
                                                                    <img src="{{ URL::asset('storage/' . $slider->image) }}"
                                                                        class="img-fluid" style="height:50px;">
                                                                @else
                                                                    NA
                                                                @endif
                                                            </td>
                                                            <td>{{ $slider->status }}</td>
                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="javascript:void(0)" class="edit-slider"
                                                                            slider_id="{{ $slider->id }}" title="Edit Slider"><i
                                                                                class="fa fa-pencil" aria-hidden="true"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0)"
                                                                            onclick="deleteConfirmation({{ $slider->id }})"
                                                                            title="Delete"><i class="fa fa-trash"
                                                                                aria-hidden="true"></i></a></li>
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
</div>
<div id="slider-modal" class="modal fade" role="dialog">
</div>
@include('admin.footer')
<script>
    function deleteConfirmation(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `{{ URL::to('admin/manage-slider/${id}') }}`,
                    type: "DELETE",
                    dataType: "json",
                    success: function (result) {
                        if (result.success) {
                            Swal.fire(
                                'Deleted!',
                                'success'
                            );
                            setTimeout(function () {
                                location.reload();
                            }, 400);
                        } else {
                            Swal.fire(result.msgText);
                        }
                    }
                });

            }
        })
    };
    $(document).ready(function () {
        $(document).on("click", "#add-slider", function (event) {
            $.ajax({
                url: "{{ URL::to('admin/manage-slider/create') }}",
                type: "GET",
                dataType: "json",
                success: function (result) {
                    if (result.success) {
                        $("#slider-modal").html(result.html);
                        $("#slider-modal").modal('show');
                    } else {

                    }
                }
            });
        });

        $(document).on("click", ".edit-slider", function (event) {
            let id = $(this).attr('slider_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-slider/${id}/edit') }}`,
                type: "get",
                dataType: "json",
                success: function (result) {
                    if (result.success) {
                        $("#slider-modal").html(result.html);
                        $("#slider-modal").modal('show');
                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
                error: function (error) {
                    toastr.error('error encountered ' + error.statusText);
                }
            });
        });
    });

    $(document).on("click", ".add-slider-btn", function (event) {
        event.preventDefault();
        $('#title-err').html('');
        $('#sub_title-err').html('');
        $('#content-err').html('');
        $('#button_link-err').html('');
        $('#image-err').html('');
        $('#status-err').html('');
        // for (instance in CKEDITOR.instances) {
        //     CKEDITOR.instances[instance].updateElement();
        // }
        //  $(this).attr('disabled', true);
        var frm = $('#addformslider');
        var formData = new FormData(frm[0]);
        $.ajax({
            url: $('#addformslider').attr('action'),
            type: 'POST',
            processData: false,
            contentType: false,
            dataType: 'json',
            data: formData,
            context: this,
            success: function (result) {
                if (result.success) {
                    window.location = "{{ URL::to('admin/manage-slider') }}";
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

    $(document).on("click", ".update-slider-btn", function (event) {
        event.preventDefault();
        $('#title-err').html('');
        $('#sub_title-err').html('');
        $('#content-err').html('');
        $('#button_link-err').html('');
        $('#image-err').html('');
        $('#status-err').html('');
        // for (instance in CKEDITOR.instances) {
        //     CKEDITOR.instances[instance].updateElement();
        // }
        //  $(this).attr('disabled', true);
        var frm = $('#updateslider');
        var formData = new FormData(frm[0]);
        $.ajax({
            url: $('#updateslider').attr('action'),
            type: 'POST',
            processData: false,
            contentType: false,
            dataType: 'json',
            data: formData,
            context: this,
            success: function (result) {
                if (result.success) {
                    window.location = "{{ URL::to('admin/manage-slider') }}";
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