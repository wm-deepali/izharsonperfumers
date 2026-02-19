<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Krishna Chikan">
    <meta name="keywords" content="Krishna Chikan">
    <meta name="author" content="Webmingo">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Welcome to Izharson Perfumers | Itr & Perfume Manufacturer</title>
    <!--  <title>Krishna Chikan | @yield('title')</title> -->
  
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/fonts/font-awesome/css/font-awesome.min.css') }}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/css/app.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/css/colors.min.css') }}">
    <!-- END STACK CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/css/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/css/datatable.css') }}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/css/style_inner.css') }}">
    <!-- END Custom CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/css/jquery-ui.structure.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/css/jquery-ui.theme.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.4/sweetalert2.min.css" integrity="sha512-zEmgzrofH7rifnTAgSqWXGWF8rux/+gbtEQ1OJYYW57J1eEQDjppSv7oByOdvSJfo0H39LxmCyQTLOYFOa8wig==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
</head>

<body class="horizontal-layout horizontal-menu 2-columns menu-expanded" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-static-top navbar-dark bg-gradient-x-grey-blue navbar-border navbar-brand-center">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav">
                    <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a href="#" class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="fa fa-bars"></i></a></li>
                   
                    <li class="nav-item" >
                         <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
                        <img style="height:80px;width:200px" src="{{asset('storage/'.Auth::user()->image_header)}}"  alt="" />
                        </a>
                            <!--<h3 clas="brand-text">Precision Tune AutoCare</h3>-->
                        </li>
                         
                    <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="fa fa-ellipsis-v"></i></a></li>
                </ul>
            </div>
            
            
            <div class="navbar-container content container-fluid">
                <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
                    <ul class="nav navbar-nav">
                        <li class="nav-item hidden-sm-down"><a href="{{ route('admin.dashboard') }}" class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="ft-menu"></i></a></li>
                        <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link nav-menu-main mt-1"><i class="fa fa-home"></i> Dashboard</a></li>
                        <!--<li class="dropdown dropdown-language nav-item"> <a id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link"><i class="ft-file"></i>Report<span class="selected-language"></span></a>-->
                        <!--    <div aria-labelledby="dropdown-flag" class="dropdown-menu">-->
                        <!--        {{-- <a href="{{ route('manage-sales-report') }}" class="dropdown-item"><i class="ft-file"></i>Sales Report</a>-->
                        <!--        <a href="{{ route('manage-stock-report') }}" class="dropdown-item"><i class="ft-file"></i>Stock Report</a>-->
                        <!--        <a href="{{ route('manage-gst-report') }}" class="dropdown-item"><i class="ft-file"></i>GST Report</a> --}}-->
                        <!--    </div>-->
                        <!--</li>-->
                    </ul>
                    <ul class="nav navbar-nav float-xs-right">
                        <li class="dropdown dropdown-user nav-item">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link">
                                <span class="avatar avatar-online">
                                    @if(isset(Auth::user()->image) && Storage::exists(Auth::user()->image))
                                        <img  src="{{ URL::asset('storage/' . Auth::user()->image) }}" alt="avatar">
                                    @else
                                        <img src="{{ URL::asset('admin/images/avatar.png') }}" alt="avatar">
                                    @endif
                                    <i></i>
                                </span>
                                <span class="user-name">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                {{-- <a href="{{ route('manage-storesetting.index') }}" class="dropdown-item"><i class="ft-user"></i> Store Settings</a> --}}
                                 <a href="{{ route('admin.accountSetting') }}" class="dropdown-item"><i class="ft-user"></i> My Account</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();
                                "><i class="ft-power"></i>
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow navbar-shadow menu-border" style="min-height:2rem" role="navigation" data-menu="menu-wrapper">
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-cogs"></i><span>Admin Setting</span></a>
                    <ul class="dropdown-menu">
                        
                        <li><a class="dropdown-item" href="{{ route('admin.accountSetting') }}" data-toggle="dropdown">Admin Profile & Password</a></li>
                        <li><a class="dropdown-item reload" onclick="clickHandle('{{ url('admin/manage-account/#pane-branch') }}')"  data-toggle="dropdown">Branch</a></li>
                        <li><a class="dropdown-item reload" onclick="clickHandle('{{ url('admin/manage-account/#pane-email') }}')" data-toggle="dropdown">Email API & Alerts</a></li>
                        <li><a class="dropdown-item reload" onclick="clickHandle('{{ url('admin/manage-account/#pane-sms') }}')"  data-toggle="dropdown">SMS API & ALerts</a></li>
                        <li><a class="dropdown-item reload" onclick="clickHandle('{{ url('admin/manage-account/#pane-gst') }}')"  data-toggle="dropdown">Invoice & Tax Setting</a></li>
                        <li><a class="dropdown-item reload" onclick="clickHandle('{{ url('admin/manage-account/#pane-payment') }}')"  data-toggle="dropdown">Payment Gateway Settings</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-general-setting.index') }}" data-toggle="dropdown">General Setting</a></li>
                      {{--  <li><a class="dropdown-item" href="{{url('admin/loyality-program')}}" data-toggle="dropdown">Loyalty & Rewards Setting</a></li>
                         <li><a class="dropdown-item" href="{{ route('admin.manage-pincode.index') }}" data-toggle="dropdown">Manage Zipcode</a></li>
                         <li><a class="dropdown-item" href="{{ route('manage-homepage-widget') }}" data-toggle="dropdown">Homepage Widget</a></li>
                        <li><a class="dropdown-item" href="{{ route('manage-shipping-method.index') }}" data-toggle="dropdown">Manage Shipping Method</a></li>
                        <li><a class="dropdown-item" href="{{ route('manage-shipping.index') }}" data-toggle="dropdown">Shipping Settings</a></li> --}}
                    </ul>
                </li>
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-cog "></i><span>Master Setting</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.manage-brand.index') }}" data-toggle="dropdown"> Manage Volume </a></li>
                         <!--<li><a class="dropdown-item" href="{{ route('admin.manage-brand-models.index') }}" data-toggle="dropdown"> Manage Fragrance /Scent </a></li>
                         <li><a class="dropdown-item" href="{{ route('admin.manage-carorigin.index') }}" data-toggle="dropdown"> Manage Brand </a></li> -->
                        <li><a class="dropdown-item" href="{{ route('admin.manage-cylinder.index') }}" data-toggle="dropdown"> Manage Packaging </a></li>
                         <li><a class="dropdown-item" href="{{ route('admin.manage-oil-grade.index') }}" data-toggle="dropdown"> Manage Fragrance /Scent </a></li>
                         <li>
                            
                       <a class="dropdown-item" href="{{ route('admin.manage-shipping') }}" data-toggle="dropdown">Manage Shipping Cost </a>
                       </li>
                    </ul>
                </li>
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-gift"></i><span>Coupon & Promotion</span></a>
                   <ul class="dropdown-menu">
                       <li><a class="dropdown-item" href="{{ route('admin.manage-coupon.index') }}" data-toggle="dropdown">Manage Coupons</a> </li>
                       <li><a class="dropdown-item" href="{{ route('admin.manage-promotion.index') }}" data-toggle="dropdown">Manage Promotion</a> </li>
                       {{-- <li><a class="dropdown-item" href="{{ route('manage-discount.index') }}" data-toggle="dropdown">Volume Discounts</a> </li>
                       <li><a class="dropdown-item" href="{{ route('manage-user-coupon') }}" data-toggle="dropdown">User Coupons</a> </li> --}}
                   </ul>
                </li>
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-tags"></i><span>Online Store</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.manage-category.index') }}" data-toggle="dropdown"> Manage Categories</a></li>
                        <!-- <li><a class="dropdown-item" href="{{ route('admin.manage-category.index') }}" data-toggle="dropdown"> Manage Sub Categories </a></li> -->
                        
                        <!--<li><a class="dropdown-item" href="{{ route('admin.manage-attribute.index') }}" data-toggle="dropdown"> Manage Attributes </a></li>-->
                        <!-- <li><a class="dropdown-item" href="{{ route('admin.manage-color.index') }}" data-toggle="dropdown"> Manage Colors </a></li> -->
                        <li><a class="dropdown-item" href="{{ route('admin.manage-product.index') }}" data-toggle="dropdown"> Manage Products </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-order.index') }}" data-toggle="dropdown"> Manage Orders </a></li>
                        <li><a class="dropdown-item" href="{{ url('admin/online-cancellation-refund') }}" data-toggle="dropdown"> Order Cancellation & Refunds </a></li>
                        {{-- <li><a class="dropdown-item" href="{{ route('manage-tag.index') }}" data-toggle="dropdown"> Manage Tags </a></li>
                        <li><a class="dropdown-item" href="{{ route('manage-product.index') }}" data-toggle="dropdown"> Manage Products </a></li>
                        <li><a class="dropdown-item" href="{{ route('manage-alternate-brand.index') }}" data-toggle="dropdown"> Manage Alternate Brands </a></li>
                        <li><a class="dropdown-item" href="{{ route('manage-alternate-product.index') }}" data-toggle="dropdown"> Manage Alternate Products </a></li> --}}
                        {{-- <li><a class="dropdown-item" href="{{ route('manage-productrating.index') }}" data-toggle="dropdown"> Manage Reviews</a></li> --}}
                    </ul>
                </li>
           <!--     <li style="display:none" class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-list-alt"></i><span>Car Services</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.manage-service-category.index') }}" data-toggle="dropdown"> Manage Service Categories </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-services.index') }}" data-toggle="dropdown"> Manage Services </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-packages.index') }}" data-toggle="dropdown">  Manage Oil Grade Packages </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-service-bookings.index') }}" data-toggle="dropdown"> Manage Service Bookings </a></li>
                        <li><a class="dropdown-item" href="{{url('admin/service-cancellation-refund')}}" data-toggle="dropdown"> Manage Service Cancellation </a></li>
                        
                    </ul>
                </li> -->
 
              
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-users"></i><span>Customers</span></a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('admin.manageCustomer') }}" data-toggle="dropdown">Manage All Customers</a> </li>
                      <li><a class="dropdown-item" href="{{url('admin/view-all-transactions')}}" data-toggle="dropdown">View All Transactions</a> </li>
                      <li><a class="dropdown-item" href="{{url('admin/manage-customer-review')}}" data-toggle="dropdown"> Manage Customer Reviews</a></li>
                   
                        
                    </ul>
                </li>
                
                
                <li style="display:none" class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-file-o"></i><span>Manage Orders</span></a>
                   <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('admin.manage-order.index') }}" data-toggle="dropdown">All Orders</a> </li>
                       

                      {{-- <li><a class="dropdown-item" href="{{ route('manage-refill-medicine.index') }}" data-toggle="dropdown">Refill Orders</a></li>
                       <li><a class="dropdown-item" href="{{ route('manage-prescription-order.index') }}" data-toggle="dropdown">Prescription Orders</a></li> --}}
                   </ul>
                </li>
                
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-tasks"></i><span>Content Management</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.manage-homepage-setting.index') }}" data-toggle="dropdown">Homepage Widgets</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-about-us.index') }}" data-toggle="dropdown">Manage About Us</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-slider.index') }}" data-toggle="dropdown">Manage Slider</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-blog.index') }}" data-toggle="dropdown">Manage Blog</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-faq-category.index') }}" data-toggle="dropdown">Manage FAQ Category</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-faq.index') }}" data-toggle="dropdown">Manage FAQ</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-policy', 'refund_policy') }}" data-toggle="dropdown">Manage Refund & Cancellation Policy</a></li>
                        <li style="display:none"><a class="dropdown-item" href="{{ route('admin.manage-policy', 'listing_policy') }}" data-toggle="dropdown">Manage Listing Policy</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-policy', 'privacy_policy') }}" data-toggle="dropdown">Manage Privacy Policy</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-policy', 'cookie_policy') }}" data-toggle="dropdown">Manage Cookie Policy</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-policy', 'shipping_policy') }}" data-toggle="dropdown">Manage Shipping Policy</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-policy', 'terms_and_condition') }}" data-toggle="dropdown">Manage Terms and Conditions</a></li>
                        <li style="display:none"><a class="dropdown-item" href="{{ route('admin.manage-pages.index') }}" data-toggle="dropdown">Manage Pages</a></li>
                     <!--   <li><a class="dropdown-item" href="{{ route('admin.manage-team.index') }}" data-toggle="dropdown">Manage Team</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-service-fleets.index') }}" data-toggle="dropdown">Manage Fleet Service </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-garage.index') }}" data-toggle="dropdown">Manage Garage Page Content </a></li> -->
                       <li style="display:none"><a class="dropdown-item" href="{{ route('admin.manage-career.index') }}" data-toggle="dropdown">Manage Career </a></li>
                    </ul>
                </li>
                
               <!--  <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-industry"></i><span>Garage & Franchise</span></a>
                    <ul class="dropdown-menu">
                     <li><a class="dropdown-item" href="{{url('admin/manage-garages')}}" data-toggle="dropdown">Manage Garage</a></li>
                        <li><a class="dropdown-item" href="{{url('admin/manage-franchise-inquiry')}}" data-toggle="dropdown">Manage Franchise Enquiry</a></li>
                    </ul>
                </li> -->
                
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-industry"></i><span>Customer Support</span></a>
                    <ul class="dropdown-menu">
                     <li><a class="dropdown-item" href="{{url('admin/manage-reasons-category')}}" data-toggle="dropdown">Cancellation & Return Reasons</a></li>
                        <li><a class="dropdown-item" href="{{url('admin/manage-ticket')}}" data-toggle="dropdown">Manage Tickets</a></li>
                    </ul>
                </li>
                
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-comments-o"></i><span>Inquiries</span></a>
                    <ul class="dropdown-menu">
                   <!--     <li><a class="dropdown-item" href="{{ url('admin/appointment-booking') }}" data-toggle="dropdown">Appointment Bookings</a> </li> -->
                        <li><a class="dropdown-item" href="{{ route('admin.email-subscriber') }}" data-toggle="dropdown">Email Subscribers</a> </li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-contact-us.index') }}" data-toggle="dropdown">Contact Inquiries</a> </li>
                        <li><a class="dropdown-item" href="{{ route('admin.manage-feedback.index') }}" data-toggle="dropdown">Feedbacks</a> </li>
                    </ul>
                </li>
                
                <!--<li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-industry"></i><span>Report</span></a>-->
                <!--    <ul class="dropdown-menu">-->
                <!--        <li><a class="dropdown-item" href="#" data-toggle="dropdown">Sales Report</a></li>-->
                <!--        <li><a class="dropdown-item" href="#" data-toggle="dropdown">Stock Report</a></li>-->
                <!--        <li><a class="dropdown-item" href="#" data-toggle="dropdown">GST Report</a></li>-->
                <!--    </ul>-->
                <!--</li>-->
                       
            </ul>
        </div>
    </div>
    @if (session()->get('success'))
        <div class="alert alert-info alert-dismissible fade in">
            <a href="javascript:void(0);" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> {{ session()->get('success') }}
        </div>
    @endif
    @if (session()->get('error'))
        <div class="alert alert-danger alert-dismissible fade in">
            <a href="javascript:void(0);" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> {{ session()->get('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
   

    <script>
     function clickHandle(data){
        sessionStorage.setItem('header',true);
        window.location.href = data;
        var hash = location.hash;
    if(hash == "#pane-branch"){
         $("#tab-branch").click();
    }
     if(hash == "#pane-email"){
         $("#tab-email").click();
    }
     if(hash == "#pane-sms"){
         $("#tab-sms").click();
    }
     if(hash == "#pane-gst"){
         $("#tab-gst").click();
    }
     if(hash == "#pane-payment"){
         $("#tab-payment").click();
    } 
    }
      
    </script>