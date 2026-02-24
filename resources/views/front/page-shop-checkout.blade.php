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
	<section class="shop-checkouts pt30">
		<div class="container">
      <div class="row">
        <div class="col-sm-6 col-lg-4 m-auto">
          <div class="main-title text-center mb50">
            <h2 class="title">Checkout</h2>
          </div>
        </div>
      </div>
			<div class="row">
				<div class="col-lg-8 col-xl-9">
					<div class="checkout_form style2">
            <div class="main-title mb50">
              <p>Returning customer? <a class="signin-filter-btn" href="#">Click here to login</a></p>
            </div>
				    <h4 class="title mb20">Billing details</h4>
						<div class="checkout_coupon ui_kit_button">
	            <form class="form2" id="coupon_form" name="contact_form" action="#" method="post">
								<div class="row">
	                <div class="col-sm-6">
                    <div class="form-group">
                      <label class="form-label">First name *</label>
											<input class="form-control form_control" type="text" placeholder="Ali">
										</div>
	                </div>
	                <div class="col-sm-6">
                    <div class="form-group">
                      <label class="form-label">Last name *</label>
											<input class="form-control form_control" type="text" placeholder="Tufan">
										</div>
	                </div>
	                <div class="col-sm-12">
                    <div class="form-group">
                      <label class="form-label">Company name</label>
											<input class="form-control form_control" type="text">
										</div>
	                </div>
							    <div class="col-lg-12">
										<div class="form-group">
                      <label class="form-label">Country / Region *</label>
                      <div class="checkout_country_form actegory">
                        <select class="selectpicker show-tick">
                          <option>Select</option>
                          <option value="Turkey">Turkey</option>
                          <option value="United Kingdom">United Kingdom</option>
                          <option value="United States">United States</option>
                          <option value="Ukraine">Ukraine</option>
                          <option value="Uruguay">Uruguay</option>
                          <option value="UK">UK</option>
                          <option value="Uzbekistan">Uzbekistan</option>
                        </select>
                      </div>
										</div>
									</div>
	                <div class="col-sm-12">
                    <div class="form-group">
                      <label class="form-label">Street address *</label>
											<input class="form-control form_control mb10" type="text">
											<input class="form-control form_control" type="text">
										</div>
	                </div>
	                <div class="col-sm-12">
                    <div class="form-group">
                      <label class="form-label">Town / City *</label>
											<input class="form-control form_control" type="number">
										</div>
	                </div>
	                <div class="col-sm-12">
                    <div class="form-group">
                      <label class="form-label">State *</label>
                      <div class="checkout_country_form">
                        <select class="selectpicker show-tick">
                          <option>Select</option>
                          <option value="Istanbul">Istanbul</option>
                          <option value="London">London</option>
                          <option value="NewYork">New York</option>
                          <option value="Paris">Paris</option>
                          <option value="Dubai">Dubai</option>
                          <option value="Rome">Rome</option>
                          <option value="Singapore">Singapore</option>
                        </select>
                      </div>
										</div>
	                </div>
	                <div class="col-sm-12">
                    <div class="form-group">
                      <label class="form-label">ZIP *</label>
											<input class="form-control form_control" type="text">
										</div>
	                </div>
	                <div class="col-sm-6">
                    <div class="form-group">
                      <label class="form-label">Phone *</label>
											<input name="form_phone" class="form-control form_control" type="number">
										</div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="form-label">Your Email</label>
                    	<input name="form_email" class="form-control form_control email" type="email">
                    </div>
	                </div>
                  <div class="col-sm-12">
                    <div class="ui_kit_checkbox">
                      <label class="custom_checkbox">Create an account?
                        <input type="checkbox">
                        <span class="checkmark"></span>
                      </label>
                    </div>
                  </div>
	                <div class="col-sm-12">
                    <div class="form-group mb0">
                      <div class="mb35 mt50">
                        <h4 class="fz20">Shipping Details</h4>
                      </div>
                      <div class="ui_kit_checkbox">
                        <label class="custom_checkbox">Ship to a different address?
                          <input type="checkbox">
                          <span class="checkmark"></span>
                        </label>
                      </div>
                    	<label class="ai_title">Order notes (optional)</label>
                      <textarea name="form_message" class="form-control" rows="12" placeholder="">Order Notes</textarea>
                    </div>
	                </div>
                </div>
              </form>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-xl-3">
					<div class="order_sidebar_widget checkout_page mb30 mb30">
						<h4 class="title">Your Order</h4>
            <ul>
              <li><p class="product_name_qnt">Apple MacBook Pro with Apple M1 Chip x 2 </p><span class="price">₹229.99</span></li>
              <li class="pb0"><p class="product_name_qnt">Apple MacBook Pro with Apple M1 Chip x 2 </p><span class="price">₹229.99</span></li>
              <li class="subtitle"><p>Sub Total <span class="float-end totals">₹854.98</span></p></li>
              <li class="subtitle"><p>Shipping <span class="float-end totals">₹20</span></p></li>
              <li class="subtitle"><p>Total <span class="float-end totals">₹225.98</span></p></li>
            </ul>
          </div>
          <div class="order_sidebar_widget checkout_page mb30 mb30">
            <div class="payment_method">
              <div class="ui_kit_radiobox pm_content bb1">
                <div class="radio mb10">
                  <input id="radio_one" name="radio" type="radio" checked="">
                  <label class="pmtitle" for="radio_one"><span class="radio-label"></span> Direct bank transfer</label>
                </div>
                <div class="pm_details">
                  <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                </div>
              </div>
              <div class="ui_kit_radiobox pm_content bb1">
                <div class="radio mb10">
                  <input id="radio_one2" name="radio" type="radio">
                  <label class="pmtitle" for="radio_one2"><span class="radio-label"></span> Check Payment</label>
                </div>
              </div>
              <div class="ui_kit_radiobox pm_content">
                <div class="radio mb10">
                  <input id="radio_one3" name="radio" type="radio">
                  <label class="pmtitle" for="radio_one3"><span class="radio-label"></span> Cash on Delivery</label>
                </div>
              </div>
            </div>
          </div>
          <div class="ui_kit_checkbox checkout_pm">
            <label class="custom_checkbox">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
          </div>
          <div class="ui_kit_button payment_widget_btn">
            <button type="button" class="btn btn-thm btn-block mb0"><a href="page-shop-order-received.html"> Place Order</a></button>
          </div>
				</div>
			</div>
		</div>
	</section>
    
@endsection