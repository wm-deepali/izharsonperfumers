<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta http-equiv="cache-control" content="max-age=604800" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Krishna Chicken |SignIn</title>
    <link href="{{asset('frontend/images/favicon.png')}}" rel="shortcut icon" type="image/x-icon">
    <!-- Bootstrap4 files-->
    <link rel="icon" type="image/png" href="{{asset('frontend/images/favicon.png')}}">
    <link href="{{asset('frontend/css/bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('frontend/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/owl.theme.css')}}" rel="stylesheet">
   
    <!-- Font awesome 5 -->
    <link href="{{asset('frontend/fonts/fontawesome/css/all.min3661.css')}}" type="text/css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- custom style -->
    <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('frontend/css/ui.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet" type="text/css" />

  
  </head>
<body class="bg-light">
<!--start here body section -->
<div class="signin-section">
  <div class="signing-box-left">
    <div class="signin-form-content">
      <div class="sign-logo">
      <img src="{{asset('frontend/images/logo.png')}}">
      </div>

      <div class="signin-ul">
        <ul class="siginin-points">
                    <li>
                        <i class="manageorders"></i>
                        <h5>MANAGE YOUR ORDERS</h5>
                        <p>Track orders, manage cancellation &amp; return</p>
                    </li>
                    <li>
                        <i class="shorlist"></i>
                        <h5>SHORTLIST ITEMS YOU LOVE</h5>
                        <p>Keep items you love on a watchlist.</p>

                    </li>
                    <li>
                        <i class="offersudpate"></i>
                        <h5>AWESOME OFFERS UPDATES FOR YOU</h5>
                        <p>Be first to know about great offers and save.</p>
                    </li>
                </ul>
      </div>
      <div class="signing-footer-section mt-5">
        <ul>
          <li><a href="{{url('/')}}">Home </a></li>
          <li><a href="{{route('aboutUs')}}">About Us </a></li>
          <li><a href="{{route('faqs')}}">FAQs </a></li>
          <li>
              @if (Auth::guard('customer')->check())
                     <input type="hidden" name="user_type" id="user_type" value="loggedIn">
                    <a href="{{route('getFeedback')}}" class="user_type">Feed Back</a>
                    @else
                     <input type="hidden" name="user_type" id="user_type" value="visiter">
                    <a href="{{route('getFeedback')}}" class="user_type" >Feed Back</a>
                    @endif
              
              </li>
          <li><a href="{{route('getBlogData')}}">Blogs </a></li>
          <li><a href="{{route('getContactUsForm')}}">Contact Us </a></li>
        </ul>
      </div>
      <div class="copyright mt-2 text-center">
        <p>Copyright ©️ 2022 Krishna Chikan Industry. All Rights Reserved.</p>
      </div>
    </div>
  </div>
  <div class="signing-box-right">
    <h2 class="signin-heading">Sign In</h2>
   <!--  <div class="email-mobile-btn mt-5 mb-3">
      <label class="custom-radio-btn d-inline-block sign-btn-radio" id="emailbtn">Email
                <input type="radio" checked="checked" name="signin">
                <span class="checkmark"></span>
              </label>
      <label class="custom-radio-btn ml-5 d-inline-block sign-btn-radio" id="mobilebtn">Mobile
                <input type="radio"  name="signin">
                <span class="checkmark"></span>
              </label>
    </div> -->


    <div class="email-form">
      <form action="#" class="login-form" id="login-form">
        <div class="row">
          <div class="col-12">
            <div class="wdinput form-group">
              <label>Email Id</label>
                <input type="email" class="form-control" placeholder="Email" name="email" id="email" />
                            <div class="text-danger validation-err" id="email-err"></div>
             
            </div>

            <div class="wdinput form-group">
              <label>Password</label>
               <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
                            <div class="text-danger validation-err" id="password-err"></div>
            </div>

              @if (Route::has('password.request'))   
                <div class="wdinput form-group ">
             <a  href="{{ route('password.request') }}">Forgot Password ?</a>
            </div>               

              @endif

            <div class="wdinput form-group">
               <label>Don't have account ? <a href="{{route('registrationForm')}}">Sign Up</a></label>
           
            </div>
          
               @if (session('cart'))
          <input type="hidden" name="cartAmount" value="{{count(session('cart'))}}" id="cartAmount">
          @else
          <input type="hidden" name="cartAmount" value="0" id="cartAmount">
          @endif
          
            <div class="wdinput form-group">
             <button class="btn bg-dark text-white signinbtn" id="login-btn" type="button">Sign In</button>
            </div>
          </div>
        </div>
      </form>
    </div>

   <!--  <div class="mobile-form hidden">
      <form>
        <div class="row">
          <div class="col-12">
            <div class="wdinput form-group position-relative">
              <label>Mobile Number</label>
             <div class="position-relative"> 
            <input type="number" name="mobilenumber" class="form-control" placeholder="Enter Mobile Number">
            <button class="btn send-otp" type="button"><i class="fa fa-angle-right"> </i></button>  
          </div>
            </div>

            <div class="wdinput form-group otpsection hidden">
              <label>OTP</label>
              <div class="wdinput otpinput mb-3">
              <input type="number" name="otp1" class="form-control text-center otpinputfield" placeholder="*" maxlength="1">
              <input type="number" name="otp2" class="form-control text-center otpinputfield" placeholder="*" maxlength="1">
              <input type="number" name="otp3" class="form-control text-center otpinputfield" placeholder="*" maxlength="1">
              <input type="number" name="otp4" class="form-control text-center otpinputfield" placeholder="*" maxlength="1">
            </div>
            <a href="#">Resend OTP </a>
            <div class="wdinput d-block mt-3">
            <button class="btn bg-dark text-white signinbtn" type="submit">Submit</button>
            </div>
            </div>

            

            
          </div>
        </div>
      </form>
    </div>
 -->
 <!-- social login start  -->
    <!-- <div class="signinwith text-center border-top pt-3">
      <h3 class="mb-3">Sign in With</h3>
      <div class="signinwithsec">
          <a href="#" class="facebookclass"><i class="fa fa-facebook"> </i></a>
        

       
          <a href="#" class="googleplusclass"><i class="fa fa-google-plus"> </i></a>
        

        
          <a href="#" class="mailclass"><i class="fa fa-envelope"> </i></a>
      </div>
    </div> -->
    <!-- end socail login  -->
  </div>
</div>




<!-- script -->

    <script src="{{asset('frontend/js/jquery-2.0.0.min.js')}}" type="text/javascript"></script>
   
    <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
   
    <script src="{{asset('frontend/js/owl.carousel.js')}}"></script>
  
    <script src="{{asset('frontend/js/script.js')}}" type="text/javascript"></script>
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
          <script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script >
         $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
          $(document).on('click', '#login-btn', function(event) {
            $(this).attr('disabled', true);
            $('.validation-err').html('');
            let email = $('#login-form #email').val();
            let password = $('#login-form #password').val();
            
             let cartValue = $('#cartAmount').val();
             if( cartValue == 0){
                var href = "{{url('/')}}";

            }else{
                 var href = "{{URL::to('/cart-details')}}";
            }
            let formData = new FormData();
            formData.append('email', email);
            formData.append('password', password);
            $.ajax({
                url: "{{ URL::to('sign-in') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        swal("Success!", "Logged in", "success");
                        setTimeout(function() {
                             window.location.href = href;
                        }, 1000);
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#login-form #${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
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
    </script>
    
    </body>
    </html>