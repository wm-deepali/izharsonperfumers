 <!-- ========================= FOOTER ========================= -->

    <footer class="section-footer  text-black">

        <div class="container">

          <section class="footer-top  padding-y-lg">

            <div class="row">

              <aside class="col-md-3 col-12">

                <article class="mr-md-4">

                  <img class="logo" src="{{asset('frontend/images/logo.png')}}">

                     @php

               

                  $socialLinksfooter = App\Models\SocialLinkSetting::first();                  

                  $siteaddress = App\Models\GeneralSetting::first();

                 

                  @endphp

                  @if(!empty($siteaddress->address))

                  <p class="my-2">

                    <strong>Address : </strong>{{$siteaddress->address}}

                  </p>

                  @endif

                 

                  <div>

                     @if(!empty($socialLinksfooter->fb_name) && (!empty($socialLinksfooter->show_in_footer_fb) )) 

                    <a href="{{$socialLinksfooter->fb_name}}" class="btn btn-icon bg-white rounded-circle">

                      <i class="fab fa-facebook-f"></i>

                    </a>

                    @else

                     <!--   <a href="javascript::void();" class="btn btn-icon bg-white rounded-circle">

                      <i class="fab fa-facebook-f"></i>

                    </a> -->

                    @endif



                      @if(!empty($socialLinksfooter->twit_name) &&  (!empty($socialLinksfooter->show_in_footer_twit) )) 

                    <a href="{{$socialLinksfooter->twit_name}}" class="btn btn-icon bg-white rounded-circle">

                      <i class="fab fa-twitter"></i>

                    </a>

                    @else

                     <!--    <a href="javascript::void();" class="btn btn-icon bg-white rounded-circle">

                      <i class="fab fa-twitter"></i>

                    </a> -->

                    @endif



                   



                      @if(!empty($socialLinksfooter->insta_name) && (!empty($socialLinksfooter->show_in_footer_insta) ))

                    <a href="{{$socialLinksfooter->insta_name}}" class="btn btn-icon bg-white rounded-circle">

                      <i class="fab fa-instagram"></i>

                    </a>

                    @else

                    <!--   <a href="javascript::void();" class="btn btn-icon bg-white rounded-circle">

                        <i class="fab fa-instagram"></i>

                    </a> -->

                    @endif

                  



                    @if(!empty($socialLinksfooter->youtube_name) && (!empty($socialLinksfooter->show_in_footer_youtube) ))

                    <a href="{{$socialLinksfooter->youtube_name}}" class="btn btn-icon bg-white rounded-circle">

                    <i class="fab fa-youtube"></i>

                    </a>

                    @else

                          <!--  <a href="javascript::void();" class="btn btn-icon bg-white rounded-circle">

                       <i class="fab fa-youtube"></i>

                    </a> -->

                    @endif

                  

                  </div>

                </article>

              </aside>

              <aside class="col-md col-6">

                <h5 class="title">QUICK LINKS 

                </h5>

                <ul class="list-unstyled">

                  <li>

                    <a href="{{route('aboutUs')}}">About Us</a>

                  </li>

                  <li>

                    <a href="{{route('getBestSales')}}">Best Sales</a>

                  </li>

                  <li>

                   @if (Auth::guard('customer')->check())
                     <input type="hidden" name="user_type" id="user_type" value="loggedIn">
                    <a href="{{route('getFeedback')}}" class="user_type">Feed Back</a>
                    @else
                     <input type="hidden" name="user_type" id="user_type" value="visiter">
                    <a href="{{route('getFeedback')}}" class="user_type" >Feed Back</a>
                    @endif
                  </li>

                  <li>

                    <a href="{{route('getBlogData')}}">Blogs</a>

                  </li>

                  <li>

                    <a href="{{route('faqs')}}">Faqs </a>

                  </li>

                  <li>

                    <a href="{{route('getContactUsForm')}}">Contact Us</a>

                  </li>

                </ul>

              </aside>

              <aside class="col-md col-6">

                <h5 class="title">Policy</h5>

                <ul class="list-unstyled">

                  <li>

                    <a href="{{route('getRefundCancellation')}}">Refund & Cancellation Policy</a>

                  </li>

                  <li>

                    <a href="{{route('getPrivacyPolicy')}}">Privacy Policy</a>

                  </li>

                  <li>

                    <a href="{{route('getCookiePolicy')}}">Cookie Policy</a>

                  </li>

                  <li>

                    <a href="{{route('getTermsConditions')}}">Terms & Conditions</a>

                  </li>

                  

                </ul>

              </aside>

              <aside class="col-md-4 col-12">

                <h5 class="title">GET SHOP APP</h5>

                <p class="my-2">We will send you a link on your Email or Phone, open it on your phone and download the App.</p>

                <div class="row">

                  <div class="col-md-4">

                    <div class="rdo-box">

                      <label class="customradio">

                        <span class="radiotextsty">Email</span>

                        <input type="checkbox" name="radio">

                        <span class="checkmark"></span>

                      </label>

                    </div>

                  </div>

                  <div class="col-md-4">

                    <div class="rdo-box">

                      <label class="customradio">

                        <span class="radiotextsty">Phone</span>

                        <input type="checkbox" name="radio">

                        <span class="checkmark"></span>

                      </label>

                    </div>

                  </div>

                </div>

                <form>

                  <div class="input-group news w-100">

                    <input type="text" placeholder="Email" class="form-control" name="">

                    <span class="">

                      <button type="submit" class="btn btn-primary"> SHARE APP LINK</button>

                    </span>

                  </div>

                  <!-- input-group.// -->

                </form>

                <ul class="list-icon">

                  <li>

                    <img src="{{asset('frontend/images/app-store.svg')}}" />

                  </li>

                  <li>

                    <img src="{{asset('frontend/images/google-play.svg')}}" />

                  </li>

                </ul>

              </aside>

            </div>

            <!-- row.// -->

          </section>

          <!-- footer-top.// -->

          <section class="footer-bottom text-center">

            <h6>COMPLETELY SAFE AND SECURE PAYMENT METHOD</h6>

            <p>We accept Netbanking, all major credit cards. We also accept orders with cash payment</p>

            <i class="fab fa-lg fa-cc-visa"></i>

            <i class="fab fa-lg fa-cc-paypal"></i>

            <i class="fab fa-lg fa-cc-mastercard"></i>

          </section>

        </div>

        <!-- //container -->

      

      <div class="bg-light p-2 text-center copyright">

        <p>© Copyright 2022 Krishna Chiken Industry. All Right Reserved | Design & Maintained by Web Mingo IT Solutions</p>

      </div>  

      </footer>





  

      <script >

           $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });


$(document).ready(function() {
        
          $(document).on('click', '.update-wishlist-btn', function(event) {
            let product_id = $(this).attr('product_id');
            $.ajax({
                url: `{{ URL::to('update-wishlist/${product_id}') }}`,
                type: 'POST',
                dataType: 'json',
                context: this,
                success: function(result) {
                    if (result.success) {
                        if (result.code == 200) {
                            $(this).find('i').toggleClass("fa-heart fa-heart-o");
                            swal("Successfully !", "Item added to wishlist", "success");
                            setTimeout(function() {
                                window.location = `{{ URL::to('my-wishlist') }}`;
                            }, 1000);
                        } else {
                            $(this).find('i').toggleClass("fa-heart fa-heart-o");
                            swal("Successfully!", "Item removed from wishlist.", "success");
                            setTimeout(function() {
                                 location.reload();
                            }, 1000);
                           
                        }
                    } else {
                        console.log(result);
                    }
                },
                error: function(error) {
                    if (error.status == 401) {
                      //  $('#exampleModalCenter').modal('show');
                        setTimeout(function() {
                                window.location = `{{ URL::to('/sign-in') }}`;
                            }, 1000);
                    }
                }
            });
        });

           $(document).on('click', '.user_type', function(event) {
           
             var usertype = $('#user_type').val();
  
              if( usertype == "visiter" ){
                 alert('Please Log in  or create an account to write a feedback.');
                 return false;
            }
             
        });


    });
      </script>