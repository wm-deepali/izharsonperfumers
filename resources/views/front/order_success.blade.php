@extends('front.app')

@section('title', 'Page Vendor List')

@section('content')

  <!-- Inner Page Breadcrumb -->
  <section class="inner_page_breadcrumb">
    <div class="container">
      <div class="row">
        <div class="col-xl-6">
          <div class="breadcrumb_content">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Home</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page"><a href="#">Thank You</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Shop Checkouts Content -->
  <section class="shop-cart pt30">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="order_complete_message text-center">
            <div class="icon bgc-thm"><span class="fa fa-check color-white"></span></div>

            @if($order->payment_method === 'offline' && $order->payment_status === 'pending')
              <h2 class="title">Order Received !</h2>
              <p class="para">Thank you. Your order has been received and is awaiting payment confirmation.</p>
            @else
              <h2 class="title">Your Order Is Completed !</h2>
              <p class="para">Thank you. Your order has been received.</p>
            @endif
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-8 offset-xl-2">
          <div class="shop_order_box mt25">
            <div class="order_list_raw text-center">
              <ul>
                <li class="list-inline-item">
                  <p>Order Number</p>
                  <h5>{{ $order->order_number }}</h5>
                </li>
                <li class="list-inline-item">
                  <p>Date</p>
                  <h5>{{ $order->created_at->format('d/m/Y') }}</h5>
                </li>
                <li class="list-inline-item">
                  <p>Total</p>
                  <h5>₹{{ number_format($order->order_amount_with_shipping, 2) }}</h5>
                </li>
                <li class="list-inline-item">
                  <p>Payment Method</p>
                  <h5>
                    @if($order->payment_method === 'offline')
                      Direct Bank Transfer
                    @elseif($order->payment_method === 'online')
                      {{ ucfirst($order->payment_gateway ?? 'Online') }}
                    @else
                      {{ ucfirst($order->payment_method) }}
                    @endif
                  </h5>
                </li>
                <li class="list-inline-item">
                  <p>Payment Status</p>
                  <h5>{{ ucfirst($order->payment_status) }}</h5>
                </li>
              </ul>

              @if($order->invoice_url)
                <div class="mt15">
                  <a href="{{ url('storage' . $order->invoice_url) }}" class="btn btn-thm" target="_blank">
                    Download Invoice
                  </a>
                </div>
              @endif
            </div>
            <div class="order_details">
              <h4 class="title mb25">Order Details</h4>
              <div class="od_content">
                <ul>
                  <li class="subtitle bb1 mb15">
                    <p>Product <span class="float-end">Subtotal</span></p>
                  </li>
                  @php $prediscount = 0; @endphp
                  @foreach($order->order_detailss as $item)
                    <li>
                      <p class="product_name_qnt">{{ $item->product_name }} x {{ $item->quantity }} <span
                          class="float-end">₹{{ number_format($item->price * $item->quantity, 2) }}</span></p>
                    </li>
                    @php $prediscount += $item->discount_amount * $item->quantity; @endphp
                  @endforeach
                  <li class="subtitle bt1 bb1 mb10 mt15 pt10">
                    <p>Sub Total
                      <span class="float-end">₹{{ number_format($order->order_amount, 2) }}</span>
                    </p>
                  </li>

                  @if($prediscount > 0)
                    <li class="subtitle bb1 mb10">
                      <p>Pre Discount
                        <span class="float-end text-success">
                          - ₹{{ number_format($prediscount, 2) }}
                        </span>
                      </p>
                    </li>
                  @endif

                  @if($order->discount_amount > 0)
                    <li class="subtitle bb1 mb10">
                      <p>Discount
                        @if($order->coupon_code)
                          ({{ $order->coupon_code }})
                        @endif
                        <span class="float-end text-success">
                          - ₹{{ number_format($order->discount_amount, 2) }}
                        </span>
                      </p>
                    </li>
                  @endif

                  @if($order->discount_amount > 0 || $prediscount > 0)
                    <li class="subtitle bb1 mb10">
                      <p>Amount After Discount
                        <span class="float-end">
                          ₹{{ number_format($order->order_amount_after_discount, 2) }}
                        </span>
                      </p>
                    </li>
                  @endif

                  @if($order->total_gst_amount > 0)
                    <li class="subtitle bb1 mb10">
                      <p>GST ({{ $order->total_gst_percentage }}%)
                        <span class="float-end">
                          ₹{{ number_format($order->total_gst_amount, 2) }}
                        </span>
                      </p>
                    </li>
                  @endif

                  <li class="subtitle bb1 mb10">
                    <p>Shipping
                      <span class="float-end">
                        {{ $order->shipping_type_price == 0 ? 'Free Shipping' : '₹' . number_format($order->shipping_type_price, 2) }}
                      </span>
                    </p>
                  </li>

                  <li class="subtitle">
                    <p>Total
                      <span class="float-end totals">
                        ₹{{ number_format($order->order_amount_with_shipping, 2) }}
                      </span>
                    </p>
                  </li>

                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection