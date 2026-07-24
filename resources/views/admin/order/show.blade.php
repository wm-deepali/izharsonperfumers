@include('admin.header')
<style>
    .text-right {
        text-align: right;
    }
</style>
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">ORDERS</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.manage-order.index') }}">Order
                                    management</a></li>
                            <li class="breadcrumb-item active">View Order</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="horizontal-form-layouts">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><strong>ORDER Id-</strong> #{{ $order->order_number }}
                                    @if($order->order_status == "Cancelled" || $order->order_status == "Delivered")
                                        <button class="btn btn-danger btn-sm">Order {{ $order->order_status }}</button>
                                    @else <button class="btn btn-primary btn-sm cancel-order" type="button"
                                    brand_id="{{$order->id}}">Order {{ $order->order_status }}</button> @endif


                                    @if ($order->order_status == 'Cancelled' && $order->payment_status != 'refunded')
                                        <button class="btn btn-primary btn-sm refundprocess" type="button"
                                            brand_id="{{$order->id}}">Refund Amount</button>
                                    @elseif($order->order_status == 'Cancelled')
                                        <button class="btn btn-danger btn-sm">Refund Amount</button>
                                    @else

                                    @endif

                                    <a href="{{route('admin.invoice', $order->id)}}" class="btn btn-blue btn-sm"><i
                                            class="fa fa-download"></i> Download Invoice</a>
                                    @if($order->payment_method == "offline")
                                        @if($order->payment_status == "pending")
                                            <button class="btn btn-primary btn-sm approvepayment" type="button"
                                                brand_id="{{$order->id}}">Approve Payment</button>
                                        @else
                                            <button class="btn btn-danger btn-sm">Payment Successfully Approved</button>
                                        @endif
                                    @else
                                        {{-- online payments (Cashfree / CCAvenue) are confirmed automatically via
                                        webhook/redirect, not manually --}}
                                        @if($order->payment_status == "success")
                                            <button class="btn btn-danger btn-sm">Payment Confirmed via
                                                {{ ucfirst($order->payment_gateway ?? 'Gateway') }}</button>
                                        @elseif($order->payment_status == "failed")
                                            <button class="btn btn-warning btn-sm">Payment Failed</button>
                                        @else
                                            <button class="btn btn-secondary btn-sm">Awaiting Gateway Confirmation</button>
                                        @endif
                                    @endif
                                </h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i> Refresh</a> </li>
                                        <li><a href="javascript:history.go(-1)"><i class="fa fa-backward"></i> Go
                                                Back</a> </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body collapse in">
                                <div class="card-block card-orders-detail">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="card">
                                                <h3 class="cart-main-tit">Basic Detail</h3>
                                                <div class="form-group row">
                                                    <div class="col-sm-4 mb-2">
                                                        <label class="label-control">Customer Name</label>
                                                        <h3 class="h3-control">{{ $order->name }}</h3>
                                                    </div>
                                                    <div class="col-sm-4 mb-2">
                                                        <label class="label-control">Email Id</label>
                                                        <h3 class="h3-control">{{ $order->email }}</h3>
                                                    </div>
                                                    <div class="col-sm-4 mb-2">
                                                        <label class="label-control">Mobile Number</label>
                                                        <h3 class="h3-control">{{$order->mobile_number}}</h3>
                                                    </div>
                                                    <div class="col-sm-4 mb-2">
                                                        <label class="label-control">Order Date & Time</label>
                                                        <h3 class="h3-control">{{ $order->created_at }}</h3>
                                                    </div>
                                                    <div class="col-sm-4 mb-2">
                                                        <label class="label-control">Order ID</label>
                                                        <h3 class="h3-control">{{ '#' . $order->order_number }}</h3>
                                                    </div>
                                                    <div class="col-sm-4 mb-2">
                                                        <label class="label-control">Order Status</label>
                                                        <h3 class="h3-control">{{$order->order_status}}</h3>
                                                    </div>
                                                    <div class="col-sm-4 mb-2">
                                                        <label class="label-control">Billed Amount</label>
                                                        <h3 class="h3-control">{{$order->order_amount_with_shipping}}
                                                        </h3>
                                                    </div>
                                                    <div class="col-sm-4 mb-2">
                                                        <label class="label-control">Payment Status</label>
                                                        <h3 class="h3-control">{{ $order->payment_status }}</h3>
                                                    </div>
                                                    @if($order->payment_status == "failed")
                                                        <div class="col-sm-4 mb-2">
                                                            <label class="label-control">Payment Failed Reason</label>
                                                            <h3 class="h3-control">{{ $order->payment_message }}</h3>
                                                        </div>
                                                    @endif
                                                    @if($order->payment_status == "success")
                                                        <div class="col-sm-4 mb-2">
                                                            <label class="label-control">Payment Approval Date</label>
                                                            <h3 class="h3-control">
                                                                {{ date("jS  F Y h:i:s A", strtotime($order->payment_approved_date)) }}
                                                            </h3>
                                                        </div>
                                                    @endif

                                                    <div class="col-sm-4 mb-2">
                                                        <label class="label-control">Transaction Id</label>
                                                        <h3 class="h3-control">{{ $order->transaction_number }}</h3>
                                                    </div>
                                                    <div class="col-sm-4 mb-2">
                                                        <label class="label-control">Payment Method</label>
                                                        <h3 class="h3-control">{{ $order->payment_method }}</h3>
                                                    </div>
                                                    @if($order->payment_method == "online")
                                                        <div class="col-sm-4 mb-2">
                                                            <label class="label-control">Payment Gateway</label>
                                                            <h3 class="h3-control">
                                                                {{ ucfirst($order->payment_gateway ?? 'N/A') }}
                                                            </h3>
                                                        </div>
                                                    @endif
                                                    <div class="col-sm-4 mb-2">
                                                        <label class="label-control">Shipping Type</label>
                                                        <h3 class="h3-control">{{ $order->address_type }}</h3>
                                                    </div>
                                                    <div class="col-sm-4 mb-2">
                                                        <label class="label-control">Coupon Status</label>
                                                        <h3 class="h3-control">
                                                            {{ $order->coupon_id ? 'Applied' : 'Not Applied' }}
                                                        </h3>
                                                    </div>
                                                    <div class="col-sm-4 mb-2">
                                                        <label class="label-control">Coupon Code</label>
                                                        <h3 class="h3-control">{{ $order->coupon_code }}</h3>
                                                    </div>
                                                    <div class="col-sm-4 mb-2">
                                                        <label class="label-control">Total Items</label>
                                                        <h3 class="h3-control">{{ $order->total_item_count }}</h3>
                                                    </div>

                                                    <!-- <div class="col-sm-4 mb-2">-->
                                                    <!--    <label class="label-control">Price</label>-->
                                                    <!--    <h3 class="h3-control"><i class="fa fa-inr"></i>{{ $order->order_amount }}</h3>-->
                                                    <!--</div>-->
                                                    <div class="col-sm-4 mb-2">
                                                        <label class="label-control">Total Costs</label>
                                                        <h3 class="h3-control"><i
                                                                class="fa fa-inr"></i>{{ $order->order_amount_with_shipping }}
                                                        </h3>
                                                    </div>
                                                    @if($order->payment_method == "offline")
                                                        <div class="col-sm-4 mb-2">
                                                            <label class="label-control">Refrence Id</label>
                                                            <h3 class="h3-control">{{ $order->refrence_id }}</h3>
                                                        </div>
                                                        <div class="col-sm-4 mb-2">
                                                            <label class="label-control">Payment Proof</label>
                                                            <a href="{{url('storage') . '/' . $order->payment_image}}"
                                                                target="_blank"> <img height="100px" width="100px"
                                                                    src="{{url('storage') . '/' . $order->payment_image}}" /></a>
                                                        </div>
                                                    @endif
                                                    @if ($order->cancelorder)
                                                        <div class="col-sm-4 mb-2">
                                                            <label class="label-control">Cancellation Reason Admin</label>
                                                            <h3 class="h3-control">
                                                                {{$order->cancelorder->cancellation_reason_admin}}
                                                            </h3>
                                                        </div>
                                                        <div class="col-sm-4 mb-2">
                                                            <label class="label-control">Cancellation Reason
                                                                Customer</label>
                                                            <h3 class="h3-control">
                                                                {{$order->cancelorder->cancellation_reason}}
                                                            </h3>
                                                        </div>
                                                        <div class="col-sm-4 mb-2">
                                                            <label class="label-control">Reason</label>
                                                            <h3 class="h3-control">
                                                                {{$order->cancelorder->reasons->title ?? ""}}
                                                            </h3>
                                                        </div>
                                                        <div class="col-sm-4 mb-2">
                                                            <label class="label-control">Cancelled By</label>
                                                            <h3 class="h3-control">
                                                                {{ ucfirst($order->cancelorder->cancelled_by)}}
                                                            </h3>
                                                        </div>
                                                    @endif
                                                    @if ($order->cancelorder && $order->refundorder)

                                                        <div class="col-sm-4 mb-2">
                                                            <label class="label-control">Transaction ID</label>
                                                            <h3 class="h3-control">{{$order->refundorder->transaction_id}}
                                                            </h3>
                                                        </div>
                                                        <div class="col-sm-4 mb-2">
                                                            <label class="label-control">Refunded Amount</label>
                                                            <h3 class="h3-control">{{$order->refundorder->refunded_amount}}
                                                            </h3>
                                                        </div>
                                                        <div class="col-sm-4 mb-2">
                                                            <label class="label-control">Refund Date </label>
                                                            <h3 class="h3-control">
                                                                {{ date('d/m/Y H:i A', strtotime($order->refundorder->refunded_date))}}
                                                            </h3>
                                                        </div>

                                                    @endif
                                                    @if ($order->courierorder)
                                                        <div class="col-sm-4 mb-2">
                                                            <label class="label-control">AWB Number</label>
                                                            <h3 class="h3-control">{{$order->courierorder->awb_number}}</h3>
                                                        </div>
                                                        <div class="col-sm-4 mb-2">
                                                            <label class="label-control">Courier Name</label>
                                                            <h3 class="h3-control">{{$order->courierorder->courier_name}}
                                                            </h3>
                                                        </div>
                                                        <div class="col-sm-4 mb-2">
                                                            <label class="label-control">Deliver In</label>
                                                            <h3 class="h3-control">{{ $order->courierorder->delivery_date}}
                                                                Days</h3>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group row">
                                                    <!--<div class="col-sm-4">-->
                                                    <!--    <label class="label-control">Total items</label>-->
                                                    <!--    <h3 class="h3-control">{{ $order->total_item_count }}</h3>-->
                                                    <!--</div>-->
                                                    <!--<div class="col-sm-4">-->
                                                    <!--    <label class="label-control">Price</label>-->
                                                    <!--    <h3 class="h3-control"><i class="fa fa-inr"></i>{{ $order->order_amount }}</h3>-->
                                                    <!--</div>-->
                                                    <!--<div class="col-sm-4">-->
                                                    <!--    <label class="label-control">Total Costs</label>-->
                                                    <!--    <h3 class="h3-control"><i class="fa fa-inr"></i>{{ $order->order_amount_with_shipping }}</h3>-->
                                                    <!--</div>-->
                                                </div>
                                            </div>
                                            {{-- <h4 class="form-section"><i class="fa fa-truck"></i> Order Shipping
                                                Information</h4>
                                            <div class="table-responsive">
                                                <table id="recent-orders" class="table table-bordered table-hover">
                                                    <tbody>
                                                        <form method="POST"
                                                            action="{{ route('admin.add-shipping-to-order', $order->id) }}">
                                                            @csrf
                                                            <tr>
                                                                <th>Shipping Type</th>
                                                                <td>
                                                                    <select class="form-control" id="shipping_type"
                                                                        name="shipping_type" required>
                                                                        <option value="">Select Shipping Method</option>
                                                                        <option value="valet" @if ($order->shipping_type
                                                                            == 'valet') selected @endif>Valet</option>
                                                                        <option value="courier" @if ($order->
                                                                            shipping_type == 'courier') selected
                                                                            @endif>Courier</option>
                                                                    </select>
                                                                    <div class="text-danger" id="shipping_type-err">
                                                                    </div>p
                                                                </td>
                                                                <th>Shipping By</th>
                                                                <td>
                                                                    <div class="input-group-flex">
                                                                        <select class="form-control" id="shipping_by"
                                                                            name="shipping_by" required>
                                                                            <option value="">Select Shipping By</option>
                                                                            @if (isset($shippings) && count($shippings)
                                                                            > 0)
                                                                            @foreach ($shippings as $shipping)
                                                                            <option value="{{ $shipping->id }}" @if
                                                                                ($shipping->id == $order->shipping_id)
                                                                                selected @endif>{{ $shipping->name
                                                                                }}-({{ $shipping->mobile_number }})
                                                                            </option>
                                                                            @endforeach
                                                                            @endif
                                                                        </select>
                                                                        <div class="text-danger" id="shipping_by-err">
                                                                        </div>
                                                                        <div class="input-group-append shipping-by"
                                                                            id="button-addon2">
                                                                            <button class="btn btn-primary"
                                                                                type="submit"><i
                                                                                    class="fa fa-check"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>
                                                        <tr>
                                                            <form method="POST"
                                                                action="{{ route('admin.add-tracking-to-order', $order->id) }}">
                                                                @csrf
                                                                <th>Tracking Number</th>
                                                                <td>
                                                                    <div class="input-group-flex">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Enter Tracking Number"
                                                                            aria-describedby="button-addon2"
                                                                            name="tracking_number" id="tracking_number"
                                                                            value="{{ $order->tracking_number }}"
                                                                            required>
                                                                        <div class="text-danger"
                                                                            id="tracking_number-err"></div>
                                                                    </div>
                                                                </td>
                                                                @csrf
                                                                <th>Tracking Details</th>
                                                                <td>
                                                                    <div class="input-group-flex">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Enter Tracking Information"
                                                                            aria-describedby="button-addon2"
                                                                            name="tracking_detail" id="tracking_detail"
                                                                            value="{{ $order->tracking_detail }}"
                                                                            required>
                                                                        <div class="text-danger"
                                                                            id="tracking_detail-err"></div>
                                                                        <div class="input-group-append tracking-detail"
                                                                            id="button-addon2">
                                                                            <button class="btn btn-primary"
                                                                                type="submit"><i
                                                                                    class="fa fa-check"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </form>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4">
                                                                <p><b>Note:</b> After Entering Shipping information
                                                                    please click on Shipping Detail button to change the
                                                                    Payment Status / Order Status so that Customer may
                                                                    get Shipping information through SMS / Email</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div> --}}
                                            <div class="card">
                                                <h3 class="cart-main-tit">Order - Details</h3>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered tab-order-user">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Sr. No.</th>
                                                                        <th>Image</th>
                                                                        <th>Product Name</th>
                                                                        <th>MRP (Per QTY)</th>
                                                                        <th>Quantity</th>
                                                                        <th>Pre-Discount (Per QTY)</th>
                                                                        <!--<th>Product Description</th>-->
                                                                        <!--<th>Options</th>-->
                                                                        <th>Product Cost</th>
                                                                        <!--<th>Quantity</th>-->
                                                                        <!--@if ($order->gst_type == 'IGST')-->
                                                                        <!--    <th>IGST</th>-->
                                                                        <!--@else-->
                                                                        <!--    <th>CGST</th>-->
                                                                        <!--    <th>SGST</th>-->
                                                                        <!--@endif-->
                                                                        <!--<th>Total</th>-->
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php $prediscount = 0; @endphp
                                                                    @if (isset($order->order_detailss) && count($order->order_detailss) > 0)
                                                                        @foreach ($order->order_detailss as $key => $order_detail)
                                                                            <tr>
                                                                                <td>{{++$key}}</td>
                                                                                <td> @if(isset($order_detail->product))
                                                                                    <a href="javascript:void(0)">
                                                                                        <img src="{{ URL::asset('storage/' . $order_detail->product->image) }}"
                                                                                            class="img-fluid"
                                                                                            style="height:50px;" />
                                                                                    </a>
                                                                                @else
                                                                                        <a href="javascript:void(0)">
                                                                                            <img src="{{ URL::asset('front/images/no_image.jpg') }}"
                                                                                                class="img-fluid">
                                                                                        </a>
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    {{ $order_detail->product_name }}
                                                                                    <span
                                                                                        style="font-size:11px; font-weight:400">
                                                                                        ({{ $order_detail->product->categories->name }}
                                                                                        /
                                                                                        @if(isset($order_detail->product->subcategories))
                                                                                            {{ $order_detail->product->subcategories->name }}
                                                                                        @else
                                                                                            NA
                                                                                        @endif
                                                                                        / {{ $order_detail->brand_name }})
                                                                                    </span>
                                                                                </td>

                                                                                <!--<td>-->
                                                                                <!--    <div class="product-order-flx">-->
                                                                                <!--        <div class="pro-img">-->
                                                                                <!--            @if (isset($order_detail->product))-->
                                                                                <!--                <a href="javascript:void(0)">-->
                                                                                <!--                    <img src="{{ URL::asset('storage/' . $order_detail->product->image) }}" class="img-fluid">-->
                                                                                <!--                </a>-->
                                                                                <!--            @else-->
                                                                                <!--                <a href="javascript:void(0)">-->
                                                                                <!--                    <img src="{{ URL::asset('front/images/no_image.jpg') }}" class="img-fluid">-->
                                                                                <!--                </a>-->
                                                                                <!--            @endif-->
                                                                                <!--        </div>-->
                                                                                <!--        <div class="pro-det">-->
                                                                                <!--            <h3>-->
                                                                                <!--                {{ $order_detail->product_name }}-->
                                                                                <!--            </h3>-->
                                                                                <!--        </div>-->
                                                                                <!--    </div>-->
                                                                                <!--</td>-->
                                                                                <td>{{ $order_detail->mrp }}</td>
                                                                                @php $prediscount += $order_detail->discount_amount * $order_detail->quantity; @endphp
                                                                                <td>{{ $order_detail->quantity }}</td>
                                                                                <td>{{ $order_detail->discount_amount }}
                                                                                    <!--<p>-->
                                                                                    <!--    Color-{{ $order_detail->color_name }}-->
                                                                                    <!--    /Size -{{ $order_detail->size_name }}-->
                                                                                    <!--</p>-->
                                                                                </td>
                                                                                <td>{{ $order_detail->total_price }}</td>
                                                                                <!--<td><span class="price-tag"><i class="fa fa-inr"></i>{{ $order_detail->price }}</span></td>-->
                                                                                <!--<td>{{ $order_detail->quantity }}</td>-->
                                                                                <!--@if ($order->gst_type == 'IGST')-->
                                                                                <!--    <td><span class="price-tag"><i class="fa fa-inr"></i>{{ $order_detail->igst_amount }}</span></td>-->
                                                                                <!--@else-->
                                                                                <!--    <td><span class="price-tag"><i class="fa fa-inr"></i>{{ $order_detail->cgst_amount }}</span></td>-->
                                                                                <!--    <td><span class="price-tag"><i class="fa fa-inr"></i>{{ $order_detail->sgst_amount }}</span></td>-->
                                                                                <!--@endif-->
                                                                                <!--<td><span class="price-tag"><i class="fa fa-inr"></i>{{ $order_detail->total_price_with_gst }}</span></td>-->
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
                                                                    <!--<tr>-->
                                                                    <!--    <td></td>-->
                                                                    <!--    <td></td>-->
                                                                    <!--    <td></td>-->
                                                                    <!--    <td><span class="apply-coupon">Referral Discount</span></td>-->
                                                                    <!--    <td><span class="coupon-tag">-<i class="fa fa-inr"></i>{{ $order->referral_discount_amount }}</span></td>-->
                                                                    <!--</tr>-->
                                                                    @if ($order->gst_type == 'IGST')
                                                                        <!--<tr>-->
                                                                        <!--    <td></td>-->
                                                                        <!--    <td></td>-->
                                                                        <!--    <td></td>-->
                                                                        <!--    <td><span class="dvlry-chrge">IGST</span></td>-->
                                                                        <!--    <td><span class="dvlry-price">+<i class="fa fa-inr"></i>{{ $order->igst_amount }}</span></td>-->
                                                                        <!--</tr>-->
                                                                    @else
                                                                        <!--<tr>-->
                                                                        <!--    <td></td>-->
                                                                        <!--    <td></td>-->
                                                                        <!--    <td></td>-->
                                                                        <!--    <td><span class="dvlry-chrge">CGST</span></td>-->
                                                                        <!--    <td><span class="dvlry-price">+<i class="fa fa-inr"></i>{{ $order->cgst_amount }}</span></td>-->
                                                                        <!--</tr>-->
                                                                        <!--<tr>-->
                                                                        <!--    <td></td>-->
                                                                        <!--    <td></td>-->
                                                                        <!--    <td></td>-->
                                                                        <!--    <td><span class="dvlry-chrge">SGST</span></td>-->
                                                                        <!--    <td><span class="dvlry-price">+<i class="fa fa-inr"></i>{{ $order->sgst_amount }}</span></td>-->
                                                                        <!--</tr>-->
                                                                    @endif

                                                                </tbody>
                                                            </table>


                                                            <!-- Total -->
                                                            <table width="100%" border="0" cellpadding="0"
                                                                cellspacing="0" align="right">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <table width="500" border="0"
                                                                                cellpadding="0" cellspacing="0"
                                                                                align="right">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <!-- Table Total -->
                                                                                            <table width="480"
                                                                                                border="0"
                                                                                                cellpadding="0"
                                                                                                cellspacing="0"
                                                                                                align="right"
                                                                                                class="fullPadding">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            class="text-right">
                                                                                                            Product Mrp
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="text-right">
                                                                                                            <i
                                                                                                                class="fa fa-inr"></i>{{ $order->order_amount }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            class="text-right">
                                                                                                            Pre Discount
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="text-right text-success">
                                                                                                            {{number_format((float) $prediscount, 2, '.', '')}}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            class="text-right">
                                                                                                            Coupon
                                                                                                            Discount
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="text-right text-success">
                                                                                                            <i
                                                                                                                class="fa fa-inr"></i>{{ $order->discount_amount }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            class="text-right">
                                                                                                            Sub Total
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="text-right text-success">
                                                                                                            {{ $order->order_amount_after_discount }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    @if($order->shipping_type_price != "0")
                                                                                                        <tr>
                                                                                                            <td
                                                                                                                class="text-right">
                                                                                                                Shipping
                                                                                                                Charges</td>
                                                                                                            <td
                                                                                                                class="text-right text-danger">
                                                                                                                <i
                                                                                                                    class="fa fa-inr"></i>{{ $order->shipping_type_price }}
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    @endif
                                                                                                    <!--<tr>-->
                                                                                                    <!--  <td class="text-right">Taxes</td>-->
                                                                                                    <!--  <td class="text-right text-danger">${{ $order->total_gst_amount }}</td>-->
                                                                                                    <!--</tr>-->
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            class="text-right">
                                                                                                            Total Billed
                                                                                                            Amount</td>
                                                                                                        <td
                                                                                                            class="text-right">
                                                                                                            <i
                                                                                                                class="fa fa-inr"></i>{{ $order->order_amount_with_shipping }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                            <!-- /Table Total -->

                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <!-- /Total -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!--<div class="card">-->
                                            <!--   <div class="form-group row">-->
                                            <!--        <div class="col-sm-4">-->
                                            <!--            <label class="label-control">Car Make</label>-->
                                            <!--            <h3 class="h3-control">{{$order->brand_name}}</h3>-->
                                            <!--        </div>-->
                                            <!--        <div class="col-sm-4">-->
                                            <!--            <label class="label-control">Car Model</label>-->
                                            <!--            <h3 class="h3-control">{{$order->brandmodel_name}}</h3>-->
                                            <!--        </div>-->
                                            <!--        <div class="col-sm-4">-->
                                            <!--            <label class="label-control">Fuel Type </label>-->
                                            <!--            <h3 class="h3-control">{{$order->fuel_type}}</h3>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <div class="card">
                                                <h3 class="cart-main-tit">Shipping Details</h3>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="label-control">Name</label>
                                                        <h3 class="h3-control">{{ $order->shippingaddress->name }}</h3>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="label-control">Full Address</label>
                                                        <h3 class="h3-control">{{ $order->shippingaddress->address }}
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <!--<div class="col-sm-6">-->
                                                    <!--    <label class="label-control">Landmark</label>-->
                                                    <!--    <h3 class="h3-control">{{ $order->landmark }}</h3>-->
                                                    <!--</div>-->
                                                    <div class="col-sm-6">
                                                        <label class="label-control">Mobile No.</label>
                                                        <h3 class="h3-control">
                                                            {{ $order->shippingaddress->mobile_number }}
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class="label-control">Email</label>
                                                        <h3 class="h3-control">{{ $order->shippingaddress->email }}</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class="label-control">Address</label>
                                                        <h3 class="h3-control"> {{ $order->shippingaddress->address }}
                                                            {{ $order->shippingaddress->cities->name }}
                                                            {{ $order->shippingaddress->states->name }}
                                                            {{ $order->shippingaddress->countries->name }}
                                                            {{ $order->shippingaddress->pincode }}
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-sm-4">
                                            <div class="card">
                                                <h3 class="cart-main-tit">Billing Details</h3>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="label-control">Name</label>
                                                        <h3 class="h3-control">{{ $order->billingaddress->name }}</h3>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="label-control">Mobile No.</label>
                                                        <h3 class="h3-control">
                                                            {{ $order->billingaddress->mobile_number }}
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class="label-control">Email</label>
                                                        <h3 class="h3-control">{{ $order->billingaddress->email }}</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class="label-control">Address</label>
                                                        <h3 class="h3-control"> {{ $order->billingaddress->address }}
                                                            {{ $order->billingaddress->cities->name }}
                                                            {{ $order->billingaddress->states->name }}
                                                            {{ $order->billingaddress->countries->name }}
                                                            {{ $order->billingaddress->pincode }}
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
                            <button type="button" class="btn btn-secondary pull-right"
                                data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary pull-right refundprocesssubmit">Save
                                changes</button>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<!--  //  Process Refunds Modal -->
<div class="modal fade" id="cancelorder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                        <textarea class="form-control" name="cancellation_reason_admin"
                            id="cancellation_reason_admin"></textarea>
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
    $('body').on('click', '.refundprocess', function () {
        var id = $(this).attr('brand_id');
        console.log(id)
        $(".refundprocessbody #order_id").val(id);
        $("#refundprocess").modal('show');

    })
    $('body').on('click', '.cancel-order', function () {
        var id = $(this).attr('brand_id');
        Swal.fire({
            title: '',
            html: '<span class="h4">Do you want to Cancel The Order?</span>',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            $(".cancelorder #order_id").val(id);
            $("#cancelorder").modal('show');
        })


    })


    $(document).on("click", ".approvepayment", function (event) {
        var id = $(this).attr('brand_id');
        Swal.fire({
            title: '',
            html: '<span class="h4">Do you want to Approve The Payment?</span>',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            $.ajax({
                url: `{{ URL::to('admin/approvepayment/${id}') }}`,
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                context: this,
                success: function (result) {
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
        })

    });
    $(document).on("click", ".refundprocesssubmit", function (event) {
        $(this).attr('disabled', true);
        $('#transaction_id-err').html('');
        $('#refunded_amount-err').html('');
        $('#refunded_date-err').html('');
        let formData = new FormData();
        formData.append('transaction_id', $('.refundprocessbody #transaction_id').val());
        formData.append('refunded_amount', $('.refundprocessbody #refunded_amount').val());
        formData.append('refunded_date', $('.refundprocessbody #refunded_date').val());
        formData.append('order_id', $('.refundprocessbody #order_id').val());
        formData.append('order_status', 'Refunded');
        $.ajax({
            url: "{{ URL::to('admin/refund') }}",
            type: 'POST',
            processData: false,
            contentType: false,
            dataType: 'json',
            data: formData,
            context: this,
            success: function (result) {
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
    $(document).ready(function () {
        $(document).on("change", "#shipping_type", function (event) {
            let type = $(this).val();
            $.ajax({
                url: `{{ URL::to('admin/fetch-shipping-by-type/${type}') }}`,
                type: "get",
                dataType: "json",
                success: function (result) {
                    if (result.success) {
                        $("#shipping_by").html(result.html);
                    } else {

                    }
                }
            });
        });
    });

    $(document).on("click", ".add-cancelorder", function (event) {
        $(this).attr('disabled', true);
        $('#reason-err').html('');
        $('#cancellation_reason_admin-err').html('');
        let formData = new FormData();
        formData.append('reason', $('.cancelorder #reason').val());
        formData.append('cancellation_reason_admin', $('.cancelorder #cancellation_reason_admin').val());
        formData.append('order_id', $('.cancelorder #order_id').val());
        formData.append('order_status', 'Cancelled');
        $.ajax({
            url: "{{ URL::to('admin/update-cancel-order-status') }}",
            type: 'POST',
            processData: false,
            contentType: false,
            dataType: 'json',
            data: formData,
            context: this,
            success: function (result) {
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

</script>