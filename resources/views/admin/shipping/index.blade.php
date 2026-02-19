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
                            <li class="breadcrumb-item">Shipping Management</li>
                            <li class="breadcrumb-item active">Manage Shipping
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">MANAGE - Shipping</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                         <!--<li><a href="{{route('admin.add-new-shipping')}}" class="add-faq"><i class="fa fa-plus"></i> Add </a></li>-->
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
                                                    <th>Shipping Type</th>
                                                    <th>Days Range</th>
                                                    <th>Per 1000 ML (Inter State)</th>
                                                     <th>Per 1000 ML (Intra State)</th>
                                                     <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($shippingData) && count($shippingData) > 0)
                                                    @foreach ($shippingData as $ship)
                                                        <tr>
                                                            <td>{{ $ship->created_at }}</td>
                                                            <td>{{ $ship->name }}</td>
                                                             <td>{{ $ship->delivery_days_range }}</td>
                                                            <td>INR {{ $ship->in_state_charge }}</td>
                                                            <td>INR {{ $ship->out_state_charge }}</td>
                                                              <td>{{ $ship->status=="active" ? "Active" :"De-Active" }}</td>
                                                            
                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="javascript:void(0)" class="show-shipping" shipping_id="{{ $ship->id }}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <li><a href="{{url('admin/edit-shipping/'.$ship->id)}}" class="eit-faq" faq_id="{{ $ship->id }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                                    <!--<li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $ship->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>-->
                                                                    <li><a href="javascript:void(0)" onclick="updateStatus({{ $ship->id }})" title="Status">@if($ship->status =="active")<i style="color:green" class="fa fa-check" aria-hidden="true"></i>@else <i style="color:red" class="fa fa-times" aria-hidden="true"></i> @endif</a></li>
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
         <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Free - Shipping</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <!--<div class="heading-elements">-->
                    <!--    <ul class="list-inline mb-0">-->
                    <!--     <li><a href="{{route('admin.add-new-shipping')}}" class="add-faq"><i class="fa fa-plus"></i> Add </a></li>-->
                    <!--        <li><a href="javascript:history.go(-1)"><i class="fa fa-backward"></i> Go Back</a></li>-->
                    <!--    </ul>-->
                    <!--</div>-->
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
                                                   
                                                  
                                                    <th>Date & Time</th>
                                                    <th>Days Range (Inter State)</th>
                                                    <th>Minimum Order Amount (Inter State) </th>
                                                    <th>Days Range (Intra State)</th>
                                                     <th>Minimum Order Amount (Intra State)</th>
                                                      <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($freeshiping) && count($freeshiping) > 0)
                                                    @foreach ($freeshiping as $ship)
                                                        <tr>
                                                            <td>{{ $ship->created_at }}</td>
                                                             <td> {{ $ship->day_range_inter_state }}</td>
                                                            <td>INR {{ $ship->min_order_value_interstate }}</td>
                                                            <td>{{ $ship->day_range_intra_state }}</td>
                                                            <td>INR {{ $ship->min_order_value_intrastate }}</td>
                                                             <td>{{ $ship->status=="active" ? "Active" :"De-Active" }}</td>
                                                            
                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <!--<li><a href="javascript:void(0)" class="show-shipping" shipping_id="{{ $ship->id }}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></li>-->
                                                                    <li><a href="{{url('admin/edit-free-shipping/'.$ship->id)}}" class="eit-faq" faq_id="{{ $ship->id }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                                    <!--<li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $ship->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>-->
                                                                    <!--<li><a href="javascript:void(0)" onclick="updateStatus({{ $ship->id }})" title="Status">@if($ship->status =="active")<i style="color:green" class="fa fa-check" aria-hidden="true"></i>@else <i style="color:red" class="fa fa-times" aria-hidden="true"></i> @endif</a></li>-->
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
<div id="faq-modal" class="modal fade" role="dialog">
</div>
@include('admin.footer')
<script>

$(document).on("click", ".show-shipping", function(event) {
            let id = $(this).attr('shipping_id');
            $.ajax({
                url: `{{ url('admin/manage-shipping/showshipping/${id}') }}`,
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
                    url: `{{ URL::to('admin/manage-shipping/change-status/${id}') }}`,
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
                    url: `{{ URL::to('admin/delete-shipping/${id}') }}`,
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
    // $(document).ready(function() {
    //     $(document).on("click", ".add-faq", function(event) {
    //         $.ajax({
    //             url: "{{ URL::to('admin/manage-faq/create') }}",
    //             type: "GET",
    //             dataType: "json",
    //             success: function(result) {
    //                 if (result.success) {
    //                     $("#faq-modal").html(result.html);
    //                     $("#faq-modal").modal('show');
    //                 } else {

    //                 }
    //             }
    //         });
    //     });

    //     $(document).on("click", ".edit-faq", function(event) {
    //         let id = $(this).attr('faq_id');
    //         $.ajax({
    //             url: `{{ URL::to('admin/manage-faq/${id}/edit') }}`,
    //             type: "get",
    //             dataType: "json",
    //             success: function(result) {
    //                 if (result.success) {
    //                     $("#faq-modal").html(result.html);
    //                     $("#faq-modal").modal('show');
    //                 } else {
    //                     toastr.error('error encountered ' + result.msgText);
    //                 }
    //             },
    //             error: function(error) {
    //                 toastr.error('error encountered ' + error.statusText);
    //             }
    //         });
    //     });
    // });
</script>
