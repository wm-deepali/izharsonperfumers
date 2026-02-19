@include('admin.header')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">Manage Return & Cancellation</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            {{-- <li class="breadcrumb-item">Reasons Categories</li> --}}
                            <li class="breadcrumb-item active">Manage Reasons Categories</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <section>
                    <div class="row">
                        <div class="col-xs-12">
                            <!--<div class="card-header">-->
                            <!--    <div class="add-reason"><span data-toggle="modal" data-target="#addReason">Add <i class="fa fa-plus"></i></span</div>-->
                            <!--</div>-->
                            <div class="card-header">
                    <h4 class="card-title">Manage Reasons Categories</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a href="#" class="add-faq" data-toggle="modal" data-target="#addReason"><i class="fa fa-plus"></i> Add </a></li>
                            <li><a href="#"><i class="fa fa-backward" ></i> Go Back</a></li>
                        </ul>
                    </div>
                </div>
                            <div class="card-body collapse in">
                                <div class="card-block card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Date &amp; Time</th>
                                                    <th>Reason Type</th>
                                                    
                                                    <th>Reasons</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($reasons as $reason)
                                                <tr>
                                                    <td>{{$reason->created_at}}</td>
                                                    <td>{{$reason->type}}</td>
                                                    
                                                    <td>{{$reason->title}}</td>
                                                    <td>{{$reason->status=="active"? "Active" : "De-Active"}}</td>
                                                    <td class="text-truncate">
                                                        <ul class="actions">
                                                        <li><a href="javascript:void(0)" class="show-reason" reason_id="{{ $reason->id }}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" class="edit-reason" reason_id="{{ $reason->id }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $reason->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" onclick="updateStatus({{ $reason->id }})" title="Status">@if($reason->status =="active")<i style="color:green" class="fa fa-check" aria-hidden="true"></i>@else <i style="color:red" class="fa fa-times" aria-hidden="true"></i> @endif</a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                
                                                @endforeach
                                                
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
<!-- Modal -->
<div class="modal fade" id="addReason" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reason Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-25px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="reasonOptions">
            <form>
                @csrf
                <div class="form-group">
                <label for="exampleFormControlSelect1">Select Reason Type</label>
                <select class="form-control" name="type" id="type">
                    <option value="">Select</option>
                  <option value="return">Return </option>
                  <option value="cancelled">Cancelled</option>
                </select>
                <div class="text-danger validation-err" id="type-err"></div>
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Enter Reason Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Reason Title">
                <div class="text-danger validation-err" id="title-err"></div>
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Status</label>
                <select class="form-control" name="status" id="status">
                    <option value="">Select</option>
                    <option value="active">Active</option>
                    <option value="block">De-Active</option>
                </select>
                <div class="text-danger validation-err" id="status-err"></div>
              </div>
              <div class="form-group">
                <button type="button" id="add-reason-btn" class="btn adminbtn-blue btn-lg">Submit</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="reason-modal" class="modal fade" role="dialog">
</div>
@include('admin.footer')
<script>
   $(document).on("click", "#add-reason-btn", function(event) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $(this).attr('disabled', true);
            $('#title-err').html('');
            $('#type-err').html('');
            $('#status-err').html('');
            let formData = new FormData();
            formData.append('title', $('#title').val());
            formData.append('type', $('#type').val());
            formData.append('status', $('#status').val());
            formData.append('category', "e-commerce");
            $.ajax({
                url: "{{route('admin.manage-reasons-category.store')}}",
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
        
        $(document).on("click", ".edit-reason", function(event) {
            let id = $(this).attr('reason_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-reasons-category/${id}/edit') }}`,
                type: "get",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#reason-modal").html(result.html);
                        $("#reason-modal").modal('show');
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
                    url: `{{ URL::to('admin/manage-reasons-category/${id}') }}`,
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
    
    $(document).on("click", "#update-reason-btn", function(event) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $(this).attr('disabled', true);
             $('.reasonupdate #title-err').html('');
            $('.reasonupdate #type-err').html('');
            $('.reasonupdate #status-err').html('');
            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('title', $('.reasonupdate #title').val());
            formData.append('type', $('.reasonupdate #type').val());
            formData.append('status', $('.reasonupdate #status').val());
            formData.append('category', "e-commerce");
            let reason_id = $(this).attr('reason_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-reasons-category/${reason_id}') }}`,
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
                                $(`.reasonupdate #${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });

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
                    url: `{{ URL::to('admin/manage-reasons-category/change-status/${id}') }}`,
                    type: "POST",
                    dataType: "json",
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
    
    $(document).on("click", ".show-reason", function(event) {
            let id = $(this).attr('reason_id');
            $.ajax({
                url: `{{ url('admin/manage-reasons-category/${id}') }}`,
                type: "get",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#reason-modal").html(result.html);
                        $("#reason-modal").modal('show');
                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
                error: function(error) {
                    toastr.error('error encountered ' + error.statusText);
                }
            });
        });
</script>