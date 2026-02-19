@include('admin.header')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">STORE SETUP</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">STORE SETUP</li>
                            <li class="breadcrumb-item active">Manage Pincode
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">MANAGE - PINCODE</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a href="javascript:void(0)" id="add-pincode"><i class="fa fa-plus"></i> Add Pincode </a></li>
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
                                                    <th>State</th>
                                                    <th>City</th>
                                                    <th>Pincode</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($pincodes) && count($pincodes))
                                                    @foreach ($pincodes as $pincode)
                                                        <tr>
                                                            <td>{{ $pincode->created_at }}</td>
                                                            <td>{{ $pincode->state->name ?? '-' }}</td>
                                                            <td>{{ $pincode->city->name ?? '-' }}</td>
                                                            <td>{{ $pincode->pincode }}</td>
                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="javascript:void(0)" class="edit-pincode" pincode_id="{{ $pincode->id }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $pincode->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
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
<div id="pincode-modal" class="modal fade" role="dialog">
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
                    url: `{{ URL::to('admin/manage-pincode/${id}') }}`,
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
        $(document).on("click", "#add-pincode", function(event) {
            $.ajax({
                url: "{{ URL::to('admin/manage-pincode/create') }}",
                type: "GET",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#pincode-modal").html(result.html);
                        $("#pincode-modal").modal('show');
                    } else {

                    }
                }
            });
        });

        $(document).on("click", "#add-pincode-btn", function(event) {
            $(this).attr('disabled', true);
            $('.validation-err').html('');
            let formData = new FormData();
            formData.append('state', $('#state').val());
            formData.append('city', $('#city').val());
            formData.append('pincode', $('#pincode').val());
            formData.append('status', $('#status').val());
            $.ajax({
                url: "{{ URL::to('admin/manage-pincode') }}",
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


        $(document).on("click", ".edit-pincode", function(event) {
            let id = $(this).attr('pincode_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-pincode/${id}/edit') }}`,
                type: "get",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#pincode-modal").html(result.html);
                        $("#pincode-modal").modal('show');
                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
                error: function(error) {
                    toastr.error('error encountered ' + error.statusText);
                }
            });
        });

        $(document).on("click", "#update-pincode-btn", function(event) {
            $(this).attr('disabled', true);
            $('.validation-err').html('');
            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('state', $('#state').val());
            formData.append('city', $('#city').val());
            formData.append('pincode', $('#pincode').val());
            formData.append('status', $('#status').val());
            let pincode_id = $(this).attr('pincode_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-pincode/${pincode_id}') }}`,
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

        $(document).on("change", "#state", function(event) {
            let state_id = $(this).val();
            $.ajax({
                url: `{{ URL::to('cities-by-state/${state_id}') }}`,
                type: "get",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#city").html(result.html);
                    }
                }
            });
        });

    });
</script>
