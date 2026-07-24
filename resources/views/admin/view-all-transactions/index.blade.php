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
                            <li class="breadcrumb-item">Customer</li>
                            <li class="breadcrumb-item active">Transaction
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
                <div class="card-headers">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#Successfull " role="tab">Successfull
                                Transaction</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Failed" role="tab">Failed Transaction</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#Refunds" role="tab">Refunds Transaction</a>
                        </li>
                    </ul>

                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="Successfull" role="tabpanel">

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
                                                            <th>Mobile Number & Email ID</th>
                                                            <th>Total Products</th>
                                                            <th>Sub Total</th>
                                                            <th>Taxes</th>
                                                            <th>Billed Amount</th>
                                                            <th>Payment Status</th>
                                                            <th>Transaction ID</th>
                                                            <th>Payment Method</th>
                                                            <th>Payment Gateway</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orders as $order)
                                                            @if($order->payment_status == "success")
                                                                <tr>
                                                                    <td>{{$order->created_at}}</td>
                                                                    <td>#{{$order->order_number}}</td>
                                                                    <td>{{$order->name}}</td>
                                                                    <td>{{$order->mobile_number}}<br>{{$order->email}}</td>
                                                                    <td>{{$order->total_item_count}}</td>
                                                                    <td>{{$order->order_amount_after_discount}}</td>
                                                                    <td>{{$order->total_gst_amount}}</td>
                                                                    <td>{{$order->order_amount_with_shipping}}</td>
                                                                    <td>{{ucfirst($order->payment_status)}}</td>
                                                                    <td>#{{$order->transaction_number}}</td>
                                                                    <td>{{ucfirst($order->payment_method)}}</td>
                                                                    <td>{{ $order->payment_method == 'online' ? ucfirst($order->payment_gateway ?? 'N/A') : '—' }}
                                                                    </td>
                                                                    <td class="text-truncate">
                                                                        <ul class="actions">
                                                                            <li><a href="{{route('admin.manage-order.show', $order->id)}}"
                                                                                    class="view-orders" brand_id="#"
                                                                                    title="View order details  "><i
                                                                                        class="fa fa-eye"
                                                                                        aria-hidden="true"></i></a></li>
                                                                            <li><a href="{{route('admin.invoice', $order->id)}}"
                                                                                    class="view-orders" brand_id="#"
                                                                                    title="Download Invoice"><i
                                                                                        class="fa fa-download"
                                                                                        aria-hidden="true"></i></a></li>
                                                                            <!--<li><a href="javascript:void(0)" class="view-orders rating" id="ratingshow" onclick="showrating({{ $order->id }})" brand_id="{{ $order->id }}" data-toggle="modal" data-target="#ratingmodal" title="View rating  "><i class="fa fa-edit" aria-hidden="true"></i></a></li>-->
                                                                            <!--<li><a href="javascript:void(0)" class="view-orders" brand_id="" data-toggle="modal" data-target="#complaintmodal" title="View Complaint  "><i class="fa fa-edit" aria-hidden="true"></i></a></li>-->
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                            @endif
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
                    <div class="tab-pane" id="Failed" role="tabpanel">

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
                                                            <th>Order ID</th>
                                                            <th>Customer Name</th>
                                                            <th>Mobile Number & Email ID</th>
                                                            <th>Total Products</th>
                                                            <th>Sub Total</th>
                                                            <th>Taxes</th>
                                                            <th>Billed Amount</th>
                                                            <th>Payment Status</th>
                                                            <th>Transaction ID</th>
                                                            <th>Payment Method</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orders as $order)
                                                            @if($order->payment_status == "failed")
                                                                <tr>
                                                                    <td>{{$order->created_at}}</td>
                                                                    <td>#{{$order->order_number}}</td>
                                                                    <td>{{$order->name}}</td>
                                                                    <td>{{$order->mobile_number}}<br>{{$order->email}}</td>
                                                                    <td>{{$order->total_item_count}}</td>
                                                                    <td>{{$order->order_amount_after_discount}}</td>
                                                                    <td>{{$order->total_gst_amount}}</td>
                                                                    <td>{{$order->order_amount_with_shipping}}</td>
                                                                    <td>{{ucfirst($order->payment_status)}}</td>
                                                                    <td>#{{$order->transaction_number}}</td>
                                                                    <td>{{ucfirst($order->payment_method)}}</td>

                                                                    <td class="text-truncate">
                                                                        <ul class="actions">
                                                                            <li><a href="{{route('admin.manage-order.show', $order->id)}}"
                                                                                    class="view-orders" brand_id="#"
                                                                                    title="View order details  "><i
                                                                                        class="fa fa-eye"
                                                                                        aria-hidden="true"></i></a></li>
                                                                            <li><a href="{{route('admin.invoice', $order->id)}}"
                                                                                    class="view-orders" brand_id="#"
                                                                                    title="Download Invoice"><i
                                                                                        class="fa fa-download"
                                                                                        aria-hidden="true"></i></a></li>
                                                                            <li><a href="javascript:void(0)"
                                                                                    class="view-orders rating" id="ratingshow"
                                                                                    onclick="showrating({{ $order->id }})"
                                                                                    brand_id="{{ $order->id }}"
                                                                                    data-toggle="modal"
                                                                                    data-target="#ratingmodal"
                                                                                    title="View rating  "><i class="fa fa-edit"
                                                                                        aria-hidden="true"></i></a></li>
                                                                            <!--<li><a href="javascript:void(0)" class="view-orders" brand_id="" data-toggle="modal" data-target="#complaintmodal" title="View Complaint  "><i class="fa fa-edit" aria-hidden="true"></i></a></li>-->
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                            @endif
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
                    <div class="tab-pane" id="Refunds" role="tabpanel">
                        <section>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="card-body collapse in">
                                        <div class="card-block card-dashboard">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered" id="example1">
                                                    <thead>
                                                        <tr>
                                                            <th>Date &amp; Time</th>
                                                            <th>Order ID</th>
                                                            <th>Customer Name</th>
                                                            <th>Mobile Number & Email ID</th>
                                                            <th>Customer Request ID</th>
                                                            <th>Sub Total</th>
                                                            <th>Taxes</th>
                                                            <th>Billed Amount</th>
                                                            <th>Refund Status</th>
                                                            <th>Transaction ID</th>
                                                            <th>Payment Method</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orders as $order)
                                                            @if($order->payment_status == "refunded")
                                                                <tr>
                                                                    <td>{{$order->created_at}}</td>
                                                                    <td>#{{$order->order_number}}</td>
                                                                    <td>{{$order->name}}</td>
                                                                    <td>{{$order->mobile_number}}<br>{{$order->email}}</td>
                                                                    <td>@if(isset($order->cancelorder))
                                                                    {{$order->cancelorder->request_id}} @endif
                                                                        @if(isset($order->returnorder))
                                                                        {{$order->returnorder->request_id}} @endif
                                                                    </td>
                                                                    <td>{{$order->order_amount_after_discount}}</td>
                                                                    <td>{{$order->total_gst_amount}}</td>
                                                                    <td>{{$order->order_amount_with_shipping}}</td>
                                                                    <td>{{ucfirst($order->payment_status)}}</td>
                                                                    <td>#{{$order->transaction_number}}</td>
                                                                    <td>{{ucfirst($order->payment_method)}}</td>

                                                                    <td class="text-truncate">
                                                                        <ul class="actions">
                                                                            <li><a href="{{route('admin.manage-order.show', $order->id)}}"
                                                                                    class="view-orders" brand_id="#"
                                                                                    title="View order details  "><i
                                                                                        class="fa fa-eye"
                                                                                        aria-hidden="true"></i></a></li>
                                                                            <li><a href="{{route('admin.invoice', $order->id)}}"
                                                                                    class="view-orders" brand_id="#"
                                                                                    title="Download Invoice"><i
                                                                                        class="fa fa-download"
                                                                                        aria-hidden="true"></i></a></li>
                                                                            <li><a href="javascript:void(0)"
                                                                                    class="view-orders rating" id="ratingshow"
                                                                                    onclick="showrating({{ $order->id }})"
                                                                                    brand_id="{{ $order->id }}"
                                                                                    data-toggle="modal"
                                                                                    data-target="#ratingmodal"
                                                                                    title="View rating  "><i class="fa fa-edit"
                                                                                        aria-hidden="true"></i></a></li>
                                                                            <!--<li><a href="javascript:void(0)" class="view-orders" brand_id="" data-toggle="modal" data-target="#complaintmodal" title="View Complaint  "><i class="fa fa-edit" aria-hidden="true"></i></a></li>-->
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                            @endif
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
    </div>
</div>
<div class="modal fade" id="ratingmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rating</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-25px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="rating"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
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

    function showrating(id) {
        $("#ratingmodal #rating").html("");
        $.ajax({
            url: `{{ URL::to('admin/manage-order/rating/${id}') }}`,
            type: "GET",
            dataType: "json",
            success: function (result) {

                for (let x = 0; x < result.length; x++) {
                    var data = '';
                    for (let y = 0; y < result[x]['rating']; y++) {
                        data += ' <i class="fa fa-star"></i>';
                    }
                    $("#ratingmodal #rating").append(`
                            <div class="form-group">
                                <label for="exampleInputEmail1">${result[x]['product']['name']}</label>
                                <label for="exampleInputEmail1"><div class="review-star">${data}</div></label>
                               <input type="text" class="form-control" value="${result[x]['review']}" readonly>
                                
                              </div>
                            `);
                }
            }
        });
    };
    $(document).ready(function () {

        $(document).on("click", ".add-faq", function (event) {
            $.ajax({
                url: "{{ URL::to('admin/manage-faq/create') }}",
                type: "GET",
                dataType: "json",
                success: function (result) {
                    if (result.success) {
                        $("#faq-modal").html(result.html);
                        $("#faq-modal").modal('show');
                    } else {

                    }
                }
            });
        });

        $(document).on("click", ".edit-faq", function (event) {
            let id = $(this).attr('faq_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-faq/${id}/edit') }}`,
                type: "get",
                dataType: "json",
                success: function (result) {
                    if (result.success) {
                        $("#faq-modal").html(result.html);
                        $("#faq-modal").modal('show');
                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
                error: function (error) {
                    toastr.error('error encountered ' + error.statusText);
                }
            });
        });

        $(document).on('change', '.order_status', function () {
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
                    if (order_id) {
                        $.ajax({
                            url: "{{ URL::to('admin/update-order-status') }}",
                            type: "POST",
                            data: post_data,
                            success: function (data) {
                                if (data == 200) {
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