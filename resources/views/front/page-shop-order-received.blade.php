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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Electronics</a></li>
              <li class="breadcrumb-item"><a href="#">Computers</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="#">Desktop Computers</a></li>
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
            <h2 class="title">Your Order Is Completed !</h2>
            <p class="para">Thank you. Your order has been received.</p>
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
                  <h5>039422</h5>
                </li>
                <li class="list-inline-item">
                  <p>Date</p>
                  <h5>27/04/2022</h5>
                </li>
                <li class="list-inline-item">
                  <p>Total</p>
                  <h5>₹2984.10</h5>
                </li>
                <li class="list-inline-item">
                  <p>Payment Method</p>
                  <h5>Direct Bank Transfer</h5>
                </li>
              </ul>
            </div>
            <div class="order_details">
              <h4 class="title mb25">Order Details</h4>
              <div class="od_content">
                <ul>
                  <li class="subtitle bb1 mb15"><p>Product <span class="float-end">Subtotal</span></p></li>
                  <li><p class="product_name_qnt">Apple MacBook Pro with Apple M1 Chip x 2 <span class="float-end">₹229.99</span></p></li>
                  <li><p class="product_name_qnt">Apple MacBook Pro with Apple M1 Chip x 2 <span class="float-end">₹229.99</span></p></li>
                  <li class="subtitle bt1 bb1 mb10 mt15 pt10"><p>Sub Total <span class="float-end">₹89.90</span></p></li>
                  <li class="subtitle bb1 mb10"><p>Shipping <span class="float-end free_shipping">Free shipping</span></p></li>
                  <li class="subtitle bb1 mb10"><p>VAT <span class="float-end totals">₹19</span></p></li>
                  <li class="subtitle bb1 mb10"><p>Payment Method <span class="float-end fwn_bd_color">Direct bank transfer</span></p></li>
                  <li class="subtitle"><p>Total <span class="float-end totals">₹1319</span></p></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
		</div>
	</section>
  
@endsection