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
                            <li class="breadcrumb-item active">Manage Customers</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">MANAGE - CUSTOMERS</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                          <!--   <li><a href="javascript:void(0)" class="add-brand"><i class="fa fa-plus"></i> Add </a></li> -->
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
                                                   <th>Date & Time</th>
                                                    <th>Customer Name</th>
                                                    <th>Email Id / <br/> Mobile Number </th>
                                                    
                                                    <th>Total Orders</th>
                                                    <!--<th>Total Bookings</th>-->
                                                    <!--<th>Reward Points</th>-->
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($customers) && count($customers) > 0)
                                                    @foreach ($customers as $cust)
                                                        <tr>
                                                            <td>{{ $cust->created_at }}</td>
                                                            <td>{{ $cust->name }}</td>
                                                            <td>{{ $cust->email }}<br />{{ $cust->mobile_number }} </td>
                                                           
                                                            <td>{{ count($cust->orders) }}</td>
                                                            <!--<td>{{ count($cust->services)+count($cust->oilgradeservices) }}</td>-->
                                                            <!--<td>0</td>-->
                                                            <td>{{ ucfirst($cust->status) }}</td>
        
                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="{{url('admin/manage-customers/'.$cust->id)}}" class="view-orders" brand_id="{{ $cust->id }}" title="View order details  "><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $cust->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>

                                                                    <!--<li><a href="{{url('admin/customer-orders/'.$cust->id)}}" class="view-orders" brand_id="{{ $cust->id }}" title="View order details  "><i class="fa fa-eye" aria-hidden="true"></i></a></li>-->
                                                                    <!--<li><a href="{{route('admin.customer.service',$cust->id)}}" class="view-orders" brand_id="{{ $cust->id }}" title="View service details  "><i class="fa fa-eye" aria-hidden="true"></i></a></li>-->
                                                                    <!--<li><a href="javascript:void(0)" class="edit-brand" brand_id="{{ $cust->id }}" title="Edit customer details "><i class="fa fa-pencil" aria-hidden="true"></i></a></li>-->
                                                                 
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @else 
                                                    No  data  found!
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
                    url: `{{ URL::to('admin/manage-customers/${id}') }}`,
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
        // $(document).on("click", ".add-brand", function(event) {
        //     $.ajax({
        //         url: "{{ URL::to('admin/manage-customer/create') }}",
        //         type: "GET",
        //         dataType: "json",
        //         success: function(result) {
        //             if (result.success) {
        //                 $("#brand-modal").html(result.html);
        //                 $("#brand-modal").modal('show');
        //             } else {

        //             }
        //         }
        //     });
        // });

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

        // $(document).on("click", ".add-brand-btn", function(event) {
        //     $(this).attr('disabled', true);
        //     $('#name-err').html('');
        //     $('#url-err').html('');
        //     $('#image-err').html('');
        //     $('#meta_title-err').html('');
        //     $('#meta_keyword-err').html('');
        //     $('#meta_description-err').html('');
        //     $('#status-err').html('');
        //     let formData = new FormData();
        //     formData.append('name', $('#name').val());
        //     formData.append('url', $('#url').val());
        //     formData.append('meta_title', $('#meta_title').val());
        //     formData.append('meta_keyword', $('#meta_keyword').val());
        //     formData.append('meta_description', $('#meta_description').val());
        //     formData.append('status', $('#status').val());
        //     formData.append('image', (typeof $('#image')[0].files[0] == 'undefined') ? '' : $('#image')[0].files[0]);
        //     $.ajax({
        //         url: "{{ URL::to('admin/manage-brand') }}",
        //         type: 'POST',
        //         processData: false,
        //         contentType: false,
        //         dataType: 'json',
        //         data: formData,
        //         context: this,
        //         success: function(result) {
        //             if (result.success) {
        //                 location.reload();
        //             } else {
        //                 $(this).attr('disabled', false);
        //                 if (result.code == 422) {
        //                     for (const key in result.errors) {
        //                         $(`#${key}-err`).html(result.errors[key][0]);
        //                     }
        //                 } else {
        //                     console.log(result);
        //                 }
        //             }
        //         }
        //     });
        // });

        $(document).on("click", ".edit-brand", function(event) {
            let id = $(this).attr('brand_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-customer/${id}') }}`,
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
            var _token = '{{ csrf_token() }}';
            
            let formData = new FormData();
            // formData.append('_method', 'PUT');
            formData.append('_token', _token);
            formData.append('name', $('#name').val());
            formData.append('email', $('#email').val());
            formData.append('mobile', $('#mobile').val());
            formData.append('status', $('#status').val());
            formData.append('password', $('#password').val());
            // formData.append('image', (typeof $('#image')[0].files[0] == 'undefined') ? '' : $('#image')[0].files[0]);
            
            let brand_id = $(this).attr('brand_id');
            // console.log(form_data);return false;
            $.ajax({
                url: `{{ URL::to('admin/update-customer/${brand_id}') }}`,
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    // console.log(result);return false;
                    if (result.success) {
                        Swal.fire(
                            'Updated!',
                            'success'
                        );
                        setTimeout(function() {
                            location.reload();
                        }, 400);
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
