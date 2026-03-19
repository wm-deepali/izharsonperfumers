<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="auto parts, baby store, ecommerce, electronics, fashion, food, marketplace, modern, multi vendor, multipurpose, organic, responsive, shop, shopping, store">
    <meta name="description" content="Izharson Perfumers">
    <meta name="CreativeLayers" content="ATFN">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- css file -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/ace-responsive-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/fontawesome-free.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/slider.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/dashbord_navitaion.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="../../css2?family=Jost:wght@400;500&family=Poppins:wght@700&display=swap" rel="stylesheet">
    <!-- Responsive stylesheet -->
    <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}">
    <!-- Title -->
    <title>@yield('title') | {{ config('app.name', 'Izharson Perfumers') }}</title>

    <!-- Favicon -->
    <link href="{{ asset('front/images/favicon.ico') }}" sizes="128x128" rel="shortcut icon" type="image/x-icon">
    <link href="{{ asset('front/images/favicon.ico') }}" sizes="128x128" rel="shortcut icon">
    <!-- Apple Touch Icon -->
    <link href="{{ asset('front/images/apple-touch-icon-60x60.png') }}" sizes="60x60" rel="apple-touch-icon">
    <link href="{{ asset('front/images/apple-touch-icon-72x72.png') }}" sizes="72x72" rel="apple-touch-icon">
    <link href="{{ asset('front/images/apple-touch-icon-114x114.png') }}" sizes="114x114" rel="apple-touch-icon">
    <link href="{{ asset('front/images/apple-touch-icon-180x180.png') }}" sizes="180x180" rel="apple-touch-icon">

    <style>
        .mobile_menu_widget_icons a.cart_btn {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mobile_menu_widget_icons a.cart_btn .icon {
            font-size: 22px;
        }

        /* ===== MOBILE STICKY FOOTER ===== */
        .newiz-mobile-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #fff;
            border-top: 1px solid #e5e5e5;
            z-index: 9999;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        }

        /* Menu */
        .newiz-footer-menu {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 0;
            padding: 8px 0;
            list-style: none;
        }

        /* Items */
        .newiz-footer-menu li {
            text-align: center;
            flex: 1;
        }

        /* Links */
        .newiz-footer-menu li a {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #555;
            font-size: 11px;
            transition: 0.3s;
        }

        /* Icons */
        .newiz-footer-menu li a i {
            font-size: 18px;
            margin-bottom: 3px;
        }

        /* Hover + Active */
        .newiz-footer-menu li a:hover,
        .newiz-footer-menu li a.active {
            color: #000;
        }

        /* Safe spacing for body */
    </style>


</head>

@php
    $settings = \App\Models\HeaderSetting::first();
    $socialLinks = \App\Models\SocialLinkSetting::first();
    $menuCategories = \App\Models\Category::whereNull('parent_id')
        ->where('status', 'active')
        ->with([
            'direct_childs' => function ($q) {
                $q->where('status', 'active');
            }
        ])
        ->get();
    $premiumMenuCategories = \App\Models\Category::where('is_premium', 1)
        ->with('direct_childs')
        ->orderBy('name')
        ->get();

    use Illuminate\Support\Facades\Auth;

    $miniCart = null;
    $miniCartItems = collect();
    $cartCount = 0;
    $cartTotal = 0;

    if (Auth::guard('customer')->check()) {

        // ✅ Logged user cart
        $miniCart = \App\Models\Cart::with('cart_details.product_options', 'cart_details.products')
            ->where('customer_id', Auth::guard('customer')->id())
            ->first();

    } else {

        // ✅ Guest cart using device_id
        $deviceId = session('device_id');

        if ($deviceId) {
            $miniCart = \App\Models\UnAuthCart::with('cart_details.product_options', 'cart_details.products')
                ->where('device_id', $deviceId)
                ->first();
        }
    }

    if ($miniCart) {
        $miniCartItems = $miniCart->cart_details;
        $cartCount = $miniCartItems->sum('quantity');
        $cartTotal = $miniCart->total_price_after_discount ?? 0;
    }

@endphp

<body data-spy="scroll">
    <div class="wrapper ovh">
        <!--<div class="preloader"></div>-->

        <!-- header middle start-->
        <div class="header_middle  dn-992" style="padding:5px 0px;">
            <div class="container">
                <div class="row" style="align-items: center;">
                    <div class="col-lg-2 col-xxl-2">
                        <div class="header_top_logo_home1">
                            <div class="logo">
                                <a href="{{ url('/') }}">
                                    <img src="{{ $settings->header_logo ? asset('storage/' . $settings->header_logo) : 'https://izharsonperfumers.com/admin-login/storage/logo/awQrarVaGtUQtwtFSSNi78JDai2I5TQH7VIBThZE.png' }}"
                                        style="border-radius: 7px; height: 70px;" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xxl-6">
                        <div class="header_middle_advnc_search">
                            <div class="search_form_wrapper">
                                <div class="row">
                                    <div class="col-auto pr0" style="display:flex; align-items:center;">
                                        <div class="actegory">
                                            <select class="selectpicker" id="selectbox_alCategory" name="category">
                                                <option value="">All Categories</option>

                                                @foreach($menuCategories as $category)
                                                    <option value="{{ $category->slug }}">
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-auto p0">
                                        <div class="top-search">
                                            <form action="#" method="GET" class="form-search">
                                                <div class="box-search pre_line">
                                                    <input class="form_control" type="text" name="q" id="searchInput"
                                                        placeholder="Search products…" autocomplete="off">
                                                    <div class="search-suggestions">
                                                        <div class="box-suggestions">
                                                            <ul id="suggestionList"></ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-auto p0">
                                        <div class="advscrh_frm_btn">
                                            <button type="button" class="btn search-btn" id="searchBtn"><span
                                                    class="flaticon-search"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xxl-4 pr0-lg">
                        <div class="hm_log_fav_cart_widget justify-content-center">
                            <div class="wrapper">
                                <ul class="mb0">
                                    <li class="list-inline-item"><a class="header_top_iconbox"
                                            href="{{ route('customer.wishlist') }}">
                                            <div class="d-block d-md-flex">
                                                <div class="icon"><span class="flaticon-heart"></span></div>
                                                <div class="details">
                                                    <p class="subtitle">Wishlist</p>
                                                    <h5 class="title">My Items</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="list-inline-item">

                                        @auth('customer')
                                            {{-- Logged in → go to dashboard --}}
                                            <a class="header_top_iconbox" href="{{ route('customer.account-details') }}">
                                        @else
                                                {{-- Guest → open sidebar login --}}
                                                <a class="header_top_iconbox signin-filter-btn" href="#">
                                            @endauth

                                                <div class="d-block d-md-flex">
                                                    <div class="icon">
                                                        <span class="flaticon-profile"></span>
                                                    </div>
                                                    <div class="details">
                                                        @auth('customer')
                                                            <p class="subtitle">Welcome</p>
                                                            <h5 class="title">{{ auth('customer')->user()->name }}</h5>
                                                        @else
                                                            <p class="subtitle">Sign In</p>
                                                            <h5 class="title">Account</h5>
                                                        @endauth
                                                    </div>
                                                </div>
                                            </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="header_top_iconbox cart-filter-btn" href="{{ route('cart.index') }}">
                                            <div class="d-block d-md-flex">

                                                <div class="icon position-relative">
                                                    <span>
                                                        <img src="{{ asset('front/images/shopping-cart.png') }}"
                                                            style="width:20px;" alt="">
                                                    </span>

                                                    <span class="badge" id="cart-count">
                                                        {{ $cartCount }}
                                                    </span>
                                                </div>

                                                <div class="details">
                                                    <p class="subtitle" id="cart-total">
                                                        ₹{{ number_format($cartTotal, 2) }}
                                                    </p>
                                                    <h5 class="title">Total</h5>
                                                </div>

                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header middle end-->


        <!-- Main Header Nav Start -->
        <header class="header-nav menu_style_home_one main-menu">
            <nav class="posr">
                <div class="container posr menu_bdrt1">
                    <div class="menu-toggle">
                        <button type="button" id="menu-btn"> <span class="icon-bar"></span> <span
                                class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    </div>
                    <div class="posr logo1 home1_style">
                        <div id="mega-menu"> <a class="btn-mega" href="{{ url('/') }}"> <img class="me-2"
                                    src="{{ asset('front/images/desktop-nav-menu-white.svg') }}"
                                    alt="Desktop Menu Icon"> <span class="fw500 fz16 color-white vam">Browse
                                    Categories</span> </a>

                            <ul class="menu">

                                <li>
                                    <a class="dropdown" href="#">
                                        <span class="menu-icn flaticon-diamond"></span>
                                        <span class="menu-title">All Categories</span>
                                    </a>

                                    @if($menuCategories->count())
                                        <div class="drop-menu">

                                            @foreach($menuCategories as $category)
                                                <div class="one-third">

                                                    {{-- Category Title --}}
                                                    <div class="cat-title">{{ $category->name }}</div>

                                                    <ul class="mb0">
                                                        @foreach($category->direct_childs as $sub)
                                                            <li>
                                                                <a
                                                                    href="{{ route('shop.category', [$category->slug, $sub->slug])  }}">
                                                                    {{ $sub->name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>

                                                </div>
                                            @endforeach

                                        </div>
                                    @endif
                                </li>
                                @foreach($menuCategories as $category)

                                    <li>
                                        <a class="{{ $category->direct_childs->count() ? 'dropdown' : '' }}"
                                            href="{{ route('shop.category', $category->slug)  }}">
                                            <span class="menu-icn flaticon-diamond"></span>
                                            <span class="menu-title">{{ $category->name }}</span>
                                        </a>

                                        {{-- SHOW DROPDOWN ONLY IF CHILD EXISTS --}}
                                        @if($category->direct_childs->count())
                                            <div class="drop-menu">

                                                @foreach($category->direct_childs->chunk(6) as $chunk)
                                                    <div class="one-third">
                                                        <!-- <div class="cat-title">{{ $category->name }}</div> -->
                                                        <ul class="mb0">
                                                            @foreach($chunk as $sub)
                                                                <li>
                                                                    <a
                                                                        href="{{ route('shop.category', [$category->slug, $sub->slug])  }}">
                                                                        {{ $sub->name }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endforeach

                                            </div>
                                        @endif

                                    </li>

                                @endforeach

                            </ul>
                        </div>
                    </div>

                    <ul id="respMenu" class="ace-responsive-menu menu_list_custom_code wa pl200"
                        data-menu-style="horizontal">

                        @foreach($premiumMenuCategories as $category)

                            <li class="visible_list">
                                <a href="{{ route('shop.category', $category->slug)  }}">
                                    <span class="title">{{ $category->name }}</span>
                                </a>

                                {{-- show dropdown ONLY if subcategories exist --}}
                                @if($category->direct_childs->count())
                                    <ul>
                                        @foreach ($category->direct_childs as $child)
                                            <li>
                                                <a href="{{ route('shop.category', [$category->slug, $child->slug]) }}">
                                                    {{ $child->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                            </li>

                        @endforeach

                    </ul>

                    <ul id="respMenu2" class="ace-responsive-menu widget_menu_home2 wa" data-menu-style="horizontal">

                        <li><a href="{{ route('about') }}">About Us</a></li>

                        <li class="list-inline-item list_c">
                            <a href="{{ route('faq') }}">Faq</a>
                        </li>

                        <li class="list-inline-item list_c">
                            <a href="{{ route('blogs') }}">Blogs & Article</a>
                        </li>

                        <li class="list-inline-item list_c">
                            <a href="{{ route('contact') }}">Contact Us</a>
                        </li>

                        <li class="list-inline-item list_c">
                            <a href="{{ route('feedback') }}">Feedback</a>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!-- Main Header Nav Start -->

        <!-- Body Ovelay Behind Sidebar -->
        <div class="hiddenbar-body-ovelay"></div>

        <!-- Sign In Hiddn SideBar -->
        <div class="signin-hidden-sbar">
            <div class="hsidebar-header">
                <div class="sidebar-close-icon"><span class="flaticon-close"></span></div>
                <h4 class="title">Sign-In</h4>
            </div>

            <div class="hsidebar-content">
                <div class="log_reg_form sidebar_area">

                    {{-- Success --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- Errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    <div class="login_form">

                        <form method="POST" action="{{ route('customer.login') }}">
                            @csrf

                            <div class="mb-2 mr-sm-2">
                                <label class="form-label">Username or email address</label>
                                <input type="text" name="email" class="form-control" placeholder="Enter email"
                                    value="{{ old('email') }}" required>
                            </div>

                            <div class="form-group mb5">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                    required>
                            </div>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" class="custom-control-input"
                                    id="sidebarRemember">
                                <label class="custom-control-label" for="sidebarRemember">
                                    Remember me
                                </label>

                                <a class="btn-fpswd float-end" href="{{ route('customer.password.request') }}">
                                    Lost your password?
                                </a>
                            </div>

                            <button type="submit" class="btn btn-log btn-thm mt20">
                                Login
                            </button>

                            <p class="text-center mb25 mt10">
                                Don't have an account?
                                <a class="signup-filter-btn" href="#">Create account</a>
                            </p>

                            <div class="hr_content">
                                <hr>
                                <span class="hr_top_text">or</span>
                            </div>

                            <ul class="login_with_social text-center mt30 mb0">
                                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i></a></li>
                                <li class="list-inline-item">
                                    <a href="{{ route('customer.google.login') }}">
                                        <i class="fab fa-google"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-x-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-apple"></i></a></li>
                            </ul>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--End Sign In Hiddn SideBar -->
        <!-- Your Cart Hiddn SideBar -->

        <div class="cart-hidden-sbar">
            <div class="hsidebar-header">
                <div class="sidebar-close-icon"><span class="flaticon-close"></span></div>
                <h4 class="title">Your Cart</h4>
            </div>
            <div class="hsidebar-content">
                <div class="log_fav_cart_widget hsidebar_home_page">
                    <div class="wrapper">
                        <ul class="cart">
                            <li class="list-inline-item">
                                <ul class="cart">
                                    <li class="list-inline-item">
                                        <ul class="dropdown_content" id="mini-cart-items">

                                            @if($miniCartItems->count())

                                                @foreach($miniCartItems as $item)
                                                    <li class="list_content">
                                                        <div>
                                                            <img class="float-start mt10"
                                                                src="{{ asset('storage/' . ($item->product_options->image ?? $item->products->image)) }}"
                                                                width="60">

                                                            <p>{{ $item->products->name }}</p>

                                                            <div class="cart_btn home_page_sidebar mt10">

                                                                <div class="quantity-block home_page_sidebar">

                                                                    <button
                                                                        class="quantity-arrow-minus mini-minus home_page_sidebar"
                                                                        data-id="{{ $item->id }}">
                                                                        <img src="{{ asset('front/images/icons/minus.svg') }}">
                                                                    </button>

                                                                    <input class="quantity-num home_page_sidebar qty-input"
                                                                        type="number" value="{{ $item->quantity }}"
                                                                        data-id="{{ $item->id }}" min="1">

                                                                    <button
                                                                        class="quantity-arrow-plus mini-plus home_page_sidebar"
                                                                        data-id="{{ $item->id }}">
                                                                        <span class="flaticon-close"></span>
                                                                    </button>
                                                                </div>
                                                                <span class="home_page_sidebar price">
                                                                    ₹{{ number_format($item->product_options->price * $item->quantity, 2) }}
                                                                </span>

                                                            </div>

                                                            <span class="close_icon remove-mini-item" data-id="{{ $item->id }}">
                                                                <i class="flaticon-close"></i>
                                                            </span>

                                                        </div>
                                                    </li>
                                                @endforeach

                                                <li class="list_content_total_price">
                                                    <h5>
                                                        Total:
                                                        <span class="total_price float-end" id="mini-cart-total">
                                                            ₹{{ number_format($miniCart->total_price_after_discount ?? 0, 2) }}
                                                        </span>
                                                    </h5>
                                                </li>

                                            @else

                                                <li class="list_content text-center py-4">
                                                    Your cart is empty
                                                </li>

                                            @endif

                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="hsidebar_footer_content">
                <div class="list_last_content">
                    <div class="lc">
                        <p class="para">Buy ₹98.00 more to enjoy FREE Shipping</p>
                        <div class="uilayout_range home1_style">
                            <div class="sidebar_range_slider mb30 mt25">
                                <input class="range-example-km" value="80" type="text">
                            </div>
                        </div>
                        <a href="{{ route('cart.index') }}" class="cart_btns btn btn-white">
                            View Cart
                        </a>

                        @if(Auth::guard('customer')->check())
                            <a href="{{ route('checkout') }}" class="checkout_btns btn btn-thm">
                                Checkout
                            </a>
                        @else
                            <a href="{{ route('customer.login') }}" class="checkout_btns btn btn-thm">
                                Login to Checkout
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--End Your Cart Hiddn SideBar -->
        <!-- Sign Up Hiddn SideBar -->
        <div class="signup-hidden-sbar">
            <div class="hsidebar-header">
                <div class="sidebar-close-icon"><span class="flaticon-close"></span></div>
                <h4 class="title">Create Your Account</h4>
            </div>

            <div class="hsidebar-content">
                <div class="log_reg_form sidebar_area">

                    {{-- Success --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- Errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    <div class="sign_up_form">

                        <form method="POST" action="{{ route('customer.register') }}">
                            @csrf

                            <div class="form-group">
                                <label class="form-label">Your Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                    placeholder="Enter name" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Your Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                    placeholder="example@email.com" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Contact Number</label>
                                <input type="text" name="mobile_number" class="form-control"
                                    value="{{ old('mobile_number') }}" placeholder="Enter mobile number" required>
                            </div>

                            <div class="form-group mb20">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="********"
                                    required>
                            </div>

                            <div class="form-group mb20">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="********" required>
                            </div>

                            <button type="submit" class="btn btn-signup btn-thm">
                                Create Account
                            </button>

                            <p class="text-center mb25 mt10">
                                Already have an account?
                                <a class="signin-filter-btn" href="#">Sign in</a>
                            </p>

                            <div class="hr_content">
                                <hr>
                                <span class="hr_top_text">or</span>
                            </div>

                            <ul class="login_with_social text-center mt30 mb0">
                                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i></a></li>
                                <li class="list-inline-item">
                                    <a href="{{ route('customer.google.login') }}">
                                        <i class="fab fa-google"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-x-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-apple"></i></a></li>
                            </ul>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--End Sign Up Hiddn SideBar -->

        <!-- Main Header Nav For Mobile -->
        <div id="page" class="stylehome1">
            <div class="mobile-menu">
                <div class="header stylehome1">
                    <div class="menu_and_widgets">
                        <div class="mobile_menu_bar float-start">

                            <!-- MENU TOGGLE -->
                            <a class="menubar" href="#menu">
                                <span></span>
                            </a>

                            <!-- MOBILE LOGO -->
                            <a class="mobile_logo" href="{{ url('/') }}">
                                <img src="{{ $settings->header_logo ? asset('storage/' . $settings->header_logo) : asset('front/images/logo.png') }}"
                                    alt="logo" style="height:50px;">
                            </a>

                        </div>
                        <div class="mobile_menu_widget_icons">
                            <ul class="cart mt15">
                                <li class="list-inline-item"> <a class="cart_btn signin-filter-btn" href="#"><span
                                            class="icon flaticon-profile"></span></a> </li>
                                <li class="list-inline-item"> <a class="cart_btn cart-filter-btn" href="#"><span
                                            class="icon"><img src="{{ asset('front/images/shopping-cart.png') }}" alt=""
                                                style="width:22px;"></span><span class="badge bgc-thm">2</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mobile_menu_search_widget">
                        <div class="header_middle_advnc_search">
                            <div class="container search_form_wrapper">
                                <div class="row">
                                    <div>
                                        <div class="top-search text-start">
                                            <form action="#" method="get" class="form-search" accept-charset="utf-8">
                                                <div class="box-search">
                                                    <input class="form_control" type="text" id="mobileSearchInput"
                                                        placeholder="Search products…" autocomplete="off">

                                                    <div class="search-suggestions text-start">
                                                        <div class="box-suggestions">
                                                            <ul id="mobileSuggestionList"></ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="advscrh_frm_btn">
                                            <button type="button" class="btn search-btn" id="mobileSearchBtn"><span
                                                    class="flaticon-search"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="posr">
                        <div class="mobile_menu_close_btn"><span class="flaticon-close"></span></div>
                    </div>
                </div>
            </div>
            <!-- /.mobile-menu -->
            <nav id="menu" class="stylehome1">
                <ul>
                    <li>
                        <a href="{{ url('/') }}">Home</a>
                    </li>

                    {{-- SHOP --}}
                    <li>
                        <a href="{{ route('shop.category') }}">Shop</a>
                    </li>
                    <li class="title my-3 bb1 pl20 fz20 fw500 pb-3">Categories</li>
                    @foreach ($menuCategories as $category)
                        <li>
                            <span><i class="flaticon-cooking mr20"></i><a
                                    href="{{ route('shop.category', $category->slug)  }}">{{ $category->name }}</a></span>
                            @if ($category->direct_childs->count() > 0)
                                <ul>
                                    @foreach($category->direct_childs as $sub)
                                        <li>
                                            <a href="{{ route('shop.category', [$category->slug, $sub->slug])  }}">
                                                {{ $sub->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                            @endif
                        </li>

                    @endforeach
                    <hr class="mt-4 mb-3">

                    <li><a href="{{ route('about') }}">About Us</a></li>

                    <li class="list-inline-item list_c">
                        <a href="{{ route('faq') }}">Faq</a>
                    </li>

                    <li class="list-inline-item list_c">
                        <a href="{{ route('blogs') }}">Blogs & Article</a>
                    </li>

                    <li class="list-inline-item list_c">
                        <a href="{{ route('contact') }}">Contact Us</a>
                    </li>

                    <li class="list-inline-item list_c">
                        <a href="{{ route('feedback') }}">Feedback</a>
                    </li>
                    <!-- Only for Mobile View -->
                </ul>
            </nav>

        </div>


        <div class="body_content_wrapper position-relative">


            @yield('content')
            <!-- ================= MOBILE STICKY FOOTER ================= -->
            <div class="newiz-mobile-footer d-block d-xl-none">

                <!-- Guest User -->
                @guest
                    <ul class="newiz-footer-menu">
                        <li>
                            <a href="{{ url('/') }}">
                                <i class="fas fa-home"></i>
                                <span>Home</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('customer.wishlist') }}">
                                <i class="far fa-heart"></i>
                                <span>Wishlist</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('shop.category') }}">
                                <i class="fas fa-th-large"></i>
                                <span>Categories</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Cart</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('login') }}">
                                <i class="far fa-user"></i>
                                <span>Login</span>
                            </a>
                        </li>
                    </ul>
                @endguest


                <!-- Logged In User -->
                @auth
                    <ul class="newiz-footer-menu">
                        <li>
                            <a href="{{ url('/') }}">
                                <i class="fas fa-home"></i>
                                <span>Home</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('customer.wishlist') }}">
                                <i class="far fa-heart"></i>
                                <span>Wishlist</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('shop.category') }}">
                                <i class="fas fa-th-large"></i>
                                <span>Categories</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Cart</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('customer.account-details') }}">
                                <i class="fas fa-user-circle"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                @endauth

            </div>

            <!-- Our Footer -->
            <section class=" home1 bdrt1 p-0">
                <div class="container pb60">
                    <!--<div class="row">-->
                    <!--    <div class="col-lg-6 offset-lg-3">-->
                    <!--        <div class="mailchimp_widget mb30-md text-center">-->
                    <!--            <div class="icon float-start"><span class="flaticon-email-1"></span></div>-->
                    <!--            <div class="details">-->
                    <!--                <h3 class="title">Subscribe and get 20% discount.</h3>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="footer_social_widget">-->
                    <!--            <form id="subscribeForm" class="footer_mailchimp_form">-->
                    <!--                @csrf-->
                    <!--                <div class="row align-items-center">-->
                    <!--                    <div class="col-auto">-->
                    <!--                        <input type="email" name="email" class="form-control"-->
                    <!--                            placeholder="Your email address" required>-->
                    <!--                        <button class="ms-sm-2 btn-thm" type="submit">Subscribe</button>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </form>-->

                    <!--            <div id="subscribeMsg" style="margin-top:8px;"></div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="row mt60">
                        <div class="col-sm-6 col-md-5 col-lg-3 col-xl-3">
                            <div class="footer_contact_widget">
                                <h4 class="mb-3">Contact Us</h4>
                                <div class="footer_contact_iconbox d-flex mb-2">
                                    <div class="icon"><span class="flaticon-location"></span></div>
                                    <div class="details ms-4">

                                        <a href="#">{{ $settings->address }}</a>
                                    </div>
                                </div>
                                <div class="footer_contact_iconbox d-flex mb-2">
                                    <div class="icon"><span class="flaticon-phone-call"></span></div>
                                    <div class="details ms-4">
                                        <h5 class="title">Monday-Friday: 08am-9pm</h5>
                                        <a href="#">{{ $settings->tollfree_number }}</a>
                                    </div>
                                </div>
                                <div class="footer_contact_iconbox d-flex">
                                    <div class="icon"><span class="flaticon-email"></span></div>
                                    <div class="details ms-4">
                                        <h5 class="title">Need help with your order?</h5>
                                        <a href="#">{{ $settings->email }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-2 col-xl-2">
                            <div class="footer_qlink_widget">
                                <h4>Popular Categories</h4>
                                <ul class="list-unstyled">
                                    @foreach ($premiumMenuCategories as $category)
                                        <li><a
                                                href="{{ route('shop.category', $category->slug) }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-2 col-xl-2">
                            <div class="footer_qlink_widget">
                                <h4>About Izharson</h4>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route(name: 'contact') }}">Contact Us</a></li>
                                    <li><a href="{{ route('about') }}">About Us</a></li>
                                    <li><a href="{{ route('faq') }}">FAQ</a></li>
                                    <li><a href="{{ route('blogs') }}">Blog & Articles</a></li>
                                    <li><a href="{{ route('feedback') }}">Feedback</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-2 col-xl-2">
                            <div class="footer_qlink_widget">
                                <h4>Policies</h4>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('terms-conditions') }}">Terms & Conditions</a></li>
                                    <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ route('refund-policy') }}">Refund & Cancellation</a></li>
                                    <li><a href="{{ route('cookie-policy') }}">Cookie Policy</a></li>
                                    <li><a href="{{ route('shipping-policy') }}">Shipping Policy</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-5 col-lg-3 col-xl-3">
                            <div class="footer_social_widget">
                                <h4 class="title">Follow us</h4>
                                <div class="social_icon_list mt30">
                                    <ul class="mb20">
                                        <li class="list-inline-item"><a href="{{ $socialLinks->fb_name }}"><i
                                                    class="fab fa-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="{{ $socialLinks->twit_name }}"><i
                                                    class="fab fa-x-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="{{ $socialLinks->insta_name }}"><i
                                                    class="fab fa-instagram"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="{{ $socialLinks->linkedin_name }}"><i
                                                    class="fab fa-linkedin-in"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="{{ $socialLinks->youtube_name }}"><i
                                                    class="fab fa-youtube"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a
                                                href="https://wa.me/{{ $settings->whatsapp_number }}" target="_blank"><i
                                                    class="fab fa-whatsapp"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="footer_acceped_card_widget">
                                <h4 class="title mb20">We accept</h4>
                                <div class="acceped_card_list">
                                    <ul class="d-flex mb-0">
                                        <li class="me-2"><a href="#"><img
                                                    src="{{ asset('front/images/resource/visa-card.png') }}"
                                                    alt="visa-card"></a></li>
                                        <li class="me-2"><a href="#"><img
                                                    src="{{ asset('front/images/resource/master-card.png') }}"
                                                    alt="master-card"></a></li>
                                        <li class="me-2"><a href="#"><img
                                                    src="{{ asset('front/images/resource/apple-pay.png') }}"
                                                    alt="apple-pay"></a></li>
                                        <li class="me-2"><a href="#"><img
                                                    src="{{ asset('front/images/resource/discover-card.png') }}"
                                                    alt="discover-card"></a>
                                        </li>
                                        <li class="me-2"><a href="#"><img
                                                    src="{{ asset('front/images/resource/paypal.png') }}"
                                                    alt="paypal"></a>
                                        </li>
                                        <li><a href="#"><img src="{{ asset('front/images/resource/amex-card.png') }}"
                                                    alt="amex-card"></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container bdrt1 pt20 pb20">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="copyright-widget text-center text-lg-start d-block d-lg-flex mb15-md">
                                <p class="me-4">© 2025 Izharson Perfumers. All Rights Reserved</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <a class="scrollToHome" href="#"><i class="fas fa-angle-up"></i></a>
        </div>

    </div>
    <!-- Wrapper End -->
    <script src="{{ asset('front/js/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('front/js/jquery-migrate-3.0.0.min.js') }}"></script>

    <!-- Magnific Popup -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

    <script src="{{ asset('front/js/popper.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.mmenu.all.js') }}"></script>
    <script src="{{ asset('front/js/ace-responsive-menu.js') }}"></script>
    <script src="{{ asset('front/js/jquery-scrolltofixed-min.js') }}"></script>
    <script src="{{ asset('front/js/wow.min.js') }}"></script>
    <script src="{{ asset('front/js/slider.js') }}"></script>
    <script src="{{ asset('front/js/swiper-slider.js') }}"></script>
    <!-- Custom script for all pages -->
    <script src="{{ asset('front/js/script.js') }}"></script>
    <script src="{{ asset('front/js/isotop.js') }}"></script>
    <script src="{{ asset('front/js/parallax.js') }}"></script>
    <script src="{{ asset('front/js/wow.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.ez-plus.js') }}"></script>
    <script src="{{ asset('front/js/scrollbalance.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAz77U5XQuEME6TpftaMdX0bBelQxXRlM&callback=initMap"></script>
    <script src="{{ asset('front/js/googlemaps1.js') }}"></script>
    <!-- Custom script for all pages -->
    <script>
        $(document).ready(function () {
            var scroll_childs = $('.scroll-to-fixed-child');
            for (var i = 0, length = scroll_childs.length; i < length; i++) {
                var scroll_child = $(scroll_childs[i]);

                scroll_child.scrollToFixed({
                    marginTop: $('header').outerHeight(true) + 10,
                    zIndex: 2,
                    spacerClass: 'd-none',
                    removeOffsets: true,
                    limit: function () {
                        var parent = this.parents('.scroll-to-fixed-parent');
                        return parent.offset().top + parent.outerHeight(true) - this.outerHeight(true) - 20;

                    }
                });
            }
        });

        const shopURL = "{{ route('shop.category') }}"; // main listing page

        // search suggestions for desktop
        document.getElementById('searchInput').addEventListener('keyup', function () {

            let query = this.value;

            fetch(`/search-suggestions?q=${query}`)
                .then(res => res.json())
                .then(data => {

                    let html = '';

                    data.forEach(product => {
                        html += `
<li>
    <a href="/product-details/${product.slug}" class="d-flex align-items-center">
        <div class="thumb">
            <img src="/storage/${product.image}" alt="${product.name}">
        </div>
        <div class="info-product">
            <div class="item_title">${product.name}</div>
            <div class="price">
                <span class="sale">
                    ₹${product.product_options[0]?.price ?? product.min_price}
                </span>
            </div>
        </div>
    </a>
</li>
            `;
                    });

                    document.getElementById('suggestionList').innerHTML = html;
                });
        });

        // search button click
        document.getElementById("searchBtn").addEventListener("click", performSearch);

        // perform search on submit
        function performSearch() {
            let query = document.getElementById("searchInput").value.trim();
            let categorySlug = document.getElementById("selectbox_alCategory").value;

            let params = new URLSearchParams();

            if (query) params.append("q", query);

            let url = shopURL;

            if (categorySlug) {
                url += "/" + categorySlug;   // add slug to URL
            }

            if (params.toString()) {
                url += "?" + params.toString();
            }

            window.location.href = url;
        }

        /* ================= MOBILE SEARCH SUGGESTIONS ================= */

        const mobileInput = document.getElementById('mobileSearchInput');
        const mobileList = document.getElementById('mobileSuggestionList');

        if (mobileInput) {

            mobileInput.addEventListener('keyup', function () {

                let query = this.value;

                if (query.length < 2) {
                    mobileList.innerHTML = '';
                    return;
                }

                fetch(`/search-suggestions?q=${query}`)
                    .then(res => res.json())
                    .then(data => {

                        let html = '';

                        data.forEach(product => {
                            html += `
<li>
    <a href="/product-details/${product.slug}" class="d-flex align-items-center">
        <div class="thumb">
            <img src="/storage/${product.image}" alt="${product.name}">
        </div>
        <div class="info-product">
            <div class="item_title">${product.name}</div>
            <div class="price">
                <span class="sale">
                    ₹${product.product_options[0]?.price ?? product.min_price}
                </span>
            </div>
        </div>
    </a>
</li>`;
                        });

                        mobileList.innerHTML = html;
                    });
            });

            /* MOBILE SEARCH BUTTON */
            document.getElementById("mobileSearchBtn").addEventListener("click", function () {
                let query = mobileInput.value.trim();
                if (!query) return;
                window.location.href = shopURL + "?q=" + query;
            });

            /* ENTER KEY SEARCH */
            mobileInput.addEventListener("keypress", function (e) {
                if (e.key === "Enter") {
                    window.location.href = shopURL + "?q=" + mobileInput.value.trim();
                }
            });

        }


        // newsletter subscription
        document.getElementById("subscribeForm").addEventListener("submit", function (e) {
            e.preventDefault();
            let form = this;
            let email = form.querySelector("input[name='email']").value;
            let msgBox = document.getElementById("subscribeMsg");

            fetch("{{ route('subscribe') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ email: email })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.status) {
                        msgBox.innerHTML = "<span style='color:green'>" + data.message + "</span>";
                        form.reset();
                    } else {
                        msgBox.innerHTML = "<span style='color:red'>" + data.message + "</span>";
                    }
                })
                .catch(err => {
                    msgBox.innerHTML = "<span style='color:red'>Something went wrong</span>";
                });
        });

    </script>
    <script>
        if (!localStorage.getItem("device_id")) {
            localStorage.setItem("device_id", "dev-" + Date.now() + "-" + Math.random());
        }

        // send device id to session once
        fetch("{{ route('device.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                device_id: localStorage.getItem("device_id")
            })
        });

        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // close dropdown if user clicks outside
        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn')) {

                const dropdowns = document.getElementsByClassName("dropdown-content");

                for (let i = 0; i < dropdowns.length; i++) {
                    let openDropdown = dropdowns[i];

                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }


        document.addEventListener("click", function (e) {

            if (e.target.closest(".remove-mini-item")) {

                const btn = e.target.closest(".remove-mini-item");
                const id = btn.dataset.id;

                btn.style.opacity = "0.4";

                fetch("/cart/remove/" + id, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                    .then(() => refreshMiniCart());
            }

        });
        document.addEventListener("click", function (e) {

            // ➕ increase quantity (mini cart)
            if (e.target.closest(".mini-plus")) {

                const button = e.target.closest("button");
                const id = button.dataset.id;

                button.style.opacity = "0.5";

                fetch("/cart/update/" + id, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ change: 1 })
                })
                    .then(() => refreshMiniCart())
                    .finally(() => button.style.opacity = "1");

            }

            // ➖ decrease quantity (mini cart)
            if (e.target.closest(".mini-minus")) {

                const button = e.target.closest("button");
                const id = button.dataset.id;

                button.style.opacity = "0.5";

                fetch("/cart/update/" + id, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ change: -1 })
                })
                    .then(() => refreshMiniCart())
                    .finally(() => button.style.opacity = "1");

            }

        });

        function refreshMiniCart() {
            fetch("{{ route('mini.cart') }}")
                .then(res => res.json())
                .then(data => {

                    // update cart badge
                    document.getElementById("cart-count").innerText = data.count;
                    document.getElementById("cart-total").innerText = "₹" + parseFloat(data.total).toFixed(2);

                    let html = '';

                    if (data.items.length === 0) {
                        html = `<li class="list_content text-center py-4">Your cart is empty</li>`;
                    }
                    else {

                        data.items.forEach(item => {

                            const image = item.product_options?.image ?? item.products.image;
                            const price = (item.product_options?.price ?? item.products.price ?? 0) * item.quantity;

                            html += `
<li class="list_content">
<div>
<img class="float-start mt10" src="/storage/${image}" width="60">

<p>${item.products.name}</p>

<div class="cart_btn home_page_sidebar mt10">

<div class="quantity-block home_page_sidebar">

<button class="quantity-arrow-minus mini-minus" data-id="${item.id}">
<img src="/front/images/icons/minus.svg">
</button>

<input class="quantity-num home_page_sidebar qty-input"
type="number"
value="${item.quantity}"
data-id="${item.id}"
min="1">

<button class="quantity-arrow-plus mini-plus" data-id="${item.id}">
<span class="flaticon-close"></span>
</button>

</div>

<span class="home_page_sidebar price">
₹${price.toFixed(2)}
</span>

</div>

<span class="close_icon remove-mini-item" data-id="${item.id}">
<i class="flaticon-close"></i>
</span>

</div>
</li>
`;
                        });

                        html += `
<li class="list_content_total_price">
<h5>
Total:
<span id="mini-cart-total" class="float-end">
₹${parseFloat(data.total).toFixed(2)}
</span>
</h5>
</li>
`;
                    }

                    const msg = document.querySelector(".hsidebar_footer_content .para");

                    if (data.free_shipping_remaining > 0) {

                        msg.innerText = `Buy ₹${data.free_shipping_remaining.toFixed(2)} more to enjoy FREE Shipping`;

                    } else {

                        msg.innerText = "🎉 Congratulations! You unlocked FREE Shipping";

                    }
                    document.getElementById("mini-cart-items").innerHTML = html;

                });
        }
    </script>
</body>

</html>