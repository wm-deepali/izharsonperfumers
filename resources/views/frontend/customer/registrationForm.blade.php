<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta http-equiv="cache-control" content="max-age=1204800" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Krishna Chicken |SignUp</title>
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
<div class="signin-section">
  <div class="signing-box-left">
    <div class="signin-form-content">
      <div class="sign-logo">
      <img src="{{asset('frontend/images/logo.png')}}">
      </div>

 <!--      <div class="signin-ul">
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
          <li><a href="#">Home </a></li>
          <li><a href="#">About Us </a></li>
          <li><a href="#">FAQs </a></li>
          <li><a href="#">Feedback </a></li>
          <li><a href="#">Blogs </a></li>
          <li><a href="#">Contact Us </a></li>
        </ul>
      </div>
      <div class="copyright mt-2 text-center">
        <p>Copyright ©️ 2022 Krishna Chikan Industry. All Rights Reserved.</p>
      </div> -->
    </div>
  </div>
  <div class="signing-box-right">
    <h2 class="signin-heading">Sign Up</h2>

    
    <div class="signup-email-form mt-5">
         <form action="#" class="login-form" id="register-form">
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-6 col-6">
            <div class="wdinput form-group">
              <label> Name</label>
               <input type="text" class="form-control" placeholder="Name" name="name" id="name" />
                            <div class="text-danger validation-err" id="name-err"></div>
            </div>
          </div>
         
           <div class="col-xl-6 col-lg-6 col-md-6 col-6">
             <label>Email</label>
            <div class="wdinput form-group">
              <input type="email" class="form-control" placeholder="Email" name="email" id="email" />
                            <div class="text-danger validation-err" id="email-err"></div>
            </div>
          </div>

          <div class="col-xl-6 col-lg-6 col-md-6 col-6">
            <div class="wdinput form-group">
              <label>Phone Number</label>
              <input type="number" class="form-control" placeholder="Phone Number" name="mobile_number" id="mobile_number" />
                            <div class="text-danger validation-err" id="mobile_number-err"></div>
            </div>
          </div>

          <div class="col-xl-6 col-lg-6 col-md-6 col-6">
            <div class="wdinput form-group">
              <label>Password</label>
               <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
                            <div class="text-danger validation-err" id="password-err"></div>
            </div>
          </div>


          <div class="col-xl-6 col-lg-6 col-md-6 col-6">
            <div class="wdinput form-group">
              <label>Confirm Password</label>
              <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Passowrd" id="password_confirmation">
                 <div class="text-danger validation-err" id="password_confirmation-err"></div>
            </div>
          </div>

 <div class="col-xl-6 col-lg-6 col-md-6 col-6">
            <div class="wdinput form-group">
               <label>Already have account ? <a href="{{route('signInForm')}}">Sign In</a></label>
           
            </div>
          </div>

           <div class="col-xl-6 col-lg-6 col-md-6 col-6">
            <div class="wdinput form-group">
           
             @if (session('cart'))
          <input type="hidden" name="cartAmount" value="{{count(session('cart'))}}" id="cartAmount">
          @else
          <input type="hidden" name="cartAmount" value="0" id="cartAmount">
          @endif
          
            <button class="btn bg-dark text-white"  id="register-btn" type="submit" >Create Account</button>

            </div>
          </div>
          
         

           
          </div>
      </form>
    </div>


   <!--  <div class="signinwith text-center border-top pt-3">
      <h3 class="mb-3">Sign in With</h3>
      <div class="signinwithsec">
          <a href="#" class="facebookclass"><i class="fa fa-facebook"> </i></a> 
          <a href="#" class="googleplusclass"><i class="fa fa-google-plus"> </i></a>
      </div>
    </div> -->
  

<div class="signing-footer-section show mt-5">
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
      <div class="copyright show mt-2 text-center">
        <p>Copyright ©️ 2022 Krishna Chikan Industry. All Rights Reserved.</p>
      </div>
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

    $(document).ready(function() {
        $(document).on('click', '#register-btn', function(event) {
            $(this).attr('disabled', true);
            $('.validation-err').html('');
            let name = $('#register-form #name').val();
            let email = $('#register-form #email').val();
            let password = $('#register-form #password').val();
            let password_confirmation = $('#register-form #password_confirmation').val();
            let mobile_number = $('#register-form #mobile_number').val();
            
             let cartValue = $('#cartAmount').val();
           
             if( cartValue == 0){
                var href = "{{url('/')}}";

            }else{
                 var href = "{{URL::to('/cart-details')}}";
            }
            let formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('password_confirmation', password_confirmation);
            formData.append('mobile_number', mobile_number);
            $.ajax({
                url: "{{ URL::to('register') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        swal("Success!", "Registered", "success");
                        setTimeout(function() {
                           window.location.href = href;
                           
                        }, 1000);
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#register-form #${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
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