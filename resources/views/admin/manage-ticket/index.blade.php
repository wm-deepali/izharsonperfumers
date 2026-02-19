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
                            <li class="breadcrumb-item">Customer Support</li>
                            <li class="breadcrumb-item active">Manage Ticket
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <!--<li><a href="javascript:void(0)" class="add-faq"><i class="fa fa-plus"></i> Add </a></li>-->
                            <li><a href="javascript:history.go(-1)"><i class="fa fa-backward"></i> Go Back</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="tab-content">
                	<div class="tab-pane active" id="onlineStore" role="tabpanel">
                
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
                                                            <th>Order ID</th>
                                                            <th>Customer Name</th>
                                                            <th>Mobile Number </th>
                                                            <th>Email ID</th>
                                                            <th>Request Type</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        @foreach($returnorders as $returnorder)
                                                                <tr>
                                                                    <td>{{$returnorder->created_at}}</td>
                                                                    <td>#{{$returnorder->order->order_number}}</td>
                                                                    <td>{{$returnorder->order->name}}</td>
                                                                    <td>{{$returnorder->order->mobile_number}}</td>
                                                                    <td>{{$returnorder->order->email}}</td>
                                                                    <td>Return</td>
                                                                    <td>{{$returnorder->order->order_status}}</td>  
                                                                    <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="{{route('admin.manage-order.show',$returnorder->order->id)}}" class="view-orders" brand_id="#" title="View order details  "><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <li><a href="{{route('admin.viewcustomer',$returnorder->order->customer_id)}}" class="view-orders" brand_id="#" title="Customer details"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                                                                    <!--<li><a href="#" class="view-orders" brand_id="#" title="View order details  "><i class="fa fa-eye" aria-hidden="true"></i></a></li>-->
                                                                    <li><a href="{{route('admin.invoice',$returnorder->order->id)}}" class="view-orders" brand_id="#" title="Download Invoice"><i class="fa fa-download" aria-hidden="true"></i></a></li>
                                                                    <!--<li><a href="#" class="view-orders" brand_id="#" title="Download Invoice"><i class="fa fa-trash" aria-hidden="true"></i></a></li>-->
                                                                    </ul>
                                                            </td>
                                                                </tr>
                                                                @endforeach
                                                                @foreach($cancelorders as $cancelorder)
                                                                <tr>
                                                                    <td>{{$cancelorder->created_at}}</td>
                                                                    <td>#{{$cancelorder->order->order_number}}</td>
                                                                    <td>{{$cancelorder->order->name}}</td>
                                                                    <td>{{$cancelorder->order->mobile_number}}</td>
                                                                    <td>{{$cancelorder->order->email}}</td>
                                                                    <td>Cancel</td>
                                                                    <td>{{$cancelorder->order->order_status}}</td>  
                                                                    <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="{{route('admin.manage-order.show',$cancelorder->order->id)}}" class="view-orders" brand_id="#" title="View order details  "><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <li><a href="{{route('admin.viewcustomer',$cancelorder->order->customer_id)}}" class="view-orders" brand_id="#" title="Customer details  "><i class="fa fa-user" aria-hidden="true"></i></a></li>
                                                                    <!--<li><a href="#" class="view-orders" brand_id="#" title="View order details  "><i class="fa fa-eye" aria-hidden="true"></i></a></li>-->
                                                                    <li><a href="{{route('admin.invoice',$cancelorder->order->id)}}" class="view-orders" brand_id="#" title="Download Invoice"><i class="fa fa-download" aria-hidden="true"></i></a></li>
                                                                    <!--<li><a href="#" class="view-orders" brand_id="#" title="Download Invoice"><i class="fa fa-trash" aria-hidden="true"></i></a></li>-->
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
                	<div class="tab-pane" id="serviceBooking" role="tabpanel">
                	     
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
                                                            <th>Booking ID</th>
                                                            <th>Customer Name</th>
                                                            <th>Mobile Number</th>
                                                            <th>Email ID</th>
                                                            <th>Service Date & Time</th>
                                                            <th>Request</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                                <tr>
                                                                    <td>2022-12-13 13:29:48</td>
                                                                    <td>ORD688924</td>
                                                                    <td>John Crew</td>
                                                                    <td>7000000000</td>
                                                                    <td>johns.crew345@gmail.com</td>
                                                                    <td>2022-12-13 13:29:4</td>
                                                                    <td>req</td>
                                                                    <td>Failed</td>    
                                                                    <td class="text-truncate">
                                                                     <ul class="actions">
                                                                    <li><a href="#" class="view-orders" brand_id="#" title="View order details  "><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <li><a href="#" class="view-orders" brand_id="#" title="View order details  "><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <li><a href="#" class="view-orders" brand_id="#" title="View order details  "><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <li><a href="#" class="view-orders" brand_id="#" title="Download Invoice"><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                                    <li><a href="#" class="view-orders" brand_id="#" title="Download Invoice"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                                    </ul>
                                                                    </td>
                                                                </tr>
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
    </div>
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
                    url: `{{ URL::to('admin/manage-faq/${id}') }}`,
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
    
    function showrating(id){
        $("#ratingmodal #rating").html("");
         $.ajax({
                url: `{{ URL::to('admin/manage-order/rating/${id}') }}`,
                type: "GET",
                dataType: "json",
                success: function(result) {
                   
                       for(let x=0; x<result.length;x++){
                            var data = '';
                   for(let y=0; y<result[x]['rating'];y++){
                    data += '<span class="fa fa-star checked"></span>';
                   }
                            $("#ratingmodal #rating").append(`
                            <div class="form-group">
                                <label for="exampleInputEmail1">${result[x]['product']['name']}</label>
                                <label for="exampleInputEmail1">${data}</label>
                               <input type="text" class="form-control" value="${result[x]['review']}" readonly>
                                
                              </div>
                            `);
                        }
                }
            });
    };
    $(document).ready(function() {
       
        $(document).on("click", ".add-faq", function(event) {
            $.ajax({
                url: "{{ URL::to('admin/manage-faq/create') }}",
                type: "GET",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#faq-modal").html(result.html);
                        $("#faq-modal").modal('show');
                    } else {

                    }
                }
            });
        });

        $(document).on("click", ".edit-faq", function(event) {
            let id = $(this).attr('faq_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-faq/${id}/edit') }}`,
                type: "get",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#faq-modal").html(result.html);
                        $("#faq-modal").modal('show');
                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
                error: function(error) {
                    toastr.error('error encountered ' + error.statusText);
                }
            });
        });

        $(document).on('change', '.order_status', function() {
            var order_id = $(this).attr('data-id');
            // console.log(order_id);return false;
            var status = $(this).val();
            var _token = '{{ csrf_token() }}';
            var post_data = {
                'order_id': order_id,
                'status': status,
                '_token': _token
            };
            // console.log(order_id,status);return false;

            Swal.fire({
                title: '',
                html: '<span class="h4">Do you want to change the status?</span>',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                // console.log(result.value);return false;
                if (result.value == true) {
                    if(order_id){
                        $.ajax({
                            url : "{{ URL::to('admin/update-order-status') }}",
                            type: "POST",
                            data: post_data,
                            success: function(data) {
                                if(data == 200){
                                    // selectedRow.remove();
                                    swal.fire(
                                        'Updated',
                                        'Record Updated Successfully',
                                        'success'
                                    )
                                } else {
                                    swal.fire(
                                        'Something went wrong!',
                                        'Please try again later.',
                                        'error'
                                    )
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                swal.fire(
                                    'Something went wrong!',
                                    'Please try again later.',
                                    'error'
                                )
                            }
                        });
                    } else {
                        swal.fire(
                            'Something went wrong!',
                            'Please try again later.',
                            'error'
                        )
                    }
                }
            })
        })
    });
</script>