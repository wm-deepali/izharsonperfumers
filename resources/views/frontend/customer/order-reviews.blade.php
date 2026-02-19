
 @extends('frontend.includes.main')
@section('title','Review Products')
@section('content')
 <section class="py-3 bg-light">
         <div class="container">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb custom-breadcumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('listing')}}">Shop</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Order Reviews</li>
               </ol>
            </nav>
         </div>
      </section>
      <section>
         <div class="container">
            <div class="dashboard-flex-section d-flex my-3">
               @include('frontend.customer.dashboard_side_bar')
               <div class="dashboard-right-section border">
                  <h1 class="h5 font-weight-medium border-bottom pb-2">Order Reviews</h1>
                  <div class="dasboard-box">
                     <div class="accordion_container">


                           @if (isset($orders) && count($orders) > 0)
                            @foreach ($orders as $order)
                                <div class="border mb-3">
                                    <div class="accordion_head">
                                        <h5>
                                            Order Id :
                                            <strgon>{{ $order->order_number }} </strgon>

                                        </h5>
                                        <h6 class="orderdate">{{ $order->created_at }} <span class="orderstatus">

                                              @php
                                             $rating_point = $order->average_rating
                                             @endphp

                                        @for($i=1; $i<=5; $i++)
                                             @if($rating_point >= $i)
                                              <i class="fa fa-star" style="color:#ff6600;" ></i>
                                              @else
                                               <i class="fa fa-star" style="color:#ccc;" ></i>
                                               @endif
                                               @endfor

                                               
                                            </span>
                                        </h6>
                                        <span class="plusminus">+</span>
                                    </div>


                                    @if (isset($order->order_details) && count($order->order_details) > 0)
                                        @foreach ($order->order_details as $order_detail)
                                        
                                            @if ($order_detail->order_product_review)
                                                <div class="accordion_body" style="display: none;">
                                                    <div class="orderreivdw-sec d-flex">
                                                        <div class="order-reviews-img mr-auto">
                                                            @if (isset($order_detail->product) && Storage::exists($order_detail->product->image))
                                                                <img src="{{ URL::asset('storage/' . $order_detail->product->image) }}">
                                                            @endif
                                                            <h6>{{ $order_detail->product_name }}</h6>
                                                        </div>
                                                        <div class="order-price">
                                                            <h5>Quantity : <span>{{ $order_detail->quantity }}</span></h5>
                                                            <h4>Price : <i class="rupees-icon">₹ </i>{{ $order_detail->total_price }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="order-reviews-comment py-2">
                                                        <p>{{ $order_detail->order_product_review->review }}</p>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="accordion_body" style="display: none;">
                                                    <div class="orderreivdw-sec d-flex">
                                                        <div class="order-reviews-img mr-auto">
                                                            @if (isset($order_detail->product) && Storage::exists($order_detail->product->image))
                                                                <img src="{{ URL::asset('storage/' . $order_detail->product->image) }}">
                                                            @endif
                                                            <h6>{{ $order_detail->product_name }}</h6>
                                                        </div>
                                                        <div class="order-price">
                                                            <h5>Quantity : <span>{{ $order_detail->quantity }}</span></h5>
                                                            <h4>Price : <i class="rupees-icon">₹ </i>{{ $order_detail->total_price }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="order-reviews-comment py-2">
                                                        <form id="review-form-{{ $order_detail->id }}">
                                                            <div class="wdinput">
                                                                <fieldset class="rating">
                                                                    <input type="radio" class="rating-{{ $order_detail->id }}" id="star5" name="rating" value="5" /><label class="full" for="star5" title="Awesome - 5 stars"></label>
                                                                    <input type="radio" class="rating-{{ $order_detail->id }}" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                                    <input type="radio" class="rating-{{ $order_detail->id }}" id="star4" name="rating" value="4" checked /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                                                    <input type="radio" class="rating-{{ $order_detail->id }}" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                                    <input type="radio" class="rating-{{ $order_detail->id }}" id="star3" name="rating" value="3" /><label class="full" for="star3" title="Meh - 3 stars"></label>
                                                                    <input type="radio" class="rating-{{ $order_detail->id }}" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                                    <input type="radio" class="rating-{{ $order_detail->id }}" id="star2" name="rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                                                    <input type="radio" class="rating-{{ $order_detail->id }}" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                                    <input type="radio" class="rating-{{ $order_detail->id }}" id="star1" name="rating" value="1" /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                                                    <input type="radio" class="rating-{{ $order_detail->id }}" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                </fieldset>
                                                            </div>
                                                            <div class="wdinput">
                                                                <textarea class="form-control review" placeholder="Enter Reviews" rows="4" name="review" id="review-{{ $order_detail->id }}"></textarea>
                                                                <div class="text-danger validation-err" id="review-err"></div>
                                                            </div>
                                                            <div class="wdinput mt-3">
                                                                <button type="button" class="btn bg-dark text-white submit-order-review-btn" order_id="{{ $order->id }}" order_detail_id="{{ $order_detail->id }}">Submit </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                        @endif

                     </div>
                  </div>
               </div>
               <button class="filter-btn btn" id="filterbtn"><i class="fa fa-bars"></i> </button>
            </div>
         </div>
      </section>
<script type="text/javascript">
         $(document).ready(function() {
         //toggle the component with class accordion_body
         $(".accordion_head").click(function() {
         if ($('.accordion_body').is(':visible')) {
         $(".accordion_body").slideUp(300);
         $(".plusminus").text('+');
         }
         if ($(this).next(".accordion_body").is(':visible')) {
         $(this).next(".accordion_body").slideUp(300);
         $(this).children(".plusminus").text('+');
         } else {
         $(this).next(".accordion_body").slideDown(300);
         $(this).children(".plusminus").text('-');
         }
         });

         // submit order review 
         $(document).on('click', '.submit-order-review-btn', function(event) {
            $(this).attr('disabled', true);
            $('.validation-err').html('');
            let order_id = $(this).attr('order_id');
            let order_detail_id = $(this).attr('order_detail_id');
            let rating = $(`.rating-${order_detail_id}:checked`).val();
            let review = $(`#review-${order_detail_id}`).val();
            let formData = new FormData();
            formData.append('rating', rating);
            formData.append('review', review);
            $.ajax({
                url: `{{ URL::to('order-review/${order_id}/${order_detail_id}') }}`,
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
                                $(`#review-form-${order_detail_id} #${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });
         });
         
      </script>

      @endsection

