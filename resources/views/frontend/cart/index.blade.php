@extends('frontend.includes.main')
@section('title','Cart Details')
@section('content')


 <section class="py-3 bg-light">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb custom-breadcumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/')}}">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cart Details </li>
          </ol>
        </nav>
      </div>
    </section>
    <section class="cart-section">
      <div class="container">
        <div class="add-to-cart-flex">
          <div class="add-to-cart-left">
           
          <table class="table add-to-cart-table">
  <thead>
    <th>Product</th>
    <th>Price</th>
    <th class="quantity-th">Quantity</th>
    <th>Total</th>
    <th>Action</th>
    
  </thead>
  <tbody>
      @if (isset($cart_datas) && count($cart_datas) > 0)
          @foreach ($cart_datas as $cart_data)

    <tr>

      <td>
         @if (Storage::exists($cart_data['image']))
          <a href="{{url('/product-details/'.productSlug($cart_data['product_id']))}}">
             <img src="{{ URL::asset('storage/' . $cart_data['image']) }}" class="add-to-cart-img">
         </a>
          @endif
        
       <a href="{{url('/product-details/'.productSlug($cart_data['product_id']))}}">
            <p class="add-to-cart-heading">{{ $cart_data['name'] }}
          Color - {{ $cart_data['color_name'] }}
         /{{ $cart_data['parent_attribute_1_name'] }} - {{ $cart_data['attribute_1_name'] }}
           @if ($cart_data['parent_attribute_2_name'])
        /{{ $cart_data['parent_attribute_2_name'] }} - {{ $cart_data['attribute_2_name'] }}
          @endif                                 
        </p>
       </a>
      </td>

      <td data-label="Price:" class="align-items-center"> <i class="rupees-icon mb-0">₹</i> {{$cart_data['price']}}</td>

      <td class="align-items-center">
          <div class="add-to-cart-select-quantity">
                <div class="qty-container d-flex">
            <button class="qty-btn-minus border-0 btn-light btn bg-dark" type="button" cart_id="{{ $cart_data['id'] }}" ><i class="fa fa-minus"></i></button>
                <input type="text" class="input-qty form-control text-center quantity" name="quantity" value="{{ $cart_data['quantity'] }}" max="{{ $cart_data['available_quantity'] }}" readonly>
            <button class="qty-btn-plus border-0 btn-light btn bg-dark" type="button" cart_id="{{ $cart_data['id'] }}"><i class="fa fa-plus"></i></button>
          </div>
              </div>
      </td>

     

    <td data-label="Total:" class="align-items-center"> <i class="rupees-icon mb-0">₹</i> {{ $cart_data['total_price'] }}</td>

      <td class="align-items-center">  
        <button class="btn remove-from-cart-btn" title="Remove Product" cart_id="{{ $cart_data['id'] }}">
          <i class="fa fa-trash text-danger trashicon"></i>
        </button>
      </td>
      
  
    </tr>
    @endforeach
    @endif 
 

    
  </tbody>
</table>
          </div>
          <div class="add-to-cart-right p-2">
            <h3 class="border-bottom h5 pb-2">Cart Summary</h3>
          

               <div class="coupon-apply my-3 border-bottom pb-3">
                <label><h5 class="font-weight-medium h6 mr-auto">
                    Check Deliverability </h5></label>

                      <div class="wdinput position-relative">
                       <input type="text" name="check_delivery" class="form-control"  id="check_delivery" placeholder="Enter Pincode">
                        <button class="btn coupon-apply-btn" id="check_delivery-btn"><i class="fa fa-angle">Check</i></button>
                        <input type="hidden" name="cartQuantity" id="cartQuantity" value="{{$cart_quantity}}">
                        <input type="hidden" name="cartAmount" id="cartAmount" value="{{ $cart_total }}">
                       
                    </div>
                
                    <div class="alert-msg-pincode mt-2">
                    <small class="text-danger" id="enter_delivery-pincode"></small>
                        <small class="text-success" id="check_delivery-message"></small>
                        <small class="text-danger" id="no-check_delivery-message"></small>
                    </div>
                </div>


            <div class="sub-total d-flex border-bottom">
              <h5 class="font-weight-medium h6 mr-auto">Subtotal </h5>
              <h5 class="font-weight-medium h6"><i class="rupees-icon mb-0">₹</i> {{ $cart_total }}</h5>
           
            </div>
        
                 <div class="sub-total d-flex border-bottom">
                    <h5 class="font-weight-medium h6 mr-auto">Pre Discount </h5>
                    <h5 class="font-weight-medium h6"><i class="rupees-icon mb-0">₹</i> {{ $preDiscountAmount }}</h5>
                </div>

                      
          <div class="coupon-apply my-3 border-bottom pb-3">
            <label><h5 class="font-weight-medium h6 mr-auto">Apply Coupon </h5>  </label>
                 <div class="wdinput position-relative">
                        <input type="text" class="form-control" placeholder="Coupon Code" name="coupon_code" id="coupon_code" value="">
                        <button class="btn coupon-apply-btn" id="apply-coupon-btn"><i class="fa fa-angle">Apply</i></button>
                    </div>
          
                    <div class="text-danger validation-err" id="coupon_code-err"></div>
                </div>

                 <div class="sub-total d-flex border-bottom">
                    <h5 class="font-weight-medium h6 mr-auto"> Discount </h5>
                    <h5 class="font-weight-medium h6"><i class="rupees-icon mb-0">₹</i> {{ $discount_amount }}</h5>
                </div>

                 <div class="sub-total d-flex border-bottom">
                    <h5 class="font-weight-medium h6 mr-auto">Taxes <small> (CGST@ {{$GstCharges->cgst_percent}}% , SGST@ {{$GstCharges->sgst_percent}}%)</small> </h5>
                    <div id="gstCharges"></div> 
                </div>


                 <div class="sub-total d-flex border-bottom">
                    <h5 class="font-weight-medium h6 mr-auto">Shipping Charges </h5>
                   
                    <div id="shippingCost"></div>
                </div>


          <div class="sub-total d-flex border-bottom mt-2">
              <h5 class="font-weight-medium h6 mr-auto">Total </h5>
             <div id="totalCartAmount"><h5 class="font-weight-medium h6" id="previousCartValue"><i class="rupees-icon mb-0">₹</i>{{ $cart_final }}</h5></div> 
            </div>


            <div class="sub-total d-flex border-bottom mt-2">
              <strong>Note: <small>Final amount can be differ from the shown value at checkout after tax calculations.</small></strong> 
             
            </div> 

   @if (Auth::guard('customer')->check())
   <a href="#" class="btn proceed-to-checkout my-3 bg-dark text-white w-100"  >Proceed To Checkout</a>
   <input type="hidden" name="loggedIn" value="1" id="loggedIn">
   @else
   <a href="#" class="btn proceed-to-checkout my-3 bg-dark text-white w-100" >Proceed To Checkout</a>
   <input type="hidden" name="loggedIn" value="0" id="loggedIn">
   @endif


            
          </div>
        </div>
      </div>
    </section>



<script>
    $(document).ready(function(event) {
        $(document).on('click', '.qty-btn-minus', function(event) {
            let cart_id = $(this).attr('cart_id');
            let quantity = $(this).parent().find('.quantity').val();
            $.ajax({
                url: `{{ URL::to('decrease-cart-item-quantity/${cart_id}/${quantity}') }}`,
                type: 'POST',
                dataType: 'json',
                context: this,
                success: function(result) {
                    if (result.success) {
                        swal("Success!", "Cart Updated", "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        console.log(result);
                    }
                }
            });
        });

        $(document).on('click', '.qty-btn-plus', function(event) {
            let cart_id = $(this).attr('cart_id');
            let quantity = $(this).parent().find('.quantity').val();
            $.ajax({
                url: `{{ URL::to('increase-cart-item-quantity/${cart_id}/${quantity}') }}`,
                type: 'POST',
                dataType: 'json',
                context: this,
                success: function(result) {
                    if (result.success) {
                        swal("Success!", "Cart Updated", "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        console.log(result);
                    }
                }
            });
        });


        $(document).on('click', '.remove-from-cart-btn', function(event) {
            let cart_id = $(this).attr('cart_id');
            $.ajax({
                url: `{{ URL::to('remove-from-cart/${cart_id}') }}`,
                type: 'DELETE',
                dataType: 'json',
                context: this,
                success: function(result) {
                    if (result.success) {
                        swal("Success!", "Deleted from cart", "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        console.log(result);
                    }
                }
            });
        });

        $(document).on('click', '#apply-coupon-btn', function(event) {
            // $(this).attr('disabled', true);
            $('.validation-err').html('');
            let coupon_code = $('#coupon_code').val();
            let formData = new FormData();
            formData.append('coupon_code', coupon_code);
            $.ajax({
                url: "{{ URL::to('apply-coupon') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        swal("Success!", "Coupon Applied", "success");
                        setTimeout(function() {
                            window.location = `{{ URL::to('/cart-details') }}`;
                        }, 1000);
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

// check delevery 

        $(document).on('click', '#check_delivery-btn', function(event) {
            $('.validation-err').html('');

            $('#check_delivery-message').html('');
               $('#shippingCost').html('');
            $(this).attr('disabled', true);
            let pincode = $('#check_delivery').val();
              let cartQuantity = $('#cartQuantity').val();
               let cartAmount = $('#cartAmount').val();
            let userOnline = $('#loggedIn').val();
         

            if( pincode == ""){
                 $('#enter_delivery-pincode').text('Please enter delivery pincode').show().delay(1000).fadeOut(3000);
            }
               if( userOnline == 0){
                var href = "{{URL::to('/sign-in')}}";

            }else{
                 var href = "{{URL::to('checkout')}}";

            }

            let formData = new FormData();
            formData.append('pincode', pincode);
            formData.append('cartQuantity', cartQuantity);
            formData.append('cartAmount', cartAmount);
            $.ajax({
                url: "{{ URL::to('check-pincode-delivery') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    $(this).attr('disabled', false);
                    if (result.success) {
                        console.log(result.TotalShipCost);
                        $('#check_delivery-message').html(result.message).show().delay(1000).fadeOut(3000);
                      
                        
                        $('#shippingCost').append('<h5 class="font-weight-medium h6"><i class="rupees-icon mb-0">₹</i>' + result.TotalShipCost +'</h5>');
                       
                          $('#gstCharges').append('<h5 class="font-weight-medium h6"><i class="rupees-icon mb-0">₹</i>' + result.total_gst_amount +'</h5>');
                         $('#totalCartAmount').append('<h5 class="font-weight-medium h6"><i class="rupees-icon mb-0">₹</i>' + result.totalCartAmount +'</h5>');
                         $("#previousCartValue").hide();
                           $(".proceed-to-checkout").html("Proceed To Checkout");
                         $(".proceed-to-checkout").attr("href", href);
                       
                    }else if(result.notFound){
                         $('#no-check_delivery-message').html(result.message).show().delay(1000).fadeOut(3000);
                           $(".proceed-to-checkout").html("Not Available For Delivery");
                            $(".proceed-to-checkout").attr("disabled", true);
                              $(".proceed-to-checkout").removeAttr("href");
                         
                    }else if(result.NoShippingCost){
                         $('#no-check_delivery-message').html(result.message).show().delay(1000).fadeOut(3000);
                           $(".proceed-to-checkout").html("Not Available For Delivery");
                            $(".proceed-to-checkout").attr("disabled", true);
                              $(".proceed-to-checkout").removeAttr("href");
                         
                    } else {
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

        $(document).on('click', '.proceed-to-checkout', function(event) {
            let pincode = $('#check_delivery').val();
            let userOnline = $('#loggedIn').val();
            let cartQuantity = $('#cartQuantity').val();
            let cartAmount = $('#cartAmount').val();

            if( userOnline == 0){
                var href = "{{URL::to('/sign-in')}}";
            } else {
                var href = "{{URL::to('checkout')}}";
            }
            console.log(userOnline);
            if(pincode == ""){
                $('#enter_delivery-pincode').text('Please check delivery pincode first').show().delay(1000).fadeOut(8000);
                return false;
            } else {
                let formData = new FormData();
                formData.append('pincode', pincode);
                formData.append('cartQuantity', cartQuantity);
                formData.append('cartAmount', cartAmount);
                $.ajax({
                    url: "{{ URL::to('check-pincode-delivery') }}",
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: formData,
                    context: this,
                    success: function(result) {
                        // console.log(result);return false;
                        $(this).attr('disabled', false);
                        if (result.success == true) {
                            $('#check_delivery-message').html(result.message).show().delay(1000).fadeOut(8000);
                             $(".proceed-to-checkout").html("Proceed To Checkout");
                             $(".proceed-to-checkout").attr("href", href);
                           
                        // }else if(result.notFound){
                        }else if(result.success == false){
                             $('#no-check_delivery-message').html(result.message).show().delay(1000).fadeOut(8000);
                               $(".proceed-to-checkout").html("Not Available For Delivery");
                                $(".proceed-to-checkout").attr("disabled", true);
                                  $(".proceed-to-checkout").removeAttr("href");
                             
                        } else {
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
            }
        });
    });
</script>

@endsection