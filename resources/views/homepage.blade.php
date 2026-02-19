@extends('frontend.includes.main')

@section('title','Home')

@section('content')

    <!-- ========================= BANNER SECTION ========================= -->

    <section class="top-banner">

      <div class="home_slider owl-carousel owl-theme">                                        

        @if(!empty($banner))

        @foreach($banner as $banners)

        <div class="item">

           @if (isset($banners->image) && Storage::exists($banners->image))

           <img src="{{ URL::asset('storage/' . $banners->image) }}">

           @endif

       

          <div class="container">

            <div class="bgHeading">

              <h4>{{$banners->title}}</h4>

              <h5>{{$banners->sub_title}}</h5>

              <a href="{{ route('listing', 'page=1&category=&fabric_type='. $banners->title) }}" class="shop-btn">Shop Now </a>

            </div>

          </div>

        </div>

        @endforeach

        @endif

     

      </div>

      <!-- ============ COMPONENT SLIDER BOOTSTRAP end.// ===========  .// -->

      <!-- container end.// -->

    </section>



    <!-- ========================= SHIPPIN SECTION ========================= -->

    <section class="shipping-col">

      <div class="container">

        <div class="row">

          <div class="col-md-4">

            <div class="shipping-box mrgn-btm ">

              <div class="shipping-content">

                <h3>FREE SHIPPING</h3>

                <p>Hendrerit vulputate velit esse molestie</p>

              </div>

              <div class="shipping-icon">

                <span class="iconify" data-icon="fa:paper-plane-o"></span>

              </div>

            </div>

          </div>

          <div class="col-md-4">

            <div class="shipping-box mrgn-btm ">

              <div class="shipping-content">

                <h3>MANY BACK GUARANTEE</h3>

                <p>Hendrerit vulputate velit esse molestie</p>

              </div>

              <div class="shipping-icon">

                <span class="iconify" data-icon="teenyicons:refresh-alt-solid"></span>

              </div>

            </div>

          </div>

          <div class="col-md-4">

            <div class="shipping-box">

              <div class="shipping-content">

                <h3>SUPPORT 24/7</h3>

                <p>Hendrerit vulputate velit esse molestie</p>

              </div>

              <div class="shipping-icon">

                <span class="iconify" data-icon="ant-design:clock-circle-outlined"></span>

              </div>

            </div>

          </div>

        </div>

      </div>

    </section>

  

<!-- start premium est -->

     <!-- ========================= PREMIUM CATEGORIES SECTION ========================= -->



    <section class="pd-bottom-slide">



      <div class="container">



        <div class="col-head">



          <h2>PREMIUM CATEGORIES</h2>



          <p>Browse the collection of our products and top interresting products. definitely find what you are looking for.</p>



          <div class="clearfix"></div>



        </div>


@php
$i = 1;
@endphp
        <div id="primium-category" class="owl-carousel owl-theme">

           @if(!empty($premiumProducts) && (count($premiumProducts)) > 0)

            @foreach($premiumProducts as $product)

          <div class="item">

            <div class="primium-box">

             <div class="prim-image bgc-{{$i}}">

                <!-- for wishlist -->

                 <div class="wishlist-icon">

                <button class="btn  update-wishlist-btn" product_id="{{$product->id}}">

                    @if (wishlist_status($product->id))

                      <i class="fa fa-heart"  id="wishlisticon"></i>

                    @else

                    <i class="fa fa-heart-o"  id="wishlisticon"></i>

                    @endif

                

               </button>

               </div>

               <!-- end wishlist -->

          

                @if (isset($product->image) && Storage::exists($product->image)) 

                <a href="{{url('/product-details/'.$product->slug)}}">

                   <img src="{{ URL::asset('storage/' . $product->image) }}" class="rounded-circle"  style="width:154px;height: 180px;" />

                   <h3>{{$product->name}} </h3>

                </a>                               

                   

                     

                      @endif


              </div>

            </div>

          </div>
 @php
          $i++;
          @endphp

          @endforeach

          @else

          <div class="align-center">No data found!</div>

          @endif





          </div>

        </div>

    



    </section>

    <!-- end premium ext -->

    <!-- ========================= SALE SECTION ========================= -->

    <section>

      <div class="container">

        <div class="row">

          <div class="col-md-6">

            <div class="card cdr card-banner-lg bg-dark mrgn-btm ">
             <a href="{{route('listing')}}">
              <img src="{{asset('frontend/images/b.jpg')}}" class="card-img ">

              <div class="card-img-overlay text-white text-center">

                <h2 class="card-title">SHIPS IN 3 WEEKS</h2>

                <p class="card-text">SHOP NOW</p>

              </div>
              </a>

            </div>

            <!-- col.// -->

          </div>

          <aside class="col-md-6">

            <div class="card cdr card-banner-lg bg-dark">
<a href="{{route('getBestSales')}}">
              <img src="{{asset('frontend/images/a.jpg')}}" class="card-img ">

              <div class="card-img-overlay text-white">

                <h2 class="card-title">Special Sale</h2>

                <p class="card-text">Sale up to <span>30% Off</span>

                </p>

                <p class="card-text">SHOP NOW </span>

                </p>

              </div>
              </a>

            </div>

          </aside>

          <!-- row.// -->

        </div>

      </div>

    </section>

    <!-- ========================= HOT DEALS SECTION ========================= -->

    <section class="pd-top pd-bottom-slide">

      <div class="container">

        <div class="row">

          <div class="col-lg-12">

            <div class="col-head">

              <h2>HOT DEALS</h2>

              <p>Browse the collection of our products and top interresting products. definitely find what you are looking for.</p>

              <div class="clearfix"></div>

            </div>

            <div id="hot-deal" class="owl-carousel owl-theme">

            

              @if(!empty($hotdeals) && (count($hotdeals)) > 0 )

              @foreach($hotdeals as $deals)

              <div class="item">

                <div class="product-col">

                  <div class="pro-img">

                        <!-- for wishlist -->

                 <div class="wishlist-icon">

                <button class="btn  update-wishlist-btn" product_id="{{$deals->id}}">

                    @if (wishlist_status($deals->id))

                      <i class="fa fa-heart"  id="wishlisticon"></i>

                    @else

                    <i class="fa fa-heart-o"  id="wishlisticon"></i>

                    @endif

                

               </button>

               </div>

               <!-- end wishlist -->

                     @if (isset($deals->image) && Storage::exists($deals->image)) 
                       <a href="{{url('/product-details/'.$deals->slug)}}">


                    <img src="{{ URL::asset('storage/' . $deals->image) }}" style="width:154px;height: 180px;" />

                     

                      @endif

               

                  </div>

                  <div class="pro-tex">

                    <h3>{{$deals->name}}</h3>
                    </a>

                   

                  @php

                  $rating_point = $deals->rating;

                  @endphp



               <ul class="rating-stars">  

                  @for($i=1; $i<=5; $i++)

                  @if($rating_point >= $i)

                   <i class="fa fa-star" style="color:#ff6600;" ></i>

                   @else

                    <i class="fa fa-star" style="color:#ccc;" ></i>

                    @endif

                    @endfor

                 

                </ul>

                    <a href="{{url('/product-details/'.$deals->slug)}}" class="cart-btn">SHOP NOW</a>

                  </div>

                </div>

              </div>

              @endforeach

              @else 



            <div class="align-center">  No data found!</div>

              @endif



             

            

            </div>

          </div>

        </div>

      </div>

    </section>

    <!-- ========================= TRENDING SECTION ========================= -->

    <section class="trending-col pd-bottom pd-top">

      <div class="m-auto">

        <h6>TRENDING</h6>

        <h4>NEW LEAGUE</h4>

        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. </p>

        <a href="{{route('getBestSales')}}">SHOP NOW</a>

      </div>

    </section>



    <!-- ========================= TOP SELLING PRODUCTS SECTION ========================= -->

    <section class="pd-bottom pd-top">

      <div class="container">

        <h2 class="main-heading">TOP SELLING PRODUCTS</h2>

        <div id="top-selling" class="owl-carousel owl-theme">

          @if(!empty($topSoldproduct) && (count($topSoldproduct)) > 0)

          @foreach($topSoldproduct as $soldproduct)

          <div class="item">

            <div class="product-col">

              <div class="pro-img">

                  <!-- for wishlist -->

                 <div class="wishlist-icon">

                <button class="btn  update-wishlist-btn" product_id="{{$soldproduct->id}}">

                    @if (wishlist_status($soldproduct->id))

                      <i class="fa fa-heart"  id="wishlisticon"></i>

                    @else

                    <i class="fa fa-heart-o"  id="wishlisticon"></i>

                    @endif

                

               </button>

               </div>

               <!-- end wishlist -->

                @if (isset($soldproduct->image) && Storage::exists($soldproduct->image))                                
     <a href="{{url('/product-details/'.$soldproduct->slug)}}">

                <img src="{{ URL::asset('storage/' . $soldproduct->image) }}" style="width:154px;height: 180px;" />

                     

                 @endif

              </div>

              <div class="pro-tex">

                <h3>{{$soldproduct->name}}</h3>
                </a>

                 @php

                  $rating_point = $soldproduct->rating;

                  @endphp



               <ul class="rating-stars">  

                  @for($i=1; $i<=5; $i++)

                  @if($rating_point >= $i)

                   <i class="fa fa-star" style="color:#ff6600;" ></i>

                   @else

                    <i class="fa fa-star" style="color:#ccc;" ></i>

                    @endif

                    @endfor

                 

                </ul>

                <a href="{{url('/product-details/'.$soldproduct->slug)}}" class="cart-btn">SHOP NOW</a>

              </div>

            </div>

          </div>

          @endforeach

          @else

          <div class="align-center">No data found!</div>

          @endif

 

       

        </div>

      </div>

    </section>

    <!-- ========================= SHOPPING SECTION ========================= -->

    <section class="pd-bottom">

      <div class="container">

        <div class="shopping">
<a href="{{route('listing')}}">
          <img src="{{asset('frontend/images/d.jpg')}}" />
          </a>

        </div>

      </div>

      </div>

    </section>

    <!-- ========================= CATEGORIES WISE DATA SECTION ========================= -->

    <section class="pd-bottom">

      <div class="container">

        <div class="tb-section">

          <ul class="nav nav-tabs" role="tablist">

            <li class="nav-item">

              <a class="nav-link active" data-toggle="tab" href="#new-product">New Product</a>

            </li>

            <li class="nav-item">

              <a class="nav-link" data-toggle="tab" href="#top-rating">Top Rating</a>

            </li>

            <li class="nav-item">

              <a class="nav-link" data-toggle="tab" href="#most-selling">Most Selling</a>

            </li>

          </ul>

          <h2 class="main-heading">CATEGORIES WISE DATA</h2>

          <!-- Tab panes -->

          <div class="row">

            <div class="col-md-3">

              <div class="product-permotion">

                <div class="product-permotion-over">

                  <h4>Deals And Promotions</h4>

                  <h2>TRENDING </h2>

                  <h3>House Utensil</h3>

                  <a href="{{route('getBestSales')}}" class="cart-btn">SHOP NOW</a>

                </div>

              </div>

            </div>

            <div class="col-md-9">

              <div class="tab-content">



                <!-- New product section  -->

                <div id="new-product" class="tab-pane active">

                  <div id="npro" class="owl-carousel owl-theme">

                @if(!empty($newProducts) && (count($newProducts)) > 0)

                @foreach($newProducts as $product)

                    <div class="item">

                      <div class="product-col">

                        <div class="pro-img">

                           <!-- for wishlist -->

                 <div class="wishlist-icon">

                <button class="btn  update-wishlist-btn" product_id="{{$product->id}}">

                    @if (wishlist_status($product->id))

                      <i class="fa fa-heart"  id="wishlisticon"></i>

                    @else

                    <i class="fa fa-heart-o"  id="wishlisticon"></i>

                    @endif

                

               </button>

               </div>

               <!-- end wishlist -->

                @if (isset($product->image) && Storage::exists($product->image))                                
  <a href="{{url('/product-details/'.$product->slug)}}">
              <img src="{{ URL::asset('storage/' . $product->image) }}" style="width:260px;height: 260px;" />                   

                 @endif

                          

                        </div>

                        <div class="pro-tex">

                          <h3>{{$product->name}}</h3>
                          </a>

                          @php

                  $rating_point = $product->rating;

                  @endphp



               <ul class="rating-stars">  

                  @for($i=1; $i<=5; $i++)

                  @if($rating_point >= $i)

                   <i class="fa fa-star" style="color:#ff6600;" ></i>

                   @else

                    <i class="fa fa-star" style="color:#ccc;" ></i>

                    @endif

                    @endfor

                 

                </ul>

                          <a href="{{url('/product-details/'.$product->slug)}}" class="cart-btn">SHOP NOW</a>

                        </div>

                      </div>

                    </div>

                    @endforeach

                    @else

                    <div class="align-center">No data found!</div>

                    @endif

      



                  </div>

                </div>

                <!-- end new product section  -->



<!-- top rated product section  -->

                <div id="top-rating" class="tab-pane fade">

                  <div id="tpro" class="owl-carousel owl-theme">

              @if(!empty($toprated) && (count($toprated)) > 0)

                @foreach($toprated as $toprate)



                    <div class="item">

                      <div class="product-col">

                        <div class="pro-img">

                            <!-- for wishlist -->

                 <div class="wishlist-icon">

                <button class="btn  update-wishlist-btn" product_id="{{$toprate->id}}">

                    @if (wishlist_status($toprate->id))

                      <i class="fa fa-heart"  id="wishlisticon"></i>

                    @else

                    <i class="fa fa-heart-o"  id="wishlisticon"></i>

                    @endif

                

               </button>

               </div>

               <!-- end wishlist -->

                            @if (isset($product->image) && Storage::exists($toprate->image))  
                             <a href="{{url('/product-details/'.$toprate->slug)}}">

                                <img src="{{ URL::asset('storage/' . $toprate->image) }}" style="width:260px;height: 260px;" />                   

                 @endif

                         

                        </div>

                        <div class="pro-tex">

                          <h3>{{$toprate->name}}</h3>
                          </a>

                                 @php

                  $rating_point = $toprate->rating;

                  @endphp



               <ul class="rating-stars">  

                  @for($i=1; $i<=5; $i++)

                  @if($rating_point >= $i)

                   <i class="fa fa-star" style="color:#ff6600;" ></i>

                   @else

                    <i class="fa fa-star" style="color:#ccc;" ></i>

                    @endif

                    @endfor

                 

                </ul>

                          <a href="{{url('/product-details/'.$toprate->slug)}}" class="cart-btn">SHOP NOW</a>

                        </div>

                      </div>

                    </div>

                    @endforeach

                    @else

                    <div class="align-center">no data found!</div>

                    @endif



                  </div>

                </div>



                <!-- end top rated product -->



                <!-- most selling product section  -->

                <div id="most-selling" class="tab-pane fade">

                  <div id="mpro" class="owl-carousel owl-theme">

  @if(!empty($topSoldproduct) && (count($topSoldproduct)) > 0)

                @foreach($topSoldproduct as $bestsales)



                    <div class="item">

                      <div class="product-col">

                        <div class="pro-img">



                            <!-- for wishlist -->

                 <div class="wishlist-icon">

                <button class="btn  update-wishlist-btn" product_id="{{$bestsales->id}}">

                    @if (wishlist_status($bestsales->id))

                      <i class="fa fa-heart"  id="wishlisticon"></i>

                    @else

                    <i class="fa fa-heart-o"  id="wishlisticon"></i>

                    @endif

                

               </button>

               </div>

               <!-- end wishlist -->



                         @if (isset($bestsales->image) && Storage::exists($bestsales->image))    
                              <a href="{{url('/product-details/'.$bestsales->slug)}}">


                          <img src="{{ URL::asset('storage/' . $bestsales->image) }}" style="width:260px;height: 260px;" />                   

                 @endif

                        </div>

                        <div class="pro-tex">

                          <h3>{{$bestsales->name}}</h3>
                          </a>

                                     @php

                  $rating_point = $bestsales->rating;

                  @endphp



               <ul class="rating-stars">  

                  @for($i=1; $i<=5; $i++)

                  @if($rating_point >= $i)

                   <i class="fa fa-star" style="color:#ff6600;" ></i>

                   @else

                    <i class="fa fa-star" style="color:#ccc;" ></i>

                    @endif

                    @endfor

                 

                </ul>

                          <a href="{{url('/product-details/'.$bestsales->slug)}}" class="cart-btn">SHOP NOW</a>

                        </div>

                      </div>

                    </div>

                    @endforeach

                    @else

                    <div class="align-center">no data found!!</div>

                    @endif



                  </div>

                </div>



                <!-- end most selling product section  -->



              </div>

            </div>

          </div>

        </div>

      </div>

    </section>

    <!-- ========================= MOST POPULAR SECTION ========================= -->

    <section class="pd-top pd-bottom-slide most-bg">

      <div class="container">

        <div class="row">

          <div class="col-lg-12">

            <div class="col-head">

              <h2>MOST POPULAR</h2>

              <p>Browse the collection of our products and top interresting products. definitely find what you are looking for.</p>

              <div class="clearfix"></div>

            </div>

            <div id="most-popular" class="owl-carousel owl-theme">

               @if(!empty($mostPopular) && (count($mostPopular)) > 0)

                @foreach($mostPopular as $popular)



              <div class="item">

                <div class="product-col">

                  <div class="pro-img">



                            <!-- for wishlist -->

                 <div class="wishlist-icon">

                <button class="btn  update-wishlist-btn" product_id="{{$popular->id}}">

                    @if (wishlist_status($popular->id))

                      <i class="fa fa-heart"  id="wishlisticon"></i>

                    @else

                    <i class="fa fa-heart-o"  id="wishlisticon"></i>

                    @endif

                

               </button>

               </div>

               <!-- end wishlist -->

               

               

                      @if (isset($popular->image) && Storage::exists($popular->image))      
                       <a href="{{url('/product-details/'.$popular->slug)}}">


                          <img src="{{ URL::asset('storage/' . $popular->image) }}"  style="width:267px; height: 400px;" />                   

                 @endif

              

                  </div>

                  <div class="pro-tex">

                    <h3>{{$popular->name}}</h3>
                    </a>

                                       @php

                  $rating_point = $popular->rating;

                  @endphp



               <ul class="rating-stars">  

                  @for($i=1; $i<=5; $i++)

                  @if($rating_point >= $i)

                   <i class="fa fa-star" style="color:#ff6600;" ></i>

                   @else

                    <i class="fa fa-star" style="color:#ccc;" ></i>

                    @endif

                    @endfor

                 

                </ul>

                    <a href="{{url('/product-details/'.$popular->slug)}}" class="cart-btn">SHOP NOW</a>

                  </div>

                </div>

              </div>

              @endforeach

              @else

              <div class="align-center">No data found!</div>

              @endif

            



            </div>

          </div>

        </div>

      </div>

    </section>

    <!-- ========================= SOCIAL SECTION ========================= -->

    <section class="pd-top">

      <div class="container">

        <div class="social-col">

          <div class="social-bx">

            <div class="social-box brd">

              <h3>Shop Social</h3>

              <p>Donec nec justo eget felis facilisis fermentum.</p>

              <p>Aliquam porttitor mauris sit amet orci. </p>

              <div class="social-icon">
                @php
                 $socialLinks = App\Models\SocialLinkSetting::first();     
                @endphp

                <ul>

                  <li>

                    @if(!empty($socialLinks->fb_name))
                  <a href="{{$socialLinks->fb_name}}">

                      <img src="{{asset('frontend/images/facebook.png')}}" />

                    </a>
                    @else
                      <a href="javascript::void();">

                      <img src="{{asset('frontend/images/facebook.png')}}" />

                    </a>
                    @endif

                  </li>

                  <li>

                     @if(!empty($socialLinks->linkedin_name))
                  <a href="{{$socialLinks->linkedin_name}}">

                       <img src="{{asset('frontend/images/linkedin.png')}}" />

                    </a>
                    @else
                      <a href="javascript::void();">

                       <img src="{{asset('frontend/images/linkedin.png')}}" />

                    </a>
                    @endif

                  </li>

                  <li>
                 @if(!empty($socialLinks->insta_name))
                  <a href="{{$socialLinks->insta_name}}">

                       <img src="{{asset('frontend/images/instagram.png')}}" />

                    </a>
                    @else
                      <a href="javascript::void();">

                       <img src="{{asset('frontend/images/instagram.png')}}" />


                    </a>
                    @endif

                  </li>

                  <li>

                     @if(!empty($socialLinks->twit_name))
                  <a href="{{$socialLinks->twit_name}}">

                      <img src="{{asset('frontend/images/twitter.png')}}" />

                    </a>
                    @else
                      <a href="javascript::void();">

                       <img src="{{asset('frontend/images/twitter.png')}}" />

                    </a>
                    @endif

                  </li>

                  <li>

                  @if(!empty($socialLinks->pinterest))
                  <a href="{{$socialLinks->pinterest}}">

                     <img src="{{asset('frontend/images/pinterest.png')}}" />


                    </a>
                    @else
                      <a href="javascript::void();">

                      <img src="{{asset('frontend/images/pinterest.png')}}" />
                    </a>
                    @endif


                  </li>

                </ul>

              </div>

            </div>

            <div class="social-box">

              <h3>Get the Latest Deals</h3>

              <div class="texts">

                <p>and</p>

                <p>receive <span>₹20 coupon</span> for first shopping </p>

              </div>

              <div class="input-group news w-75 m-auto">

                <input type="text" placeholder="Email" class="form-control" name="">

                <span class="">

                  <button type="submit" class="btn btn-primary">

                    <span class="iconify" data-icon="cil:arrow-right" style="font-size: 20px;"></span>

                  </button>

                </span>

              </div>

            </div>

          </div>

        </div>

      </div>

    </section>





    <!-- ========================= TESTIMONIAL SECTION ========================= -->

   
    <section class="pd-bottom-slide pd-top">

      <div class="container">

        <div class="col-head">

          <h2>Testimonial</h2>

          <p>Browse the collection of our products and top interresting products. definitely find what you are looking for.</p>

          <div class="clearfix"></div>

        </div>

        <div id="testimonial" class="owl-carousel owl-theme">
  @if(!empty($testimonials) && (count($testimonials)) > 0)

                @foreach($testimonials as $test)

          <div class="item">

            <div class="test-box">

              <div class="test-icon">

                <span class="iconify" data-icon="ci:double-quotes-r" style="font-size: 60px;"></span>

              </div>
                 @php
                  $rating_point = $test->rating;
                  @endphp
               <ul class="rating-stars">  
                  @for($i=1; $i<=5; $i++)
                @if($rating_point >= $i)
                   <i class="fa fa-star" style="color:#ff6600;" ></i>
                   @else
                    <i class="fa fa-star" style="color:#ccc;" ></i>
                   @endif
                    @endfor    
              </ul>

              <p>{{$test->message}}</p>

              <div class="test-circle">

                      @if (isset($test->image) && Storage::exists($test->image))      
                          <img src="{{ URL::asset('storage/' . $test->image) }}"  />                   

                 @endif
              </div>

              <h4>{{$test->first_name}}&nbsp;{{$test->last_name}}</h4>

              <p>

               <!--  <span>Position</span> -->

              </p>

            </div>

          </div>
          @endforeach
          @endif

        </div>

      </div>

    </section>



    <!-- ========================= BLOG SECTION ========================= -->
  @if(count($blogs)> 0)
    <section class="pd-bottom pd-top blog-bg">

      <div class="container">

        <div class="col-head">

          <h2>LATEST BLOG</h2>

          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore</p>

          <div class="clearfix"></div>

        </div>

        <div class="row">

        

          @foreach($blogs as $blog)

          <div class="col-md-4">

            <div class="single-blog mrgn-btm">

              <div class="single-blog-img">

                <a href="{{route('getBlogDetails',$blog->url)}}">

                

                  @if (isset($blog->image) && Storage::exists($blog->image))

                  

                      <img src="{{ URL::asset('storage/' . $blog->image) }}" alt="Blog Image">

                     

                      @endif

                </a>

              </div>

              <div class="blog-content-box">

                <h4>

                  <a href="{{route('getBlogDetails',$blog->url)}}">{{$blog->title}}</a>

                </h4>

                <div class="meta-post">

                  <ul>

                    <li>

                      <a href="#">

                        <span class="iconify" data-icon="ant-design:user-outlined" style="font-size: 15px;"></span> {{$blog->author}} </a>

                    </li>

                    <li>

                      <a href="{{route('getBlogDetails',$blog->url)}}">

                        <span class="iconify" data-icon="uit:calender" style="font-size: 15px;"></span> {{\Carbon\Carbon::parse($blog->created_at)->format('d M')}} </a>

                    </li>

                  </ul>

                </div>

                <div class="exerpt">

                 {!!  substr($blog->content, 0, 100 ?? '-' ) !!}</div>

                <a href="{{route('getBlogDetails',$blog->url)}}" class="btn-two">Read More</a>

              </div>

            </div>

          </div>

          @endforeach
        </div>

      </div>

    </section>
    @endif

    <!-- ========================= OUR PRODUCTS SECTION ========================= -->

    <section class="pd-bottom pd-top">

      <div class="container">

        <h2 class="main-heading">OUR PRODUCTS</h2>

        <div id="our-product" class="owl-carousel owl-theme">



          @if(!empty($ourProduct))

          @foreach($ourProduct as  $ourproducts)

          <div class="item">

            <div class="our-product-box">

              <p>{{$ourproducts->name}}</p>

            </div>

          </div>

          @endforeach

          @endif

  

        </div>

      </div>

    </section>

<script type="text/javascript">

  $('#primium-category').owlCarousel({

    loop:false,

    margin:30,

    nav:true,

  autoplay:true,

  autoHeight:true,

    responsive:{

        0:{

            items:1

        },

        400:{

            items:2

        },

     600:{

            items:3

        },

    768:{

            items:3

        },

        1000:{

            items:6

        }

    }

})

</script>

    



@endsection



 