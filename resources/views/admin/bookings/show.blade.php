@include('admin.header')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">ORDERS</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.manage-order.index') }}">Order management</a></li>
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
                                <h4>VIEW - ORDER #{{ $objs->order_number }} <span class="badge badge-success">Order {{ $objs->order_status }}</span></h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i> Refresh</a> </li>
                                        <li><a href="javascript:history.go(-1)"><i class="fa fa-backward"></i> Go Back</a> </li>
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
                                                    <div class="col-sm-4">
                                                        <label class="label-control">Customer Name</label>
                                                        <h3 class="h3-control">{{ $objs->name }}</h3>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="label-control">Email/Mobile Number</label>
                                                        <h3 class="h3-control">{{ $objs->email }}/{{$objs->mobile_number}}</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label class="label-control">Booking ID</label>
                                                        <h3 class="h3-control">{{ '#'.$objs->booking_number }}</h3>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="label-control">Order Date & Time</label>
                                                        <h3 class="h3-control">{{ $objs->created_at }}</h3>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="label-control">Total Services</label>
                                                        <h3 class="h3-control">{{ $objs->total_services }}</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label class="label-control">Payment Status</label>
                                                        <h3 class="h3-control">{{ $objs->payment_status }}</h3>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="label-control">Price</label>
                                                        <h3 class="h3-control"><i class="fa fa-inr"></i>{{ $objs->cost }}</h3>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="label-control">Total Costs</label>
                                                        <h3 class="h3-control"><i class="fa fa-inr"></i>{{ $objs->total_cost }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <h4 class="form-section"><i class="fa fa-truck"></i> Order Shipping Information</h4>
                                            <div class="table-responsive">
                                                <table id="recent-orders" class="table table-bordered table-hover">
                                                    <tbody>
                                                        <form method="POST" action="{{ route('admin.add-shipping-to-order', $objs->id) }}">
                                                            @csrf
                                                            <tr>
                                                                <th>Shipping Type</th>
                                                                <td>
                                                                    <select class="form-control" id="shipping_type" name="shipping_type" required>
                                                                        <option value="">Select Shipping Method</option>
                                                                        <option value="valet" @if ($objs->shipping_type == 'valet') selected @endif>Valet</option>
                                                                        <option value="courier" @if ($objs->shipping_type == 'courier') selected @endif>Courier</option>
                                                                    </select>
                                                                    <div class="text-danger" id="shipping_type-err"></div>
                                                                </td>
                                                                <th>Shipping By</th>
                                                                <td>
                                                                    <div class="input-group-flex">
                                                                        <select class="form-control" id="shipping_by" name="shipping_by" required>
                                                                            <option value="">Select Shipping By</option>
                                                                            @if (isset($shippings) && count($shippings) > 0)
                                                                                @foreach ($shippings as $shipping)
                                                                                    <option value="{{ $shipping->id }}" @if ($shipping->id == $objs->shipping_id) selected @endif>{{ $shipping->name }}-({{ $shipping->mobile_number }})</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </select>
                                                                        <div class="text-danger" id="shipping_by-err"></div>
                                                                        <div class="input-group-append shipping-by" id="button-addon2">
                                                                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </form>
                                                        <tr>
                                                            <form method="POST" action="{{ route('admin.add-tracking-to-order', $objs->id) }}">
                                                                @csrf
                                                                <th>Tracking Number</th>
                                                                <td>
                                                                    <div class="input-group-flex">
                                                                        <input type="text" class="form-control" placeholder="Enter Tracking Number" aria-describedby="button-addon2" name="tracking_number" id="tracking_number" value="{{ $objs->tracking_number }}" required>
                                                                        <div class="text-danger" id="tracking_number-err"></div>
                                                                    </div>
                                                                </td>
                                                                @csrf
                                                                <th>Tracking Details</th>
                                                                <td>
                                                                    <div class="input-group-flex">
                                                                        <input type="text" class="form-control" placeholder="Enter Tracking Information" aria-describedby="button-addon2" name="tracking_detail" id="tracking_detail" value="{{ $objs->tracking_detail }}" required>
                                                                        <div class="text-danger" id="tracking_detail-err"></div>
                                                                        <div class="input-group-append tracking-detail" id="button-addon2">
                                                                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </form>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4">
                                                                <p><b>Note:</b> After Entering Shipping information please click on Shipping Detail button to change the Payment Status / Order Status so that Customer may get Shipping information through SMS / Email</p>
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
                                                                        <th>Image</th>
                                                                        <th>Product Name</th>
                                                                        <th>MRP</th>
                                                                        <th>Discount</th>
                                                                        <!--<th>Product Description</th>-->
                                                                        <!--<th>Options</th>-->
                                                                        <th>Price</th>
                                                                        <th>Quantity</th>
                                                                        @if ($objs->gst_type == 'IGST')
                                                                            <th>IGST</th>
                                                                        @else
                                                                            <th>CGST</th>
                                                                            <th>SGST</th>
                                                                        @endif
                                                                        <th>Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if (isset($objs->order_details) && count($objs->order_details) > 0)
                                                                        @foreach ($objs->order_details as $objs_detail)
                                                                            <tr>
                                                                                <td> @if (isset($objs_detail->product))
                                                                                                <a href="javascript:void(0)">
                                                                                                    <img src="{{ URL::asset('storage/' . $objs_detail->product->image) }}" class="img-fluid">
                                                                                                </a>
                                                                                            @else
                                                                                                <a href="javascript:void(0)">
                                                                                                    <img src="{{ URL::asset('front/images/no_image.jpg') }}" class="img-fluid">
                                                                                                </a>
                                                                                            @endif
                                                                                            </td>
                                                                                <td>{{$objs_detail->product_name}}</td>
                                                                                <!--<td>-->
                                                                                <!--    <div class="product-order-flx">-->
                                                                                <!--        <div class="pro-img">-->
                                                                                <!--            @if (isset($objs_detail->product))-->
                                                                                <!--                <a href="javascript:void(0)">-->
                                                                                <!--                    <img src="{{ URL::asset('storage/' . $objs_detail->product->image) }}" class="img-fluid">-->
                                                                                <!--                </a>-->
                                                                                <!--            @else-->
                                                                                <!--                <a href="javascript:void(0)">-->
                                                                                <!--                    <img src="{{ URL::asset('front/images/no_image.jpg') }}" class="img-fluid">-->
                                                                                <!--                </a>-->
                                                                                <!--            @endif-->
                                                                                <!--        </div>-->
                                                                                <!--        <div class="pro-det">-->
                                                                                <!--            <h3>-->
                                                                                <!--                {{ $objs_detail->product_name }}-->
                                                                                <!--            </h3>-->
                                                                                <!--        </div>-->
                                                                                <!--    </div>-->
                                                                                <!--</td>-->
                                                                                <td>{{ $objs_detail->mrp }}</td>
                                                                                <td>
                                                                                    <p>
                                                                                        Color-{{ $objs_detail->color_name }}
                                                                                        /Size -{{ $objs_detail->size_name }}
                                                                                    </p>
                                                                                </td>
                                                                                <td><span class="price-tag"><i class="fa fa-inr"></i>{{ $objs_detail->price }}</span></td>
                                                                                <td>{{ $objs_detail->quantity }}</td>
                                                                                @if ($objs->gst_type == 'IGST')
                                                                                    <td><span class="price-tag"><i class="fa fa-inr"></i>{{ $objs_detail->igst_amount }}</span></td>
                                                                                @else
                                                                                    <td><span class="price-tag"><i class="fa fa-inr"></i>{{ $objs_detail->cgst_amount }}</span></td>
                                                                                    <td><span class="price-tag"><i class="fa fa-inr"></i>{{ $objs_detail->sgst_amount }}</span></td>
                                                                                @endif
                                                                                <td><span class="price-tag"><i class="fa fa-inr"></i>{{ $objs_detail->total_price_with_gst }}</span></td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td><span class="subtotal">Sub Total</span></td>
                                                                        <td><span class="subtotal-price"><i class="fa fa-inr"></i>{{ $objs->order_amount }}</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td><span class="apply-coupon">Coupon Discount</span></td>
                                                                        <td><span class="coupon-tag">-<i class="fa fa-inr"></i>{{ $objs->discount_amount }}</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td><span class="apply-coupon">Referral Discount</span></td>
                                                                        <td><span class="coupon-tag">-<i class="fa fa-inr"></i>{{ $objs->referral_discount_amount }}</span></td>
                                                                    </tr>
                                                                    @if ($objs->gst_type == 'IGST')
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td><span class="dvlry-chrge">IGST</span></td>
                                                                            <td><span class="dvlry-price">+<i class="fa fa-inr"></i>{{ $objs->igst_amount }}</span></td>
                                                                        </tr>
                                                                    @else
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td><span class="dvlry-chrge">CGST</span></td>
                                                                            <td><span class="dvlry-price">+<i class="fa fa-inr"></i>{{ $objs->cgst_amount }}</span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td><span class="dvlry-chrge">SGST</span></td>
                                                                            <td><span class="dvlry-price">+<i class="fa fa-inr"></i>{{ $objs->sgst_amount }}</span></td>
                                                                        </tr>
                                                                    @endif
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td><span class="dvlry-chrge">Shipping Fee</span></td>
                                                                        <td><span class="dvlry-price">+<i class="fa fa-inr"></i>{{ $objs->shipping_type_price }}</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td><span class="total-amount">Total Amount</span></td>
                                                                        <td><span class="total-price"><i class="fa fa-inr"></i>{{ $objs->order_amount_with_shipping }}</span></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="card">
                                                <h3 class="cart-main-tit">Shipping Details</h3>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label class="label-control">Name</label>
                                                        <h3 class="h3-control">{{ $objs->name }}</h3>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="label-control">Full Address</label>
                                                        <h3 class="h3-control">{{ $objs->address }}</h3>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="label-control">Landmark</label>
                                                        <h3 class="h3-control">{{ $objs->landmark }}</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class="label-control">Mobile No.</label>
                                                        <h3 class="h3-control">{{ $objs->mobile_number }}</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class="label-control">Email</label>
                                                        <h3 class="h3-control">{{ $objs->email }}</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class="label-control">Address</label>
                                                        <h3 class="h3-control"> {{ $objs->address }} {{ $objs->city }} {{ $objs->state }} {{ $objs->country }} {{ $objs->pincode }} </h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <ul class="card-actns">
                                                    @if ($objs->order_status = !'cancelled' || ($objs->order_status = !'delivered'))
                                                        <li>
                                                            <form action="" method="POST">
                                                                @csrf
                                                                <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure ?')">Cancel Order</button>
                                                            </form>
                                                        </li>
                                                    @endif
                                                    {{-- <li>
                                                        <a href="{{ route('admin.manage-order-tracking', $objs->id) }}" class="btn btn-bitbucket btn-sm">Track Order</a>
                                                    </li> --}}
                                                    <li>
                                                        <a href="" class="btn btn-blue btn-sm">Invoice</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                         <div class="col-sm-4">
                                            <div class="card">
                                                <h3 class="cart-main-tit">Billing Details</h3>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class="label-control">Name</label>
                                                        <h3 class="h3-control">{{ $objs->name }}</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class="label-control">Mobile No.</label>
                                                        <h3 class="h3-control">{{ $objs->mobile_number }}</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class="label-control">Email</label>
                                                        <h3 class="h3-control">{{ $objs->email }}</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class="label-control">Address</label>
                                                        <h3 class="h3-control"> {{ $objs->address }} {{ $objs->city }} {{ $objs->state }} {{ $objs->country }} {{ $objs->pincode }} </h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <ul class="card-actns">
                                                    @if ($objs->order_status = !'cancelled' || ($objs->order_status = !'delivered'))
                                                        <li>
                                                            <form action="" method="POST">
                                                                @csrf
                                                                <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure ?')">Cancel Order</button>
                                                            </form>
                                                        </li>
                                                    @endif
                                                    {{-- <li>
                                                        <a href="{{ route('admin.manage-order-tracking', $objs->id) }}" class="btn btn-bitbucket btn-sm">Track Order</a>
                                                    </li> --}}
                                                    <li>
                                                        <!--<a href="" class="btn btn-blue btn-sm">Invoice</a>-->
                                                    </li>
                                                </ul>
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
@include('admin.footer')
<script>
    $(document).ready(function() {
        $(document).on("change", "#shipping_type", function(event) {
            let type = $(this).val();
            $.ajax({
                url: `{{ URL::to('admin/fetch-shipping-by-type/${type}') }}`,
                type: "get",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#shipping_by").html(result.html);
                    } else {

                    }
                }
            });
        });
    });
</script>
