    <!-- ========================= Top  HEADER SECTION  ========================= -->
    <div id="overlay" class="hidden"></div>
    <header class="section-header">
      <div class="desktop">
        <nav class="navbar top-h p-md-0 navbar-expand-sm navbar-light">
          <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTop4">
              <ul class="navbar-nav mr-auto">        
                <li class="nav-item">
                @php
                  $topheaderData = App\Models\HeaderSetting::first();
                  $socialLinksHeader = App\Models\SocialLinkSetting::first();
                  

                  @endphp
                   @if(!empty($topheaderData->mobile_number))
                  <a href="#" class="nav-link border-right pl-0">
                    <span class="iconify" data-icon="ph:phone-call-light" style="font-size: 20px;"></span> (+91) {{$topheaderData->mobile_number}} </a>
                    @else
                     <a href="#" class="nav-link border-right pl-0">
                    <span class="iconify" data-icon="ph:phone-call-light" style="font-size: 20px;"></span> NA</a>
                    @endif

                </li>
                <li class="nav-item">
                   @if(!empty($topheaderData->whatsapp_number))
                  <a href="#" class="nav-link">
                    <span class="iconify" data-icon="ph:whatsapp-logo-light" style="font-size: 20px;"></span> (+91) {{$topheaderData->whatsapp_number}} </a>
                    @else
                     <a href="#" class="nav-link">
                    <span class="iconify" data-icon="ph:whatsapp-logo-light" style="font-size: 20px;"></span> NA </a>
                    @endif
                </li>
              </ul>
              <ul class="navbar-nav social-media-header">
                <li>
                    @if(!empty($topheaderData->email))
                  <a href="#" class="nav-link border-right">
                    <span class="iconify" data-icon="ph:envelope-thin" style="font-size: 20px;"></span> {{$topheaderData->email}} </a>
                    @else
                  <a href="#" class="nav-link border-right">
                    <span class="iconify" data-icon="ph:envelope-thin" style="font-size: 20px;"></span> NA</a>
                    @endif

                </li>
                <li>
                  @if(!empty($socialLinksHeader->fb_name) && (!empty($socialLinksHeader->show_in_header_fb)))
                  <a href="{{$socialLinksHeader->fb_name}}" class="nav-link border-right">
                    <span class="iconify" data-icon="bxl:facebook" style="font-size: 20px;"></span>
                  </a>
                  @else
         
                  @endif
                </li>
                <li>
                   @if(!empty($socialLinksHeader->twit_name) && (!empty($socialLinksHeader->show_in_header_twit)))
                  <a href="{{$socialLinksHeader->twit_name}}" class="nav-link border-right">
                    <span class="iconify" data-icon="jam:twitter" style="font-size: 20px;"></span>
                  </a>
                  @else
               
                  @endif
                </li>
                <li>
                    @if(!empty($socialLinksHeader->insta_name) && (!empty($socialLinksHeader->show_in_header_insta)))
                  <a href="{{$socialLinksHeader->insta_name}}" class="nav-link">
                    <span class="iconify" data-icon="prime:instagram" style="font-size: 20px;"></span>
                  </a>
                  @else
            
                  @endif
                </li>
              </ul>
              <div class="center-col">
                @if(!empty($topheaderData->coupon_code))
                <p>"{{str_replace('"', '', $topheaderData->coupon_code)}}"</p>
                 
                @endif
              </div>
              <!-- list-inline //  -->
            </div>
            <!-- navbar-collapse .// -->
          </div>
          <!-- container //  -->
        </nav>

        <!-- end top nav  data  -->
        <!-- start middle nav data -->
         <section class="header-main border-bottom">

          <div class="container">

            <div class="row row-sm align-items-center">

              <div class="col-lg-3 col-md-3 col-6">

                <a href="{{url('/')}}" class="brand-wrap">
                    @if (isset($topheaderData->header_logo) && Storage::exists($topheaderData->header_logo))
                    <img class="logo h-50"  src="{{ URL::asset('storage/' . $topheaderData->header_logo) }}" >
                @endif
             
                </a>

              </div>

              <!-- col.// -->

              <!-- col.// -->

              <div class="col-lg-9 col-sm-12 col-md-12 col-12">

                <div class="widgets-wrap d-flex">

                  <div class="widget-header mr-auto">

                    <div class="icontext">

                      <form class="form-inline my-2 my-lg-0 px-2" method="GET" action="{{ route('listing') }}" >
                        <input class="form-control mr-sm-2 search-input" type="search" placeholder="Search Product...." name="search" value="{{ $filter_search ?? null }}"  aria-label="Search">
                        <button class="btn icon" type="submit">
                          <i class="icon-sm active rounded-circle border">
                            <span class="iconify" data-icon="bytesize:search" data-height="24"></span>
                          </i>
                        </button>
                      </form>

                    </div>

                  </div>
<!-- login and sign up section  -->
  @if (Auth::guard('customer')->check())
  <div class="widge-add-to-cart">

                  
                   <a href="{{ route('dashboard') }}" class="widget-header mr-2" title="my account">
                
                    @if (isset(Auth::guard('customer')->user()->image) && Storage::exists(Auth::guard('customer')->user()->image))

              <img src="{{ URL::asset('storage/' . Auth::guard('customer')->user()->image) }}" alt="" width="25" height="25"  class="rounded-circle mb-2 userProfile" style="margin-top: 5px;">
@else
    <i class="icon icon-sm rounded-circle border">
                      <span class="iconify" data-icon="codicon:account" data-height="25" bb ></span>
                    </i>
                                     @endif
                    
                  </a>
                <a href="{{route('my-wishlist')}}" class="widget-header mr-2" title="wishlist">
                    <i class="icon icon-sm rounded-circle border">
                      <span class="iconify" data-icon="ei:heart" data-height="30"></span>
                    </i>
                    @if(CountWishlist() > 0 )
                    <span class="notify color-yellow">  {{CountWishlist()}} </span>
                    @else
                     <span class="notify color-yellow"> 0 </span>
                    @endif
                  </a>

                  <a href="{{route('cart')}}" class="widget-header mr-2" title="my cart">
                    <i class="icon icon-sm rounded-circle border">
                      <span class="iconify" data-icon="fluent:cart-16-regular" data-height="30"></span>
                    </i>
                    <span class="notify color-green">
                      {{ Auth::guard('customer')->user()->cart_details->count() }}
                    </span>
                  </a>


                   <a href="javascript::void(0);" class="widget-header mr-2" title="logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="icon icon-sm rounded-circle border">
                      <span class="iconify" data-icon="ant-design:logout-outlined" data-height="25" ></span>
                    </i>
                    
                  </a>
                   <form id="logout-form" action="{{ route('log-out') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                </div>
                  @else 
                  <div class="widge-add-to-cart">
                       <a  href="{{route('signInForm')}}" class="widget-header mr-2"> Login &nbsp;&nbsp;/ </a>
                        <a href="{{ route('registrationForm') }}"   class="widget-header mr-2">Sign-up</a>
                 
                  <a href="#" class="widget-header mr-2">
                    <i class="icon icon-sm rounded-circle border">
                      <span class="iconify" data-icon="ei:heart" data-height="30"></span>
                    </i>
                    <span class="notify color-yellow">0</span>
                  </a>

                  <a href="#" class="widget-header mr-2">

                    <i class="icon icon-sm rounded-circle border">

                      <span class="iconify" data-icon="fluent:cart-16-regular" data-height="30"></span>

                    </i>

                    <span class="notify color-green"> 
                     @if (session('cart'))
                          {{ count(session('cart')) }}
                         @else
                             0
                        @endif</span>

                  </a>

                </div>
                @endif
<!-- end login and signup sction  -->
                  <!-- widget-header .// -->

                </div>

                <!-- widgets-wrap.// -->

              </div>

              <!-- col.// -->

            </div>

            <!-- row.// -->

          </div>

          <!-- container.// -->

        </section>
        <!-- End Top Header  -->