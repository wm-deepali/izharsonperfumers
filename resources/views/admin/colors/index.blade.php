@include('admin.header')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">Catalog</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Catalog</li>
                            <li class="breadcrumb-item active">Manage Colors
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">MANAGE - COLORS</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a href="javascript:void(0)" id="add-color"><i class="fa fa-plus"></i> Add </a></li>
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
                                                    <th>Name</th>
                                                    <th>Code</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($colors) && count($colors) > 0)
                                                    @foreach ($colors as $color)
                                                        <tr>
                                                            <td>{{ $color->created_at }}</td>
                                                            <td>{{ $color->name }}</td>
                                                            <td>{{ $color->code }}</td>
                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="javascript:void(0)" class="edit-color" color_id="{{ $color->id }}" title="Edit color"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $color->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
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
<div id="color-modal" class="modal fade" role="dialog">
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
                    url: `{{ URL::to('admin/manage-color/${id}') }}`,
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
        $(document).on("click", "#add-color", function(event) {
            $.ajax({
                url: "{{ URL::to('admin/manage-color/create') }}",
                type: "GET",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#color-modal").html(result.html);
                        $("#color-modal").modal('show');
                    } else {

                    }
                }
            });
        });

        $(document).on("click", ".edit-color", function(event) {
            let id = $(this).attr('color_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-color/${id}/edit') }}`,
                type: "get",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#color-modal").html(result.html);
                        $("#color-modal").modal('show');
                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
                error: function(error) {
                    toastr.error('error encountered ' + error.statusText);
                }
            });
        });
    });
</script>
