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
                <h3 class="content-header-title mb-0">SERVICES</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            {{-- <li class="breadcrumb-item">Catalog</li> --}}
                            <li class="breadcrumb-item active">Manage Services</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">MANAGE - Services</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a href="{{url('admin/manage-services/create')}}" id="add-category"><i class="fa fa-plus"></i> Add </a></li>
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
                                                    <th>Service Icon</th>
                                                    <th>Service Name</th>
                                                    <th>Parent Category</th>
                                                    <th>Time Duration</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($categories) && count($categories) > 0)
                                                    @foreach ($categories as $category)
                                                        <tr>
                                                            <td>{{ $category->created_at }}</td>
                                                            <td>
                                                                @if (isset($category->image))
                                                                    <a href="javascript:void(0)" class="view-image" category_id="{{ $category->id }}">
                                                                        <img src="{{ asset('services_images/' . $category->image) }}" height="50" width="50">
                                                                    </a>
                                                                @else
                                                                    NA
                                                                @endif
                                                            </td>
                                                            <td>{{ $category->name }}</td>
                                                            <td>{{ \App\Models\Services::test($category->service_category_id) }}</td>
                                                            <td>{{ $category->service_time }}</td>
                                                            
                                                            
                                                            <td>{{ $category->status=="active" ? "Active":"De-Active" }}</td>
                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                <li><a href="{{route('admin.services.show',$category->id)}}" class="show-service" service_id="{{ $category->id }}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></li>

                                                                    {{-- <li><a href="{{ route('admin.manage-category.show', $category->id) }}" title="Children"><i class="fa fa-plus" aria-hidden="true"></i></a></li> --}}
                                                                    <li><a href="{{ route('admin.manage-services.edit', $category->id) }}"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $category->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" onclick="updateStatus({{ $category->id }})" title="Status">@if($category->status =="active")<i style="color:green" class="fa fa-check" aria-hidden="true"></i>@else <i style="color:red" class="fa fa-times" aria-hidden="true"></i> @endif</a></li>

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
<div id="category-modal" class="modal fade" role="dialog">
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
                    url: `{{ URL::to('admin/manage-services/change-status/${id}') }}`,
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
                    url: `{{ URL::to('admin/manage-services/${id}') }}`,
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
        $(document).on("click", "#add-category", function(event) {
            $.ajax({
                url: "{{ URL::to('admin/manage-services/create') }}",
                type: "GET",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#category-modal").html(result.html);
                        $("#category-modal").modal('show');
                    } else {

                    }
                }
            });
        });

        $(document).on('keyup', "#name", function(event) {
            let name = $(this).val();
            let slug = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $("#slug").val(slug);
        })

        $(document).on("keyup", "#meta_title", function(event) {
            let title = $(this).val();
            $('#meta_title-limit').html(`We recommend title between 50–60 characters.(${title.length} character)`);
        });

        $(document).on("keyup", "#meta_description", function(event) {
            let title = $(this).val();
            $('#meta_description-limit').html(`We recommend descriptions between 50–160 characters.(${title.length} character)`);
        });

        $(document).on("click", "#add-category-btn", function(event) {
            $(this).attr('disabled', true);
            $('.validation-err').html('');
            let formData = new FormData();
            formData.append('name', $('#name').val());
            formData.append('name_ar', $('#name_ar').val());
            formData.append('slug', $('#slug').val());
            formData.append('service_category_id', $('#service_category_id').val());
            formData.append('meta_title', $('#meta_title').val());
            formData.append('meta_keyword', $('#meta_keyword').val());
            formData.append('meta_description', $('#meta_description').val());
            formData.append('meta_title_ar', $('#meta_title_ar').val());
            formData.append('meta_keyword_ar', $('#meta_keyword_ar').val());
            formData.append('meta_description_ar', $('#meta_description_ar').val());
            formData.append('status', $('#status').val());
            formData.append('image', (typeof $('#image')[0].files[0] == 'undefined') ? '' : $('#image')[0].files[0]);
             formData.append('other_service', $('#other_service').prop('checked') == true ? 1 : 0);
            formData.append('value_added_service', $('#value_added_service').prop('checked') == true ? 1 : 0);
            $.ajax({
                url: "{{ URL::to('admin/manage-services') }}",
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

        $(document).on("click", ".edit-category", function(event) {
            let id = $(this).attr('category_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-services/${id}/edit') }}`,
                type: "get",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#category-modal").html(result.html);
                        $("#category-modal").modal('show');
                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
                error: function(error) {
                    toastr.error('error encountered ' + error.statusText);
                }
            });
        });

        $(document).on("click", "#update-category-btn", function(event) {
            $(this).attr('disabled', true);
            $('.validation-err').html('');
            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('name', $('#name').val());
            formData.append('name_ar', $('#name_ar').val());
            formData.append('slug', $('#slug').val());
            formData.append('service_category_id', $('#service_category_id').val());
            formData.append('meta_title', $('#meta_title').val());
            formData.append('meta_keyword', $('#meta_keyword').val());
            formData.append('meta_description', $('#meta_description').val());
            formData.append('meta_title_ar', $('#meta_title_ar').val());
            formData.append('meta_keyword_ar', $('#meta_keyword_ar').val());
            formData.append('meta_description_ar', $('#meta_description_ar').val());
            formData.append('status', $('#status').val());
            formData.append('image', (typeof $('#image')[0].files[0] == 'undefined') ? '' : $('#image')[0].files[0]);
            formData.append('other_service', $('#other_service').prop('checked') == true ? 1 : 0);
            formData.append('value_added_service', $('#value_added_service').prop('checked') == true ? 1 : 0);
            let category_id = $(this).attr('category_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-services/${category_id}') }}`,
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
