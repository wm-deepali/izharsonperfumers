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
                            <li class="breadcrumb-item">Order Management</li>
                            <li class="breadcrumb-item active">Manage Order
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">MANAGE - Order</h4>
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
                    		<a class="nav-link active" data-toggle="tab" href="#allorder " role="tab">All Orders</a>
                    	</li>
                    	<li class="nav-item">
                    		<a class="nav-link" data-toggle="tab" href="#neworder" role="tab">New Orders</a>
                    	</li>
                    	<li class="nav-item">
                    		<a class="nav-link" data-toggle="tab" href="#approveorder" role="tab">Accepted Orders</a>
                    	</li>
                    	<li class="nav-item">
                    		<a class="nav-link" data-toggle="tab" href="#shipped" role="tab">Shipped Orders</a>
                    	</li>
                    	<li class="nav-item">
                    		<a class="nav-link" data-toggle="tab" href="#delivered" role="tab">Delivered Orders</a>
                    	</li>
                    	<li class="nav-item">
                    		<a class="nav-link" data-toggle="tab" href="#cancelled" role="tab">Cancelled Orders</a>
                    	</li>
                    </ul>
                   
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="allorder" role="tabpanel">
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
                                                    <th>Customer Name</th>
                                                    <th>Mobile Number & Email ID</th>
                                                    <th>Order ID</th>
                                                    <!--<th>Shipping Details</th>-->
                                                    <th>Order Value</th>
                                                    <th>Payment Status</th>
                                                    <th>Order Status</th>
                                                    <!--<th>Transection Number</th>-->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($orders) && count($orders) > 0)
                                                    @foreach ($orders as $order)
                                                        <tr>
                                                            <td>{{ $order->created_at }}</td>
                                                            <td>{{ $order->name }}</td>
                                                            <td>{{ $order->mobile_number }}/{{ $order->email }}</td>
                                                            <td>#{{ $order->order_number}}</td>
                                                            <!--<td>-->
                                                            <!--    {{ $order->address }}, {{ $order->city }}, {{ $order->state }} , {{ $order->country }} - {{ $order->pincode }}-->
                                                            <!--</td>-->

                                                            <td>{{ $order->order_amount_with_shipping }}</td>
                                                            <td>{{ ucfirst($order->payment_status) }}</td>
                                                            
                                                            <!-- <td>{{ $order->order_status }}</td> -->
                                                            <td>
                                                                <select @if($order->order_status == "Cancelled") disabled  @endif class="form-control order_status" data-id="{{$order->id}}" style="width: 150px !important;">
                                                                    <option value="New Order" {{ ($order->order_status == "New Order") ? "selected" : "" }}>New Order</option>
                                                                    <option value="Order in Processing" {{ ($order->order_status == "Order in Processing") ? "selected" : "" }}>Approved Order</option>
                                                                    <option value="Order Accepted" {{ ($order->order_status == "Order Accepted") ? "selected" : "" }}>Accepted</option>
                                                                    <option value="Reject Order" {{ ($order->order_status == "Reject Order") ? "selected" : "" }}>Reject Order</option>
                                                                    <option value="Under Packaging" {{ ($order->order_status == "Under Packaging") ? "selected" : "" }}>Under Packaging</option>
                                                                    <option value="In-Transit" {{ ($order->order_status == "In-Transit") ? "selected" : "" }}>In-Transit</option>
                                                                    <option value="Delivered" {{ ($order->order_status == "Delivered") ? "selected" : "" }}>Delivered</option>
                                                                    <option value="Cancelled" {{ ($order->order_status == "Cancelled") ? "selected" : "" }}>Cancelled</option>
                                                                     <option value="Return Accepted" {{ ($order->order_status == "Return Accepted") ? "selected" : "" }}>Return</option>
                                                                </select>
                                                            </td>
                                                            
                                                            <!--<td>{{ $order->transaction_number }}</td>-->


                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                    @if($order->order_status == "Cancelled" && $order->payment_status !="refunded")
                                                                     <li><a href="javascript:void(0)" title="Process Refunds" class="refundprocess" data-toggle="modal"  brand_id="{{ $order->id }}"><i class="fa fa-bar-chart" aria-hidden="true"></i></a></li>
                                                                    @endif
                                                                    <li><a href="{{route('admin.manage-order.show',$order->id)}}" class="view-orders" brand_id="{{ $order->id }}" title="View order details  "><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <li><a href="{{route('admin.invoice',$order->id)}}" class="view-orders" brand_id="{{ $order->id }}" title="Download Invoice"><i class="fa fa-download" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" class="view-orders rating" id="ratingshow" onclick="showrating({{ $order->id }})" brand_id="{{ $order->id }}" data-toggle="modal" data-target="#ratingmodal" title="View rating  "><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                                    <!--<li><a href="javascript:void(0)" class="view-orders" brand_id="{{ $order->id }}" data-toggle="modal" data-target="#complaintmodal" title="View Complaint  "><i class="fa fa-edit" aria-hidden="true"></i></a></li>-->
                                                                    <!--<li><a href="javascript:void(0)" class="eit-faq" faq_id="{{ $order->id }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>-->
                                                                    <!--<li><a href="javascript:void(0)" onclick="deleteConirmation({{ $order->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>-->
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
                	<div class="tab-pane" id="neworder" role="tabpanel">
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
                                                    <th>Customer Name</th>
                                                    <th>Mobile Number & Email ID</th>
                                                    <th>Order ID</th>
                                                    <!--<th>Shipping Details</th>-->
                                                    <th>Order Value</th>
                                                    <th>Payment Status</th>
                                                    <th>Order Status</th>
                                                    <!--<th>Transection Number</th>-->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($orders) && count($orders) > 0)
                                                    @foreach ($orders as $order)
                                                    @if($order->order_status=="New Order")
                                                        <tr>
                                                            <td>{{ $order->created_at }}</td>
                                                            <td>{{ $order->name }}</td>
                                                            <td>{{ $order->mobile_number }}/{{ $order->email }}</td>
                                                            <td>#{{ $order->order_number}}</td>
                                                            <!--<td>-->
                                                            <!--    {{ $order->address }}, {{ $order->city }}, {{ $order->state }} , {{ $order->country }} - {{ $order->pincode }}-->
                                                            <!--</td>-->

                                                            <td>{{ $order->order_amount_with_shipping }}</td>
                                                            <td>{{ ucfirst($order->payment_status) }}</td>
                                                            
                                                            <!-- <td>{{ $order->order_status }}</td> -->
                                                            <td>
                                                                <select class="form-control order_status" data-id="{{$order->id}}" style="width: 150px !important;">
                                                                    <option value="New Order" {{ ($order->order_status == "New Order") ? "selected" : "" }}>New Order</option>
                                                                    <option value="Order in Processing" {{ ($order->order_status == "Order in Processing") ? "selected" : "" }}>Approved Order</option>
                                                                    <option value="Order Accepted" {{ ($order->order_status == "Order Accepted") ? "selected" : "" }}>Accepted</option>
                                                                    <option value="Reject Order" {{ ($order->order_status == "Reject Order") ? "selected" : "" }}>Reject Order</option>
                                                                    <option value="Under Packaging" {{ ($order->order_status == "Under Packaging") ? "selected" : "" }}>Under Packaging</option>
                                                                    <option value="In-Transit" {{ ($order->order_status == "In-Transit") ? "selected" : "" }}>In-Transit</option>
                                                                    <option value="Delivered" {{ ($order->order_status == "Delivered") ? "selected" : "" }}>Delivered</option>
                                                                    <option value="Cancelled" {{ ($order->order_status == "Cancelled") ? "selected" : "" }}>Cancelled</option>
                                                                     <option value="Return Accepted" {{ ($order->order_status == "Return Accepted") ? "selected" : "" }}>Return</option>
                                                                </select>
                                                            </td>
                                                            
                                                            <!--<td>{{ $order->transaction_number }}</td>-->

                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="{{route('admin.manage-order.show',$order->id)}}" class="view-orders" brand_id="{{ $order->id }}" title="View order details  "><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <li><a href="{{route('admin.invoice',$order->id)}}" class="view-orders" brand_id="{{ $order->id }}" title="Download Invoice"><i class="fa fa-download" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" class="view-orders rating" id="ratingshow" onclick="showrating({{ $order->id }})" brand_id="{{ $order->id }}" data-toggle="modal" data-target="#ratingmodal" title="View rating  "><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                                    <!--<li><a href="javascript:void(0)" class="view-orders" brand_id="{{ $order->id }}" data-toggle="modal" data-target="#complaintmodal" title="View Complaint  "><i class="fa fa-edit" aria-hidden="true"></i></a></li>-->
                                                                    <!--<li><a href="javascript:void(0)" class="eit-faq" faq_id="{{ $order->id }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>-->
                                                                    <!--<li><a href="javascript:void(0)" onclick="deleteConirmation({{ $order->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>-->
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        @endif
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
            	    <div class="tab-pane" id="approveorder" role="tabpanel">
                	    <section>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card-body collapse in">
                                <div class="card-block card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="example2">
                                            <thead>
                                                <tr>
                                                    <th>Date &amp; Time</th>
                                                    <th>Customer Name</th>
                                                    <th>Mobile Number & Email ID</th>
                                                    <th>Order ID</th>
                                                    <!--<th>Shipping Details</th>-->
                                                    <th>Order Value</th>
                                                    <th>Payment Status</th>
                                                    <th>Order Status</th>
                                                    <!--<th>Transection Number</th>-->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($orders) && count($orders) > 0)
                                                    @foreach ($orders as $order)
                                                     @if($order->order_status=="Order Accepted")
                                                        <tr>
                                                            <td>{{ $order->created_at }}</td>
                                                            <td>{{ $order->name }}</td>
                                                            <td>{{ $order->mobile_number }}/{{ $order->email }}</td>
                                                            <td>#{{ $order->order_number}}</td>
                                                            <!--<td>-->
                                                            <!--    {{ $order->address }}, {{ $order->city }}, {{ $order->state }} , {{ $order->country }} - {{ $order->pincode }}-->
                                                            <!--</td>-->

                                                            <td>{{ $order->order_amount_with_shipping }}</td>
                                                            <td>{{ ucfirst($order->payment_status) }}</td>
                                                            
                                                            <!-- <td>{{ $order->order_status }}</td> -->
                                                            <td>
                                                              <select class="form-control order_status" data-id="{{$order->id}}" style="width: 150px !important;">
                                                                    <option value="New Order" {{ ($order->order_status == "New Order") ? "selected" : "" }}>New Order</option>
                                                                    <option value="Order in Processing" {{ ($order->order_status == "Order in Processing") ? "selected" : "" }}>Approved Order</option>
                                                                    <option value="Order Accepted" {{ ($order->order_status == "Order Accepted") ? "selected" : "" }}>Accepted</option>
                                                                    <option value="Reject Order" {{ ($order->order_status == "Reject Order") ? "selected" : "" }}>Reject Order</option>
                                                                    <option value="Under Packaging" {{ ($order->order_status == "Under Packaging") ? "selected" : "" }}>Under Packaging</option>
                                                                    <option value="In-Transit" {{ ($order->order_status == "In-Transit") ? "selected" : "" }}>In-Transit</option>
                                                                    <option value="Delivered" {{ ($order->order_status == "Delivered") ? "selected" : "" }}>Delivered</option>
                                                                    <option value="Cancelled" {{ ($order->order_status == "Cancelled") ? "selected" : "" }}>Cancelled</option>
                                                                     <option value="Return Accepted" {{ ($order->order_status == "Return Accepted") ? "selected" : "" }}>Return</option>
                                                                </select>
                                                            </td>
                                                            
                                                            <!--<td>{{ $order->transaction_number }}</td>-->

                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="{{route('admin.manage-order.show',$order->id)}}" class="view-orders" brand_id="{{ $order->id }}" title="View order details  "><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <li><a href="{{route('admin.invoice',$order->id)}}" class="view-orders" brand_id="{{ $order->id }}" title="Download Invoice"><i class="fa fa-download" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" class="view-orders rating" id="ratingshow" onclick="showrating({{ $order->id }})" brand_id="{{ $order->id }}" data-toggle="modal" data-target="#ratingmodal" title="View rating  "><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                                    <!--<li><a href="javascript:void(0)" class="view-orders" brand_id="{{ $order->id }}" data-toggle="modal" data-target="#complaintmodal" title="View Complaint  "><i class="fa fa-edit" aria-hidden="true"></i></a></li>-->
                                                                    <!--<li><a href="javascript:void(0)" class="eit-faq" faq_id="{{ $order->id }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>-->
                                                                    <!--<li><a href="javascript:void(0)" onclick="deleteConirmation({{ $order->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>-->
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        @endif
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
            	    <div class="tab-pane" id="shipped" role="tabpanel">
                	    <section>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card-body collapse in">
                                <div class="card-block card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="example3">
                                            <thead>
                                                <tr>
                                                    <th>Date &amp; Time</th>
                                                    <th>Customer Name</th>
                                                    <th>Mobile Number & Email ID</th>
                                                    <th>Order ID</th>
                                                    <!--<th>Shipping Details</th>-->
                                                    <th>Order Value</th>
                                                    <th>Payment Status</th>
                                                    <th>Order Status</th>
                                                    <!--<th>Transection Number</th>-->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($orders) && count($orders) > 0)
                                                    @foreach ($orders as $order)
                                                     @if($order->order_status=="In-Transit")
                                                        <tr>
                                                            <td>{{ $order->created_at }}</td>
                                                            <td>{{ $order->name }}</td>
                                                            <td>{{ $order->mobile_number }}/{{ $order->email }}</td>
                                                            <td>#{{ $order->order_number}}</td>
                                                            <!--<td>-->
                                                            <!--    {{ $order->address }}, {{ $order->city }}, {{ $order->state }} , {{ $order->country }} - {{ $order->pincode }}-->
                                                            <!--</td>-->

                                                            <td>{{ $order->order_amount_with_shipping }}</td>
                                                            <td>{{ ucfirst($order->payment_status) }}</td>
                                                            
                                                            <!-- <td>{{ $order->order_status }}</td> -->
                                                            <td>
                                                               <select class="form-control order_status" data-id="{{$order->id}}" style="width: 150px !important;">
                                                                    <option value="New Order" {{ ($order->order_status == "New Order") ? "selected" : "" }}>New Order</option>
                                                                    <option value="Order in Processing" {{ ($order->order_status == "Order in Processing") ? "selected" : "" }}>Approved Order</option>
                                                                    <option value="Order Accepted" {{ ($order->order_status == "Order Accepted") ? "selected" : "" }}>Accepted</option>
                                                                    <option value="Reject Order" {{ ($order->order_status == "Reject Order") ? "selected" : "" }}>Reject Order</option>
                                                                    <option value="Under Packaging" {{ ($order->order_status == "Under Packaging") ? "selected" : "" }}>Under Packaging</option>
                                                                    <option value="In-Transit" {{ ($order->order_status == "In-Transit") ? "selected" : "" }}>In-Transit</option>
                                                                    <option value="Delivered" {{ ($order->order_status == "Delivered") ? "selected" : "" }}>Delivered</option>
                                                                    <option value="Cancelled" {{ ($order->order_status == "Cancelled") ? "selected" : "" }}>Cancelled</option>
                                                                     <option value="Return Accepted" {{ ($order->order_status == "Return Accepted") ? "selected" : "" }}>Return</option>
                                                                </select>
                                                            </td>
                                                            
                                                            <!--<td>{{ $order->transaction_number }}</td>-->

                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="{{route('admin.manage-order.show',$order->id)}}" class="view-orders" brand_id="{{ $order->id }}" title="View order details  "><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <li><a href="{{route('admin.invoice',$order->id)}}" class="view-orders" brand_id="{{ $order->id }}" title="Download Invoice"><i class="fa fa-download" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" class="view-orders rating" id="ratingshow" onclick="showrating({{ $order->id }})" brand_id="{{ $order->id }}" data-toggle="modal" data-target="#ratingmodal" title="View rating  "><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                                    <!--<li><a href="javascript:void(0)" class="view-orders" brand_id="{{ $order->id }}" data-toggle="modal" data-target="#complaintmodal" title="View Complaint  "><i class="fa fa-edit" aria-hidden="true"></i></a></li>-->
                                                                    <!--<li><a href="javascript:void(0)" class="eit-faq" faq_id="{{ $order->id }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>-->
                                                                    <!--<li><a href="javascript:void(0)" onclick="deleteConirmation({{ $order->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>-->
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        @endif
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
            	    <div class="tab-pane" id="delivered" role="tabpanel">
                	    <section>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card-body collapse in">
                                <div class="card-block card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="example4">
                                            <thead>
                                                <tr>
                                                    <th>Date &amp; Time</th>
                                                    <th>Customer Name</th>
                                                    <th>Mobile Number & Email ID</th>
                                                    <th>Order ID</th>
                                                    <!--<th>Shipping Details</th>-->
                                                    <th>Order Value</th>
                                                    <th>Payment Status</th>
                                                    <th>Order Status</th>
                                                    <!--<th>Transection Number</th>-->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($orders) && count($orders) > 0)
                                                    @foreach ($orders as $order)
                                                     @if($order->order_status=="Delivered")
                                                        <tr>
                                                            <td>{{ $order->created_at }}</td>
                                                            <td>{{ $order->name }}</td>
                                                            <td>{{ $order->mobile_number }}/{{ $order->email }}</td>
                                                            <td>#{{ $order->order_number}}</td>
                                                            <!--<td>-->
                                                            <!--    {{ $order->address }}, {{ $order->city }}, {{ $order->state }} , {{ $order->country }} - {{ $order->pincode }}-->
                                                            <!--</td>-->

                                                            <td>{{ $order->order_amount_with_shipping }}</td>
                                                            <td>{{ ucfirst($order->payment_status) }}</td>
                                                            
                                                            <!-- <td>{{ $order->order_status }}</td> -->
                                                            <td>
                                                              <select class="form-control order_status" data-id="{{$order->id}}" style="width: 150px !important;">
                                                                    <option value="New Order" {{ ($order->order_status == "New Order") ? "selected" : "" }}>New Order</option>
                                                                    <option value="Order in Processing" {{ ($order->order_status == "Order in Processing") ? "selected" : "" }}>Approved Order</option>
                                                                    <option value="Order Accepted" {{ ($order->order_status == "Order Accepted") ? "selected" : "" }}>Accepted</option>
                                                                    <option value="Reject Order" {{ ($order->order_status == "Reject Order") ? "selected" : "" }}>Reject Order</option>
                                                                    <option value="Under Packaging" {{ ($order->order_status == "Under Packaging") ? "selected" : "" }}>Under Packaging</option>
                                                                    <option value="In-Transit" {{ ($order->order_status == "In-Transit") ? "selected" : "" }}>In-Transit</option>
                                                                    <option value="Delivered" {{ ($order->order_status == "Delivered") ? "selected" : "" }}>Delivered</option>
                                                                    <option value="Cancelled" {{ ($order->order_status == "Cancelled") ? "selected" : "" }}>Cancelled</option>
                                                                     <option value="Return Accepted" {{ ($order->order_status == "Return Accepted") ? "selected" : "" }}>Return</option>
                                                                </select>
                                                            </td>
                                                            
                                                            <!--<td>{{ $order->transaction_number }}</td>-->

                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="{{route('admin.manage-order.show',$order->id)}}" class="view-orders" brand_id="{{ $order->id }}" title="View order details  "><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <li><a href="{{route('admin.invoice',$order->id)}}" class="view-orders" brand_id="{{ $order->id }}" title="Download Invoice"><i class="fa fa-download" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" class="view-orders rating" id="ratingshow" onclick="showrating({{ $order->id }})" brand_id="{{ $order->id }}" data-toggle="modal" data-target="#ratingmodal" title="View rating  "><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                                    <!--<li><a href="javascript:void(0)" class="view-orders" brand_id="{{ $order->id }}" data-toggle="modal" data-target="#complaintmodal" title="View Complaint  "><i class="fa fa-edit" aria-hidden="true"></i></a></li>-->
                                                                    <!--<li><a href="javascript:void(0)" class="eit-faq" faq_id="{{ $order->id }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>-->
                                                                    <!--<li><a href="javascript:void(0)" onclick="deleteConirmation({{ $order->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>-->
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                         @endif
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
            	     <div class="tab-pane" id="cancelled" role="tabpanel">
                	    <section>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card-body collapse in">
                                <div class="card-block card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="example5">
                                            <thead>
                                                <tr>
                                                    <th>Date &amp; Time</th>
                                                    <th>Customer Name</th>
                                                    <th>Mobile Number & Email ID</th>
                                                    <th>Order ID</th>
                                                    <!--<th>Shipping Details</th>-->
                                                    <th>Order Value</th>
                                                    <th>Payment Status</th>
                                                    <th>Order Status</th>
                                                    <!--<th>Transection Number</th>-->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($orders) && count($orders) > 0)
                                                    @foreach ($orders as $order)
                                                    @if($order->order_status=="Cancelled")
                                                        <tr>
                                                            <td>{{ $order->created_at }}</td>
                                                            <td>{{ $order->name }}</td>
                                                            <td>{{ $order->mobile_number }}/{{ $order->email }}</td>
                                                            <td>#{{ $order->order_number}}</td>
                                                            <!--<td>-->
                                                            <!--    {{ $order->address }}, {{ $order->city }}, {{ $order->state }} , {{ $order->country }} - {{ $order->pincode }}-->
                                                            <!--</td>-->

                                                            <td>{{ $order->order_amount_with_shipping }}</td>
                                                            <td>{{ ucfirst($order->payment_status) }}</td>
                                                            
                                                            <!-- <td>{{ $order->order_status }}</td> -->
                                                            <td>
                                                               <select @if($order->order_status == "Cancelled") disabled  @endif class="form-control order_status" data-id="{{$order->id}}" style="width: 150px !important;">
                                                                    <option value="New Order" {{ ($order->order_status == "New Order") ? "selected" : "" }}>New Order</option>
                                                                    <option value="Order in Processing" {{ ($order->order_status == "Order in Processing") ? "selected" : "" }}>Approved Order</option>
                                                                    <option value="Order Accepted" {{ ($order->order_status == "Order Accepted") ? "selected" : "" }}>Accepted</option>
                                                                    <option value="Reject Order" {{ ($order->order_status == "Reject Order") ? "selected" : "" }}>Reject Order</option>
                                                                    <option value="Under Packaging" {{ ($order->order_status == "Under Packaging") ? "selected" : "" }}>Under Packaging</option>
                                                                    <option value="In-Transit" {{ ($order->order_status == "In-Transit") ? "selected" : "" }}>In-Transit</option>
                                                                    <option value="Delivered" {{ ($order->order_status == "Delivered") ? "selected" : "" }}>Delivered</option>
                                                                    <option value="Cancelled" {{ ($order->order_status == "Cancelled") ? "selected" : "" }}>Cancelled</option>
                                                                     <option value="Return Accepted" {{ ($order->order_status == "Return Accepted") ? "selected" : "" }}>Return</option>
                                                                </select>
                                                            </td>
                                                            
                                                            
                                                            <!--<td>{{ $order->transaction_number }}</td>-->

                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                      @if($order->order_status == "Cancelled" && $order->payment_status !="refunded")
                                                                     <li><a href="#" title="Process Refunds" class="refundprocess" data-toggle="modal"  brand_id="{{ $order->id }}"><i class="fa fa-bar-chart" aria-hidden="true"></i></a></li>
                                                                    @endif
                                                                    <li><a href="{{route('admin.manage-order.show',$order->id)}}" class="view-orders" brand_id="{{ $order->id }}" title="View order details  "><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <li><a href="{{route('admin.invoice',$order->id)}}" class="view-orders" brand_id="{{ $order->id }}" title="Download Invoice"><i class="fa fa-download" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" class="view-orders rating" id="ratingshow" onclick="showrating({{ $order->id }})" brand_id="{{ $order->id }}" data-toggle="modal" data-target="#ratingmodal" title="View rating  "><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                                    <!--<li><a href="javascript:void(0)" class="view-orders" brand_id="{{ $order->id }}" data-toggle="modal" data-target="#complaintmodal" title="View Complaint  "><i class="fa fa-edit" aria-hidden="true"></i></a></li>-->
                                                                    <!--<li><a href="javascript:void(0)" class="eit-faq" faq_id="{{ $order->id }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>-->
                                                                    <!--<li><a href="javascript:void(0)" onclick="deleteConirmation({{ $order->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>-->
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                         @endif
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
    </div>
</div>
<!-- Process Refunds Modal -->
<div class="modal" id="refundprocess">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Process Refunds</h4>
        <button type="button" class="close" data-dismiss="modal" style="margin-top:-25px;">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body refundprocessbody">
      
           <div class="row">
                
               <div class="col-lg-4">
                   <label>Enter Transaction ID</label>
                   <input type="text" class="form-control" name="transaction_id" id="transaction_id" />
                   <input type="hidden" name="order_id" id="order_id" />
               </div>
                <div class="col-lg-4">
                   <label>Amount Refunded</label>
                   <input type="text" class="form-control" name="refunded_amount" id="refunded_amount" />
               </div>
               <div class="col-lg-4">
                   <label> Date & Time</label>
                   <input type="datetime-local" class="form-control" name="refunded_date" id="refunded_date" />
               </div>
              
           </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="modal-footer">
                     <button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary pull-right refundprocesssubmit">Save changes</button>
               
                </div>
            </div>
            </div>
      
      </div>

    </div>
  </div>
</div>

<!--  //  Process Refunds Modal -->
<div class="modal fade" id="ratingmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<div class="modal fade" id="complaintmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Complaint</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div id="faq-modal" class="modal fade" role="dialog">
</div>
//courier intransit
<div class="modal fade" id="intransit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Courier Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body courier">
       <div class="row">
           <div class="col-sm-6">
            <label class="label-control label">AWB Number<span class="required">*</span></label>
            <input type="text" class="form-control" placeholder="AWB Number"
                name="awb_number" id="awb_number">
                <input type="hidden" name="order_id" id="order_id" />
            <div class="text-danger" id="awb_number-err"></div>
        </div>
        <div class="col-sm-6">
            <label class="label-control label">Courier Name<span class="required">*</span></label>
            <input type="text" class="form-control" placeholder="Courier Name"
                name="courier_name" id="courier_name">
            <div class="text-danger" id="courier_name-err"></div>
        </div>
        <div class="col-sm-6">
            <label class="label-control label">Tracking URL<span class="required">*</span></label>
            <input type="text" class="form-control" placeholder="Tracking URL"
                name="tracking_url" id="tracking_url">
            <div class="text-danger" id="tracking_url-err"></div>
        </div>
         <div class="col-sm-6">
            <label class="label-control label">Date<span class="required">*</span></label>
            <input type="date" class="form-control" placeholder="Date"
                name="date" id="date">
            <div class="text-danger" id="date-err"></div>
        </div>
        
         <div class="col-sm-6">
            <label class="label-control label">Estimated Delivery<span class="required">*</span></label>
            <input type="number" class="form-control" placeholder="Estimated Delivery"
                name="delivery_date" id="delivery_date">
            <div class="text-danger" id="delivery_date-err"></div>
        </div>
        
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add-courier">Save changes</button>
      </div>
    </div>
  </div>
</div>

//cancelorder
<div class="modal fade" id="cancelorder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Courier Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body cancelorder">
       <div class="row">
           
           <div class="col-sm-6">
            <label class="label-control label">Reason<span class="required">*</span></label>
            <select class="form-control" name="reason" id="reason">
                @foreach($cancelreasons as $cancelreason)
                <option value="{{$cancelreason->id}}">{{$cancelreason->title}}</option>
                @endforeach
                
                
            </select>
            <div class="text-danger" id="delivery_date-err"></div>
        </div>
           <div class="col-sm-6">
            <label class="label-control label">Cancellation Reason<span class="required">*</span></label>
            <textarea class="form-control" name="cancellation_reason_admin" id="cancellation_reason_admin"></textarea>
                <input type="hidden" name="order_id" id="order_id" />
            <div class="text-danger" id="cancellation_reason_admin-err"></div>
        </div>
        
        
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add-cancelorder">Save changes</button>
      </div>
    </div>
  </div>
</div>
@include('admin.footer')
<script>
$('body').on('click', '.refundprocess', function() {
    var id = $(this).attr('brand_id');
    console.log(id)
    $(".refundprocessbody #order_id").val(id);
    $("#refundprocess").modal('show');
    
})



$(document).on("click", ".refundprocesssubmit", function(event) {
            $(this).attr('disabled', true);
            $('#transaction_id-err').html('');
            $('#refunded_amount-err').html('');
            $('#refunded_date-err').html('');
            let formData = new FormData();
            formData.append('transaction_id', $('.refundprocessbody #transaction_id').val());
            formData.append('refunded_amount', $('.refundprocessbody #refunded_amount').val());
            formData.append('refunded_date', $('.refundprocessbody #refunded_date').val());
            formData.append('order_id', $('.refundprocessbody #order_id').val());
            formData.append('order_status','Refunded');
            $.ajax({
                url: "{{ URL::to('admin/refund') }}",
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
        
$(document).on("click", ".add-courier", function(event) {
            $(this).attr('disabled', true);
            $('#awb_number-err').html('');
            $('#courier_name-err').html('');
            $('#date-err').html('');
            $('#delivery_date-err').html('');
            let formData = new FormData();
            formData.append('awb_number', $('.courier #awb_number').val());
            formData.append('courier_name', $('.courier #courier_name').val());
            formData.append('date', $('.courier #date').val());
            formData.append('delivery_date', $('.courier #delivery_date').val());
            formData.append('order_id', $('.courier #order_id').val());
            formData.append('tracking_url', $('.courier #tracking_url').val());
            formData.append('order_status','In-Transit');
            $.ajax({
                url: "{{ URL::to('admin/update-transit-order-status') }}",
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
        
        $(document).on("click", ".add-cancelorder", function(event) {
            $(this).attr('disabled', true);
            $('#reason-err').html('');
            $('#cancellation_reason_admin-err').html('');
            let formData = new FormData();
            formData.append('reason', $('.cancelorder #reason').val());
            formData.append('cancellation_reason_admin', $('.cancelorder #cancellation_reason_admin').val());
            formData.append('order_id', $('.cancelorder #order_id').val());
            formData.append('order_status','Cancelled');
            $.ajax({
                url: "{{ URL::to('admin/update-cancel-order-status') }}",
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
                    data += '<i class="fa fa-star"></i>';
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


        $('body').on('change', '.order_status', function() {
            var order_id = $(this).attr('data-id');
            // console.log(order_id);return false;
            console.log($(this).find(':selected').val())
            var status = $(this).val();
            $(`option[value="${this.value}"]`, this)
  .attr("selected", false);
  
  
            // $(this).prop("selectedIndex", -1);
            var _token = '{{ csrf_token() }}';
            var post_data = {
                'order_id': order_id,
                'status': status,
                '_token': _token
            };
           
            // console.log(order_id,status);return false;
                    if(status=="In-Transit"){
                        $(".courier #order_id").val(order_id);
                        $("#intransit").modal('show'); 
                    }else{
                         Swal.fire({
                title: '',
                html: '<span class="h4">Do you want to change the status?</span>',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value == true) {
                    if(status=="In-Transit"){
                        $(".courier #order_id").val(order_id);
                        $("#intransit").modal('show'); 
                    }else if(status=="Cancelled"){
                        $(".cancelorder #order_id").val(order_id);
                        $("#cancelorder").modal('show'); 
                    }else if(order_id && status!="In-Transit"){
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
                                    location.reload();
                                }else if(data == 400){
                                     swal.fire(
                                        'Not Updated',
                                        'Record Not Updated',
                                        'error'
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
                    } 
                    else {
                        swal.fire(
                            'Something went wrong!',
                            'Please try again later.',
                            'error'
                        )
                    }
                }else{
                    location.reload();
                }
            })
                    }
           
        })
    });
</script>