@include('admin.header')
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
                            <li class="breadcrumb-item active">Manage Volume</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">MANAGE - Volume</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a href="javascript:void(0)" class="add-brand"><i class="fa fa-plus"></i> Add </a></li>
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
                                                    <th>Quantity</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($brands) && count($brands) > 0)
                                                    @foreach ($brands as $brand)
                                                        <tr>
                                                            <td>{{ $brand->created_at }}</td>
                                                            
                                                            <td>{{ $brand->quantity.$brand->quantity_in }}</td>
                                                           
                                                            
                                                            <td>{{ $brand->status=="active" ? "Active" : "De-Active" }}</td>
                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="javascript:void(0)" class="show-brand" brand_id="{{ $brand->id }}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" class="edit-brand" brand_id="{{ $brand->id }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $brand->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" onclick="updateStatus({{ $brand->id }})" title="Status">@if($brand->status =="active")<i style="color:green" class="fa fa-check" aria-hidden="true"></i>@else <i style="color:red" class="fa fa-times" aria-hidden="true"></i> @endif</a></li>
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
<div id="brand-modal" class="modal fade" role="dialog">
</div>
@include('admin.footer')
<script>
    function updateStatus(id){
        Swal.fire({
            title: 'Are you sure?',
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `{{ URL::to('admin/manage-brand/change-status/${id}') }}`,
                    type: "POST",
                    brandType: "json",
                    success: function(result) {
                        if (result.success) {
                            Swal.fire(
                                "Status changed Succesfully"
                            );
                            setTimeout(function() {
                                location.reload();
                            }, 40);
                        } else {
                            Swal.fire(result.msgText);
                        }
                    }
                });

            }
        }) 
    }
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
                    url: `{{ URL::to('admin/manage-brand/${id}') }}`,
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
    $(document).ready(function(event) {
        $(document).on("click", ".add-brand", function(event) {
            $.ajax({
                url: "{{ URL::to('admin/manage-brand/create') }}",
                type: "GET",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#brand-modal").html(result.html);
                        $("#brand-modal").modal('show');
                    } else {

                    }
                }
            });
        });

        $(document).on('keyup', "#name", function(event) {
            let name = $(this).val();
            let url = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $("#url").val(url);
        })

        $(document).on("keyup", "#meta_title", function(event) {
            let title = $(this).val();
            $('#meta_title-limit').html(`We recommend title between 50–60 characters.(${title.length} character)`);
        });

        $(document).on("keyup", "#meta_description", function(event) {
            let title = $(this).val();
            $('#meta_description-limit').html(`We recommend descriptions between 50–160 characters.(${title.length} character)`);
        });

        $(document).on("click", ".add-brand-btn", function(event) {
            $(this).attr('disabled', true);
            $('#quantity-err').html('');
            $('#quantity_in-err').html('');
            $('#status-err').html('');
            let formData = new FormData();
            formData.append('quantity', $('#quantity').val());
            formData.append('quantity_in', $('#quantity_in').val());
            formData.append('status', $('#status').val());
            $.ajax({
                url: "{{ URL::to('admin/manage-brand') }}",
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

        $(document).on("click", ".edit-brand", function(event) {
            let id = $(this).attr('brand_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-brand/${id}/edit') }}`,
                type: "get",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#brand-modal").html(result.html);
                        $("#brand-modal").modal('show');
                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
                error: function(error) {
                    toastr.error('error encountered ' + error.statusText);
                }
            });
        });

        $(document).on("click", ".show-brand", function(event) {
            let id = $(this).attr('brand_id');
            $.ajax({
                url: `{{ url('admin/manage-brand/${id}') }}`,
                type: "get",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#brand-modal").html(result.html);
                        $("#brand-modal").modal('show');
                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
                error: function(error) {
                    toastr.error('error encountered ' + error.statusText);
                }
            });
        });

        $(document).on("click", "#update-brand-btn", function(event) {
            $(this).attr('disabled', true);
            $('#quantity-err').html('');
            $('#quantity_in-err').html('');
            $('#status-err').html('');
            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('quantity', $('#quantity').val());
            formData.append('quantity_in', $('#quantity_in').val());
            formData.append('status', $('#status').val());
            let brand_id = $(this).attr('brand_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-brand/${brand_id}') }}`,
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
                            console.log(error);
                        }
                    }
                }
            });
        });
    });
</script>
