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

    // temporary user (replace with auth later)
    $user = \App\Models\Customer::find(284);
    $miniCart = null;
    $miniCartItems = collect();
    $cartCount = 0;
    $cartTotal = 0;
    if ($user) {
        $miniCart = \App\Models\Cart::with('cart_details.product_options', 'cart_details.products')
            ->where('customer_id', $user->id)
            ->first();

        if ($miniCart) {
            $miniCartItems = $miniCart->cart_details;
            $cartCount = $miniCart->items_count ?? 0;
            $cartTotal = $miniCart->total_price_after_discount ?? 0;
        }
    }

@endphp

<body data-spy="scroll">
    <div class="wrapper ovh">
        <div class="preloader"></div>

        <!-- header middle start-->
        <div class="header_middle pt20 pb20 dn-992">
            <div class="container">
                <div class="row" style="align-items: center;">
                    <div class="col-lg-2 col-xxl-2">
                        <div class="header_top_logo_home1">
                            <div class="logo"><img
                                    src="{{ $settings->header_logo ? asset('storage/' . $settings->header_logo) : 'https://izharsonperfumers.com/admin-login/storage/logo/awQrarVaGtUQtwtFSSNi78JDai2I5TQH7VIBThZE.png' }}"
                                    style="border-radius: 7px; height: 60px;" /></div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xxl-6">
                        <div class="header_middle_advnc_search">
                            <div class="search_form_wrapper">
                                <div class="row">
                                    <div class="col-auto pr0">
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
                                            href="{{ route('wishlist') }}">
                                            <div class="d-block d-md-flex">
                                                <div class="icon"><span class="flaticon-heart"></span></div>
                                                <div class="details">
                                                    <p class="subtitle">Wishlist</p>
                                                    <h5 class="title">My Items</h5>
                                                </div>
                                            </div>
                                        </a> </li>
                                    <li class="list-inline-item"><a class="header_top_iconbox signin-filter-btn"
                                            href="#">
                                            <div class="d-block d-md-flex">
                                                <div class="icon"><span class="flaticon-profile"></span></div>
                                                <div class="details">
                                                    <p class="subtitle">Sign In</p>
                                                    <h5 class="title">Account</h5>
                                                </div>
                                            </div>
                                        </a> </li>

                                    <li class="list-inline-item">
                                        <a class="header_top_iconbox cart-filter-btn" href="{{ route('cart.index') }}">
                                            <div class="d-block d-md-flex">

                                                <div class="icon position-relative">
                                                    <span>
                                                        <img src="{{ asset('front/images/shopping-cart.png') }}"
                                                            style="width:20px;" alt="">
                                                    </span>

                                                    <span class="badge">
                                                        {{ $cartCount }}
                                                    </span>
                                                </div>

                                                <div class="details">
                                                    <p class="subtitle">
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
                        <div id="mega-menu"> <a class="btn-mega" href="#"> <img class="me-2"
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
                                                                <a href="{{ url($sub->slug) }}">
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
                                            href="{{ url($category->slug) }}">
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
                                                                    <a href="{{ url($sub->slug) }}">
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
                                <a href="{{ url($category->slug) }}">
                                    <span class="title">{{ $category->name }}</span>
                                </a>

                                {{-- show dropdown ONLY if subcategories exist --}}
                                @if($category->direct_childs->count())
                                    <ul>
                                        @foreach ($category->direct_childs as $child)
                                            <li>
                                                <a href="{{ url($child->slug) }}">
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
                    <div class="login_form">
                        <form action="#">
                            <div class="mb-2 mr-sm-2">
                                <label class="form-label">Username or email address</label>
                                <input type="text" class="form-control" placeholder="Ali Tufan">
                            </div>
                            <div class="form-group mb5">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="exampleCheck3">
                                <label class="custom-control-label" for="exampleCheck3">Remember me</label>
                                <a class="btn-fpswd float-end" href="#">Lost your password?</a>
                            </div>
                            <button type="submit" class="btn btn-log btn-thm mt20">Login</button>
                            <p class="text-center mb25 mt10">Don't have an account? <a class="signup-filter-btn"
                                    href="#">Create
                                    account</a></p>
                            <div class="hr_content">
                                <hr>
                                <span class="hr_top_text">or</span>
                            </div>
                            <ul class="login_with_social text-center mt30 mb0">
                                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-google"></i></a></li>
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
                                        <ul class="dropdown_content">

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
                                                                       <span
                                                                            class="flaticon-close"></span>
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
                                                        <span class="total_price float-end">
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

                        <a href="{{ route('checkout') }}" class="checkout_btns btn btn-thm">
                            Checkout
                        </a>
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
                    <div class="sign_up_form">
                        <form action="#">
                            <div class="form-group">
                                <label class="form-label">Your Name</label>
                                <input type="text" class="form-control" placeholder="Ali Tufan">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" placeholder="alitfn">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Your Email</label>
                                <input type="email" class="form-control" placeholder="creativelayers088@gmail.com">
                            </div>
                            <div class="form-group mb20">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="******************">
                            </div>
                            <button type="submit" class="btn btn-signup btn-thm">Create Account</button>
                            <p class="text-center mb25 mt10">Already have an account? <a href="page-login.html">Sign
                                    in</a></p>
                            <div class="hr_content">
                                <hr>
                                <span class="hr_top_text">or</span>
                            </div>
                            <ul class="login_with_social text-center mt30 mb0">
                                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-google"></i></a></li>
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
                                            class="icon"><img
                                                src="{{ asset('front/images/icons/flaticon-shopping-cart-white.svg') }}"
                                                alt=""></span><span class="badge bgc-thm">2</span></a> </li>
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
                                    href="{{ url($category->slug) }}">{{ $category->name }}</a></span>
                            @if ($category->direct_childs->count() > 0)
                                <ul>
                                    @foreach($category->direct_childs as $sub)
                                        <li>
                                            <a href="{{ url($sub->slug) }}">
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


        <div class="body_content_wrapper position-relative pt30">


            @yield('content')

            <!-- Our Footer -->
            <section class="footer_one home1 bdrt1">
                <div class="container pb60">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <div class="mailchimp_widget mb30-md text-center">
                                <div class="icon float-start"><span class="flaticon-email-1"></span></div>
                                <div class="details">
                                    <h3 class="title">Subscribe and get 20% discount.</h3>
                                </div>
                            </div>
                            <div class="footer_social_widget">
                                <form id="subscribeForm" class="footer_mailchimp_form">
                                    @csrf
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Your email address" required>
                                            <button class="ms-sm-2 btn-thm" type="submit">Subscribe</button>
                                        </div>
                                    </div>
                                </form>

                                <div id="subscribeMsg" style="margin-top:8px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt60">
                        <div class="col-sm-6 col-md-5 col-lg-3 col-xl-3">
                            <div class="footer_contact_widget">
                                <h4>Contact Us</h4>
                                <div class="footer_contact_iconbox d-flex">
                                    <div class="icon"><span class="flaticon-location"></span></div>
                                    <div class="details ms-4">
                                        <h5 class="title"></h5>
                                        <a href="#">{{ $settings->address }}</a>
                                    </div>
                                </div>
                                <div class="footer_contact_iconbox d-flex mb-4">
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
                                <h4>About Zenmart</h4>
                                <ul class="list-unstyled">
                                    <li><a href="#">Track Your Order</a></li>
                                    <li><a href="#">Product Guides</a></li>
                                    <li><a href="{{ route('wishlist') }}">Wishlists</a></li>
                                    <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                                    <li><a href="#">Store Locator</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-2 col-xl-2">
                            <div class="footer_qlink_widget">
                                <h4>Customer Support</h4>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route(name: 'contact') }}">Contact Us</a></li>
                                    <li><a href="#">Help Centre</a></li>
                                    <li><a href="#">Returns & Exchanges</a></li>
                                    <li><a href="#">Best Buy Financing</a></li>
                                    <li><a href="#">Best Buy Gift Card</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-2 col-xl-2">
                            <div class="footer_qlink_widget">
                                <h4>Services</h4>
                                <ul class="list-unstyled">
                                    <li><a href="#">Geek Squad</a></li>
                                    <li><a href="#">In-Home Advisor</a></li>
                                    <li><a href="#">Trade-In Program</a></li>
                                    <li><a href="#">Electronics Recycling</a></li>
                                    <li><a href="#">Best Buy Health</a></li>
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
                            <div class="footer_mobile_app_widget mb25">
                                <h4 class="title mb10">Mobile Apps</h4>
                                <div class="mobile_app_list">
                                    <ul class="mb0">
                                        <li><a href="#"><span class="flaticon-apple"></span>iOS App</a></li>
                                        <li><a href="#"><span class="flaticon-android"></span>Android App</a></li>
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
                                <p><a href="{{ route('privacy-policy') }}">Privacy</a>·<a
                                        href="{{ route('terms-conditions') }}">Terms</a>·<a
                                        href="{{ route('sitemap') }}">Sitemap</a></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="footer_bottom_right_widgets text-center text-lg-end">
                                <ul class="mb0">
                                    <li class="list-inline-item mb20-340">
                                        <select class="selectpicker show-tick">
                                            <option>Currency : USD</option>
                                            <option>Euro</option>
                                            <option>Pound</option>
                                        </select>
                                    </li>
                                    <li class="list-inline-item">
                                        <select class="selectpicker show-tick">
                                            <option>Language: English</option>
                                            <option>Frenc</option>
                                            <option>Italian</option>
                                            <option>Spanish</option>
                                            <option>Turkey</option>
                                        </select>
                                    </li>
                                </ul>
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
    <!-- Custom script for all pages -->
    <script src="{{ asset('front/js/script.js') }}"></script>
    <script src="{{ asset('front/js/isotop.js') }}"></script>
    <script src="{{ asset('front/js/parallax.js') }}"></script>
    <script src="{{ asset('front/js/wow.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.ez-plus.js') }}"></script>
    <script src="{{ asset('front/js/scrollbalance.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        document.addEventListener("click", function (e) {

            if (e.target.closest(".remove-mini-item")) {

                const id = e.target.closest(".remove-mini-item").dataset.id;

                fetch("/cart/remove/" + id, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(() => location.reload());

            }

        });
    

    </script>
</body>

</html>