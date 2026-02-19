@include('admin.header')
<style>
    /* Important part */
.modal-dialog{
    overflow-y: initial !important
}
.modal-body{
    height: 80vh;
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
                            <li class="breadcrumb-item">Catalog</li>
                            <li class="breadcrumb-item active">Manage PROMOTION
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">MANAGE - PROMOTION</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a href="javascript:void(0)" class="add-promotion"><i class="fa fa-plus"></i> Add </a></li>
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
                                                    <th>Promotion Name</th>
                                                    <th>Promotion Validity</th>
                                                    <th>Promotion URL</th>
                                                    <th>Promotion Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($datas) && count($datas) > 0)
                                                    @foreach ($datas as $data)
                                                        <tr>
                                                            <td>{{ $data->created_at }}</td>
                                                            <td>{{ $data->name }}</td>
                                                            <td>{{ date('d/m/Y',strtotime($data->validity)) }}</td>
                                                            <td>{{ $data->url }}</td>
                                                            <td>
                                                                
                                                        @if(isset($data->image))
                                                            <a href="javascript:void(0)">
                                                                <img src="{{ URL::asset('storage/' . $data->image) }}" class="img-fluid"style="height:50px;" />
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0)">
                                                                <img src="{{ URL::asset('front/images/no_image.jpg') }}" class="img-fluid">
                                                            </a>
                                                        @endif
                                                                                        
                                                            </td>
                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="javascript:void(0)" class="show-promotion" promotion_id="{{ $data->id }}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" class="edit-promotion" promotion_id="{{ $data->id }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $data->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
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
<div id="promotion-modal" class="modal fade" role="dialog">
</div>
@include('admin.footer')
<script>
    $(document).on("click", ".show-promotion", function(event) {
            let id = $(this).attr('promotion_id');
            $.ajax({
                url: `{{ url('admin/manage-promotion/${id}') }}`,
                type: "get",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#promotion-modal").html(result.html);
                        $("#promotion-modal").modal('show');
                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
                error: function(error) {
                    toastr.error('error encountered ' + error.statusText);
                }
            });
        });

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
                    url: `{{ URL::to('admin/manage-promotion/${id}') }}`,
                    type: "DELETE",
                    dataType: "json",
                    success: function(result) {
                        if (result.success) {
                            Swal.fire(
                                'Deleted!',
                                'success'
                            );
                            setTimeout(function() {
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
    $(document).ready(function() {
        $(document).on('keyup', "#title", function(event) {
            let title = $(this).val();
            let url = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $("#url").val(url);
        })

        $(document).on("click", ".add-promotion", function(event) {
            $.ajax({
                url: "{{ URL::to('admin/manage-promotion/create') }}",
                type: "GET",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#promotion-modal").html(result.html);
                        $("#promotion-modal").modal('show');
                    } else {

                    }
                }
            });
        });

        $(document).on("click", "#add-promotion-btn", function(event) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
             $(this).attr('disabled', true);
            $('#name-err').html('');
            $('#name_ar-err').html('');
            $('#url-err').html('');
            $('#image-err').html('');
            $('#detail-err').html('');
            $('#detail-ar-err').html('');
            $('#validity-err').html('');
            let formData = new FormData();
            formData.append('name', $('#name').val());
            formData.append('name_ar', $('#name_ar').val());
            formData.append('url', $('#url').val());
            formData.append('detail', $('#detail').val());
            formData.append('detail_ar', $('#detail_ar').val());
            formData.append('validity', $('#validity').val());
            formData.append('image', (typeof $('#image')[0].files[0] == 'undefined') ? '' : $('#image')[0].files[0]);
            $.ajax({
                url: "{{ URL::to('admin/manage-promotion') }}",
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

        $(document).on("click", ".edit-promotion", function(event) {
            let id = $(this).attr('promotion_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-promotion/${id}/edit') }}`,
                type: "get",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#promotion-modal").html(result.html);
                        $("#promotion-modal").modal('show');
                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
                error: function(error) {
                    toastr.error('error encountered ' + error.statusText);
                }
            });
        });

        $(document).on("click", "#update-promotion-btn", function(event) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $(this).attr('disabled', true);
            $('#name-err').html('');
            $('#name_ar-err').html('');
            $('#url-err').html('');
            $('#image-err').html('');
            $('#detail-err').html('');
            $('#detail-ar-err').html('');
            $('#validity-err').html('');
            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('name', $('#name').val());
            formData.append('name_ar', $('#name_ar').val());
            formData.append('url', $('#url').val());
            formData.append('detail', $('#detail').val());
            formData.append('detail_ar', $('#detail_ar').val());
            formData.append('validity', $('#validity').val());
            formData.append('image', (typeof $('#image')[0].files[0] == 'undefined') ? '' : $('#image')[0].files[0]);
            let promotion_id = $(this).attr('promotion_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-promotion/${promotion_id}') }}`,
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
    });


</script>
