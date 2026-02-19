@extends('frontend.includes.main')
@section('title','Shipping Details')
@section('content')
    <section class="py-3 bg-light">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb custom-breadcumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('listing') }}">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
          </ol>
        </nav>
      </div>
    </section>
    <section class="cart-section mb-3">
      <div class="container">
        <div class="add-to-cart-flex">
          <div class="add-to-cart-left">

          <div class="save-address border p-2 mb-3">
            <h6 class="mb-3 border-bottom p-2 bg-light">Shipping Addresses</h6>

					@if (isset($customer_addresses) && count($customer_addresses) > 0)
                        @foreach ($customer_addresses as $customer_address)
            <div  @if ($loop->iteration == 1) class="address-bbok-box position-relative mx-0 select_addressbook_color"
                            @else
                            class="address-bbok-box position-relative mx-0" @endif>
                        <label class="custom-radio-btn">
                      <div class="name-location d-flex">
                      
                       <h5>{{ $customer_address->name }} <span class="h6 text-success">({{ $customer_address->address_type }})</span></h5>
                      </div>

                     <p>{{ $customer_address->address }}, {{ getCityName($customer_address->city) }}, {{ getStateName($customer_address->state) }} , {{ getCountryName($customer_address->country) }} - {{ $customer_address->pincode }}</p>
                      <input type="radio" class="address" name="address" value="{{ $customer_address->id }}" data-id="shipping" @if ($loop->iteration == 1) checked @endif />
                                    <span class="checkmark"></span>
                                </label>
                  
                          <button class="edit-button btn address-book-edit" onclick="deleteConfirmation({{ $customer_address->id }})"> Remove </button>
                          
                    </div>
                    @endforeach
                    @else
                    <div class="align-center">No saved address found!</div>
                    
                      <input type="radio" class="address" name="address" value="0" checked style="display:none;" />
                    @endif

                  

          </div>  
<div class="save-address border p-2 mb-3">
            <h6 class="mb-3 border-bottom p-2 bg-light">Billing Addresses</h6>

                    @if (isset($billing_addresses) && count($billing_addresses) > 0)
                        @foreach ($billing_addresses as $customer_address)
            <div  @if ($loop->iteration == 1) class="address-bbok-box position-relative mx-0 select_addressbook_color"
                            @else
                            class="address-bbok-box position-relative mx-0" @endif>
                        <label class="custom-radio-btn">
                      <div class="name-location d-flex">
                      
                       <h5>{{ $customer_address->name }} <span class="h6 text-success">({{ $customer_address->address_type }})</span></h5>
                      </div>

                    <p>{{ $customer_address->address }}, {{ getCityName($customer_address->city) }}, {{ getStateName($customer_address->state) }} , {{ getCountryName($customer_address->country) }} - {{ $customer_address->pincode }}</p>
                      <input type="radio" class="address" name="address" value="{{ $customer_address->id }}" data-id="billing" />
                                    <span class="checkmark"></span>
                                </label>
                  
                          <button class="edit-button btn address-book-edit" onclick="deletebillingConfirmation({{ $customer_address->id }})"> Remove </button>
                        
                            
                    </div>
                    @endforeach
                    @else
                    <div class="align-center">No saved address found!</div>
                 
                     <input type="radio" class="address" name="address" value="0" checked style="display:none;"  />
                    @endif

                  

          </div> 

          <div class="address-form-section p-2">
            <h6 class="mb-3 border-bottom p-2 bg-light">Add New Address</h6>
            <!-- start Shipping Address -->
                 <form id="address-form">
                        <div class="row border p-3">
                           <!--  <div class="col-12">
                                <h5>Shipping Address</h5>
                            </div> -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="name" id="name">
                                    <div class="text-danger validation-err" id="name-err"></div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Email Id</label>
                                    <input type="email" class="form-control" placeholder="Enter Email Address" name="email" id="email">
                                    <div class="text-danger validation-err" id="email-err"></div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Mobile Number</label>
                                    <input type="number" class="form-control" placeholder="Enter Mobile Number" name="mobile_number" id="mobile_number">
                                    <div class="text-danger validation-err" id="mobile_number-err"></div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Country</label>
                                 <select class="form-control" name="country" id="country" required>

                                    <option value="">Select</option>

                                  @if (isset($countries) && count($countries) > 0)

                                 @foreach ($countries as $country)

                                <option value="{{ $country->id }}" >{{ $country->name }}</option>

                                 @endforeach

                                    @endif

                                 </select>
               <div class="text-danger validation-err" id="country-err"></div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>State </label>
                                 <select class="form-control" name="state" id="state" required>
                                    <option value="">Select</option>

                                    @if (isset($states) && count($states) > 0)

                                    @foreach ($states as $state)

                                    <option value="{{ $state->id }}">{{ $state->name }}</option>

                                   @endforeach

                                         @endif                                                                 
                                     </select>

                                    <div class="text-danger validation-err" id="state-err"></div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>City </label>
                                         <select class="form-control" name="city" id="city" required>

                                    <option value="">Select</option>

                                  @if (isset($cities) && count($cities) > 0)

                                 @foreach ($cities as $city)

                                <option value="{{ $city->id }}">{{ $city->name }}</option>

                                 @endforeach

                                    @endif

                                 </select>
                                    <div class="text-danger validation-err" id="city-err"></div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>ZipCode / PinCode</label>
                                    <input type="text" class="form-control" placeholder="Enter Zipcode / PinCode" name="pincode" id="pincode">
                                    <div class="text-danger validation-err" id="pincode-err"></div>
                                </div>
                            </div>

                             <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Address For</label>
                                   <select class="form-control" name="addressFor" id="addressFor" required>

                                    <option value="">Select</option>

                               
                                <option value="shipping" selected>Shipping</option>
                                  <option value="billing">Billing</option>

                               
                                 </select>
                                    <div class="text-danger validation-err" id="addressFor-err"></div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="wdinput form-group">
                                    <label>Full Address </label>
                                    <textarea class="form-control" rows="4" placeholder="Enter Full Address" name="address" id="address"></textarea>
                                    <div class="text-danger validation-err" id="address-err"></div>
                                </div>
                            </div>
                            <div class="col-12 my-2">
                                <label class="custom-radio-btn d-inline-block">Home
                                    <input type="radio" class="address_type" name="address_type" value="home" checked="checked">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="custom-radio-btn ml-2 d-inline-block ">Office
                                    <input type="radio" class="address_type" name="address_type" value="office">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="ml-auto same-address-checkbox d-flex align-items-center">
                                    <label>  Billing Address Same?
                                        <input type="checkbox" name="sameBillShip" id="sameBillShip" value="1" /><span>Yes</span> </label>
                                    </span>

                                <!-- <span class="ml-auto same-address-checkbox d-flex align-items-center">
				                	<label>  Billing Address Same?
				                		<input type="checkbox" name="sameAddress" id="sameAddress" value="1" checked/><span>Yes</span> </label>
				                	</span>  -->

                                
                            </div>
                            <div class="col-12">
                            
                                <button class="btn bg-dark text-white" type="button" id="add-address-btn">Submit </button>
          
                            </div>
            	
                        </div>
                    </form>
<!-- Shipping Addresss End  -->


          </div> 
          
          </div>


              <div class="checkout-sidebar p-2">
                <h3 class="border-bottom h5 pb-2">Payment Forms</h3>
                <div class="sub-total d-flex border-bottom">
                    <h5 class="font-weight-medium h6 mr-auto">Subtotal</h5>
                    <h5 class="font-weight-medium h6"><i class="rupees-icon mb-0">₹</i> {{ $cart->total_price }}</h5>
                </div>
                <div class="sub-total d-flex border-bottom">
                    <h5 class="font-weight-medium h6 mr-auto">Discount</h5>
                    <h5 class="font-weight-medium h6"><i class="rupees-icon mb-0">₹</i> {{ $cart->discount_amount }}</h5>
                </div>
                <div class="sub-total d-flex border-bottom">
                    <h5 class="font-weight-medium h6 mr-auto" id="gst_type">GST</h5>
                    <h5 class="font-weight-medium h6" id="total_gst_amount"><i class="rupees-icon mb-0">₹</i> 0</h5>
                </div>
                <div class="shipping-option mt-3 border-bottom">
                    <h5 class="font-weight-medium mr-auto font-weight-medium h6 mb-3">Shipping Cost</h5>

        
                      <div class="d-flex">
                                <label class="custom-radio-btn">{{ $shippingCost->name }}
                                    <input type="radio" class="shipping_type" name="shipping_type" value="{{ $shippingCost->id }}" @if ($shippingCost->id == $default_shipping_cost->id) checked @endif>
                                    <span class="checkmark"></span>
                                </label>

                                <h5 class="font-weight-medium h6 ml-auto" id="total_shipping_cost"><i class="rupees-icon mb-0">₹ </i>0</h5>
                            </div>
                           
                    <!-- cost_of_Shipping -->
                    <div class="text-danger validation-err" id="order-shipping_type-err"></div>
                </div>
                <div class="sub-total d-flex border-bottom mt-2">
                    <h5 class="font-weight-medium h6 mr-auto">Total</h5>
                    <h5 class="font-weight-medium h6" id="cart_total">
                        <i class="rupees-icon mb-0">₹</i>
                        @if ($default_shipping_cost)
                            {{ $cart->total_price_after_discount + $default_shipping_cost->in_state_charge }}
                        @else
                            {{ $cart->total_price_after_discount }}
                        @endif
                    </h5>
                </div>

                <div class="alert-msg-pincode mt-2">
                    <small class="text-danger" id="enter_delivery-pincode"></small>
                    <small class="text-success" id="check_delivery-message"></small>
                    <small class="text-danger" id="no-check_delivery-message"></small>
                    <small class="text-danger" id="no-payment-message"></small>
                </div>
                <div class="col-12 my-2">
                    <h5 class="font-weight-medium h6 mr-auto">Choose Payment Method</h5>
                    <div class="alert-msg-pincode mt-2">
                        <small class="text-danger" id="choose-payment-option"></small>
                    </div>
                    @php $cash = DB::table('general_settings')->where('id', '1')->first(); @endphp
                    @if($cash->cod == 'yes')
                        <label class="custom-radio-btn d-inline-block">Cash On Delivery
                            <input type="radio" name="payment_method" value="cash_on_delivery"  id="cash_on_delivery">
                            <span class="checkmark"></span>
                        </label>
                    @endif
                    <label class="custom-radio-btn ml-2 d-inline-block ">Pay Online
                        <input type="radio" name="payment_method" value="pay_online" id="pay_online">
                        <span class="checkmark"></span>
                    </label>
                </div>
                           
                <button class="btn proceed-to-checkout my-3 bg-dark text-white w-100" id="submit-order-btn">  Order Now </button>
                <button class="btn proceed-to-checkout my-3 bg-dark text-white w-100" id="pay-online-btn" style="display: none;"> Order Now </button>
            </div>
          <!-- end confirm paymetns  section  -->
        </div>
      </div>
    </section>
    
    <script>
        $(function(){
            $("#HideSection").hide();
            $("#sameAddress").on("click", function(){
                  if($('#sameAddress').is(":checked"))   
                    $("#HideSection").hide();
                else
                    $("#HideSection").show();
            });
        });

        $("#pay_online").on("click", function(){
            if($('#pay_online').is(":checked")) {
                 $("#submit-order-btn").hide();
                $("#pay-online-btn").show();
            } 
        });


        $("#cash_on_delivery").on("click", function(){
            if($('#cash_on_delivery').is(":checked")) {
                 $("#submit-order-btn").show();
                $("#pay-online-btn").hide();
            } 
        });

  
    function calculateCartTotal() {
        let address = $('.address:checked').val();
        let shipping_type = $('.shipping_type:checked').val();
        var way_of_billing = $('.address:checked').attr("data-id");

        let formData = new FormData();
        formData.append('address', (typeof address == 'undefined') ? '' : address);
        formData.append('shipping_type', (typeof shipping_type == 'undefined') ? '' : shipping_type);
         formData.append('way_of_billing', (typeof way_of_billing == 'undefined') ? '' : way_of_billing);
        $.ajax({
            url: "{{ URL::to('calculate-cart-total') }}",
            type: 'POST',
            processData: false,
            contentType: false,
            dataType: 'json',
            data: formData,
            context: this,
            success: function(result) {
                if (result.success) {
                    $('#gst_type').html(result.gst_type);
                    $('#total_gst_amount').html(`<i class="rupees-icon mb-0">₹</i> ${result.total_gst_amount}`);
                    $('#cart_total').html(`<i class="rupees-icon mb-0">₹</i> ${result.cart_total_with_shipping}`);
                     $('#total_shipping_cost').html(`<i class="rupees-icon mb-0">₹</i> ${result.TotalShipCost}`);
                      $('#online_pay_amount').html(`<i class="rupees-icon mb-0">₹</i> ${result.cart_total_with_shipping}`);
                } else {
                    console.log(result);
                }
            }
        });
    }

    function deleteConfirmation(id) {
        swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: `{{ URL::to('customer-address/${id}') }}`,
                        type: "DELETE",
                        dataType: "json",
                        success: function(result) {
                            if (result.success) {
                                swal("Address has been deleted!", {
                                    icon: "success",
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 400);
                            } else {
                                swal.fire(result.msgText);
                            }
                        }
                    });
                }
            });
    };

    function deletebillingConfirmation(id) {
        swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: `{{ URL::to('customer-billing-address/${id}') }}`,
                        type: "DELETE",
                        dataType: "json",
                        success: function(result) {
                            if (result.success) {
                                swal("Address has been deleted!", {
                                    icon: "success",
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 400);
                            } else {
                                swal.fire(result.msgText);
                            }
                        }
                    });
                }
            });
    };

    $(document).ready(function() {
        setTimeout(function() {
            calculateCartTotal();
        }, 400);

        $(document).on('click', '.address,.shipping_type', function(event) {
            calculateCartTotal();
        });


        $(document).on('click', '#add-address-btn', function(event) {
            $(this).attr('disabled', true);
            $('.validation-err').html('');
            let name = $('#address-form #name').val();
            let email = $('#address-form #email').val();
            let mobile_number = $('#address-form #mobile_number').val();
            let country = $('#address-form #country').val();
            let state = $('#address-form #state').val();
            let city = $('#address-form #city').val();
            let addressFor = $('#address-form #addressFor').val();
            let sameBillShip = $('input[name=sameBillShip]:checked').val(); 
            
            
            let pincode = $('#address-form #pincode').val();
            let address = $('#address-form #address').val();
            let address_type = $('input[name=address_type]:checked').val();
            let formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('mobile_number', mobile_number);
            formData.append('country', country);
            formData.append('state', state);
            formData.append('city', city);
            formData.append('addressFor', addressFor);
          
            formData.append('pincode', pincode);
              formData.append('sameBillShip', sameBillShip);
            formData.append('address', address);
            formData.append('address_type', address_type);
            $.ajax({
                url: "{{ URL::to('customer-address') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        swal("Success!", "Added", "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#address-form #${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });

    // add billing address 
    $(document).on('click', '#add-billing-btn', function(event) {
            $(this).attr('disabled', true);
            $('.validation-err').html('');
            let name = $('#billing-form #name').val();
            let email = $('#billing-form #email').val();
            let mobile_number = $('#billing-form #mobile_number').val();
            let country = $('#billing-form #country').val();
            let state = $('#billing-form #state').val();
            let city = $('#billing-form #city').val();
            let pincode = $('#billing-form #pincode').val();
          
            let address = $('#billing-form #address').val();
            let address_type = $('input[name=address_type]:checked').val();
            let formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('mobile_number', mobile_number);
            formData.append('country', country);
            formData.append('state', state);
            formData.append('city', city);
            
            formData.append('pincode', pincode);
            formData.append('address', address);
            formData.append('address_type', address_type);
            $.ajax({
                url: "{{ URL::to('customer-billing-address') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        swal("Success!", "Added", "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#address-form #${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });


// for cash on delivery 
        $(document).on('click', '#submit-order-btn', function(event) {
            $(this).attr('disabled', true);
            $('.validation-err').html('');
            let address = $('.address:checked').val();
            let shipping_type = $('.shipping_type:checked').val();
              var way_of_billing = $('.address:checked').attr("data-id");
            var payment_mode = $("input:radio[name=payment_method]:checked").val()     
           console.log(payment_mode);
           
              if( address == "0" ){
                 $('#enter_delivery-pincode').text('Please add or select shipping address').show().delay(1000).fadeOut(3000);
            }
             if( payment_mode === undefined ){
               $('#choose-payment-option').text('Please select payment  method').show().delay(1000).fadeOut(5000);
                 $(this).attr('disabled', false);
                 return false;
            }


            let formData = new FormData();
            formData.append('address', (typeof address == 'undefined') ? '' : address);
            formData.append('shipping_type', (typeof shipping_type == 'undefined') ? '' : shipping_type);
              formData.append('way_of_billing', (typeof way_of_billing == 'undefined') ? '' : way_of_billing);
               formData.append('payment_mode', (typeof payment_mode == 'undefined') ? '' : payment_mode);
            $.ajax({
                url: "{{ URL::to('submit-order') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                swal("Order has been placed!", {
                        icon: "success",
                                });
                        setTimeout(function() {

                            window.location = `{{ URL::to('thank-you') }}`;
                        }, 1000);
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {

                            for (const key in result.errors) {
                                $(`#order-${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });

        // end cash on delivery 


    });


 $(document).ready(function() {

        $(document).on("change", "#state", function(event) {

            let state_id = $(this).val();

            $.ajax({

                url: `{{ URL::to('cities-by-state/${state_id}') }}`,

                type: "get",

                dataType: "json",

                success: function(result) {

                    if (result.success) {

                        $("#city").html(result.html);

                    }

                }

            });

        });

    });
</script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.getElementById('pay-online-btn').onclick = function(e){
        // new code
           let address = $('.address:checked').val();
            let shipping_type = $('.shipping_type:checked').val();
              var way_of_billing = $('.address:checked').attr("data-id");
            var payment_mode = $("input:radio[name=payment_method]:checked").val()     
       //  console.log(payment_mode);
           
              if( address == "0" ){
                 $('#enter_delivery-pincode').text('Please add or select shipping address').show().delay(1000).fadeOut(3000);
                   $(this).attr('disabled',false);
            return false;
            }
             if( payment_mode === undefined ){
               $('#choose-payment-option').text('Please select payment  method').show().delay(1000).fadeOut(5000);
                 $(this).attr('disabled', false);
                 return false;
            }

        // 
        
        if(payment_mode=='pay_online'){
            let formData=new FormData();
            formData.append('address',address);
            formData.append('shipping_type',shipping_type);
            formData.append('payment_mode',payment_mode);
            formData.append('way_of_billing',way_of_billing);
            $.ajax({
                url:"{{ URL::to('/proceed-to-pay') }}",
                type:'POST',
                processData: false,
                contentType: false,
                dataType:'json',
                data:formData,
                context:this,
                success:function(result) {
                    if(result.success) {
                        var options = {
                            "key": result.apiKey,
                            "amount": result.totalAmount * 100,
                            "currency": "INR",
                            "name": result.customer,
                            "description": "Thank You for choosing us.",
                            "image": "{{ asset('frontend/images/logo/logo.png') }}",
                           
                            "prefill": {
                                "name":"{{ Auth::guard('customer')->user()->name }}",
                                "email": "{{ Auth::guard('customer')->user()->email }}",
                                "contact": "{{ Auth::guard('customer')->user()->mobile_number }}"
                            },
                         
                            "theme": {
                                "color": "#528FF0"
                            },
                            "handler": function (response){
                                let newformData=new FormData();
                                newformData.append('address',$('.address:checked').val());
                                newformData.append('shipping_type', $('.shipping_type:checked').val());
                                newformData.append('payment_mode', $("input:radio[name=payment_method]:checked").val() );
                                newformData.append('way_of_billing', $('.address:checked').attr("data-id") );
                                newformData.append('razorpay_payment_id',response.razorpay_payment_id);
                                newformData.append('razorpay_order_id',response.razorpay_order_id);
                                newformData.append('razorpay_signature',response.razorpay_signature);
                                $.ajax({
                                    url:"{{ URL::to('/place-order') }}",
                                    type:'POST',
                                    processData: false,
                                    contentType: false,
                                    dataType:'json',
                                    data:newformData,
                                    context:this,
                                    success:function(resultpass) {
                                        if(resultpass.success) {
                                              swal("Order has been placed!", {
                                                icon: "success",
                                                        });
                                                                 
                                           window.location = "{{URL::to('/thank-you')}}";
                                        } else {
                                            $(this).attr('disabled',false);
                                        }
                                    }
                                });
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                        e.preventDefault();
                        // rzp1.on('payment.failed', function (response){
                        //     let newformData=new FormData();
                            
                           
                        //        newformData.append('address',$('.address:checked').val());
                        //         newformData.append('shipping_type', $('.shipping_type:checked').val());
                        //         newformData.append('payment_mode', $("input:radio[name=payment_method]:checked").val() );
                        //         newformData.append('way_of_billing', $('.address:checked').attr("data-id") );

                        //     newformData.append('razorpay_order_id',response.error.metadata.order_id);
                        //     $.ajax({
                        //         url:"{{ URL::to('submit-order-failed') }}",
                        //         type:'POST',
                        //         processData: false,
                        //         contentType: false,
                        //         dataType:'json',
                        //         data:newformData,
                        //         context:this,
                        //         success:function(result) {
                        //             if(result.success) {
                        //                 toastr.error(result.msgText);
                        //             } else {
                        //                 $(this).attr('disabled',false);
                        //                 if(result.code==422) {
                        //                     if(result.errors.address) {
                        //                         $('#address-err').html(result.errors.address[0]);
                        //                     }
                        //                     if(result.errors.shippingmethod) {
                        //                         $('#shippingmethod-err').html(result.errors.shippingmethod[0]);
                        //                     }
                        //                     if(result.errors.general) {
                        //                         $('#general-err').html(result.errors.general[0]);
                        //                     }
                        //                 } else {
                        //                     toastr.error(result.msgText);
                        //                     console.log(result);
                        //                 }
                        //             }
                        //         }
                        //     });
                        // });
                    } else {
                        if(result.code==422) {
                            if(result.errors.address) {
                                $('#no-payment-message').html('Something went wrong please try later.');
                            }
                          
                        
                        } 
                    }
                }
            });
        }
    }
</script>
    @endsection