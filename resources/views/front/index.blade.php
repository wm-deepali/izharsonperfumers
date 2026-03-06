@extends('front.app')

@section('title', 'Izharson Perfumers')

@section('content')

    <!-- Slider Section Start -->
    <section class="home-one">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-banner-wrapper home1_style bdrs6 ovh">
                        <div class="banner-style-one owl-theme owl-carousel">

                            @foreach($sliders as $slider)
                                <div class="slide slide-one"
                                    style="background-image:url('{{ asset('storage/' . $slider->image) }}'); height:500px">

                                    <div class="container">
                                        <div class="row home-content">
                                            <div class="col-lg-6 offset-lg-1 col-xl-5">

                                                <span class="tag" style="color: {{ $slider->color }}">
                                                    {{ $slider->title }}
                                                </span>

                                                <h3 class="banner-title">
                                                    {{ $slider->sub_title }}
                                                </h3>

                                                <p>
                                                    {{ $slider->content }}
                                                </p>

                                                @if($slider->button_link)
                                                    <a href="{{ url($slider->button_link) }}" class="btn banner-btn btn-thm">
                                                        Shop Now
                                                    </a>
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach

                        </div>

                        <div class="carousel-btn-block banner-carousel-btn">
                            <span class="carousel-btn left-btn">
                                <i class="fas fa-chevron-left left"></i>
                            </span>
                            <span class="carousel-btn right-btn">
                                <i class="fas fa-chevron-right right"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Slider Section End -->

    <!-- Extra Features Section Start -->
    <section class="features pt30 pb20">
        <div class="container bb1">
            <div class="row ovh">

                @foreach($features as $feature)
                    <div class="col-sm-6 col-xl-3">
                        <div class="icon_boxes d-flex wow fadeInUp">
                            <div class="icon">
                                <span class="{{ $feature->icon }}"></span>
                            </div>
                            <div class="details">
                                <h5 class="title">{{ $feature->title }}</h5>
                                <p class="para">{{ $feature->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Extra Features Section End -->

    <!-- Deal of the Day Section Start -->
    <section class="deliver-divider pt30 pb70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex db-500 justify-content-between">
                        <div class="main-title mb0-500 d-block d-lg-flex">
                            <h2 class="">Deal of the Day</h2>
                            <div class="deal_countdown">
                                <ul class="deal_counter ml0-md" id="timer">
                                    <li class="list-inline-item days"></li>
                                    <li class="list-inline-item"><span class="title">Days :</span></li>
                                    <li class="list-inline-item hours"></li>
                                    <li class="list-inline-item"><span class="title">Hours :</span></li>
                                    <li class="list-inline-item minutes"></li>
                                    <li class="list-inline-item"><span class="title">Minutes :</span></li>
                                    <li class="list-inline-item seconds"></li>
                                    <li class="list-inline-item"><span class="title">Seconds</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="main-title mb-5"> <a class="title_more_btn mt10" href="page-shop-list-v2.html">View
                                All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="navi_pagi_bottom_center shop_item_5grid_slider dod_slider owl-carousel owl-theme">
                        @foreach($dealProducts as $product)

                            <div class="item ovh">
                                <div class="shop_item bdrtrb1 px-2 px-sm-3 wow fadeIn" data-wow-duration="1.0s">
                                    <div class="thumb pb30">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                        <div class="thumb_info">
                                            <ul class="mb0">
                                                <li><a href="page-dashboard-wish-list.html"><span
                                                            class="flaticon-heart"></span></a></li>
                                                <li><a href="{{ url('product-details/' . $product->slug) }}"><span
                                                            class="flaticon-show"></span></a></li>
                                                <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="shop_item_cart_btn d-grid">
                                            <a href="#" class="btn btn-thm add-to-cart-btn" data-product="{{ $product->id }}"
                                                data-option="{{ $product->product_options->first()->id ?? '' }}">
                                                Add to cart
                                            </a>
                                        </div>
                                    </div>
                                    <div class="details">
                                        {{-- BRAND / CATEGORY --}}
                                        <div class="sub_title">
                                            {{ $product->subcategories->name ?? ($product->categories->name ?? '')}}
                                        </div>

                                        {{-- NAME --}}
                                        <div class="title">
                                            <a href="{{ url('product-details/' . $product->slug) }}">
                                                {{ Str::limit($product->name, 40) }}
                                            </a>
                                        </div>
                                        {{-- RATING --}}
                                        <div class="review d-flex db-500">
                                            <ul class="mb0 me-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <li class="list-inline-item">
                                                        <a href="#">
                                                            <i
                                                                class="fas fa-star {{ $i <= $product->avg_rating ? '' : 'text-muted' }}"></i>
                                                        </a>
                                                    </li>
                                                @endfor
                                            </ul>

                                            <div class="review_count">
                                                <a href="#">{{ $product->review_count }} reviews</a>
                                            </div>
                                        </div>
                                        {{-- PRICE --}}
                                        <div class="si_footer">
                                            <div class="price">
                                                ₹{{ $product->product_options[0]->price ?? $product->min_price }}

                                                @if(!empty($product->product_options[0]->mrp))
                                                    <small>
                                                        <del>₹{{ $product->product_options[0]->mrp }}</del>
                                                        <span
                                                            class="off_tag text-thm1">{{ $product->product_options[0]->discount_percentage }}
                                                            %off</span>
                                                    </small>
                                                @endif
                                            </div>
                                            <div class="line mt20"></div>
                                            <div class="sell_stock mt10">
                                                <div class="sell">Sold 56</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Deal of the Day Section End -->

    <!-- Category Section Start -->
    <section class="top-category pb30 pt20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between">
                        <div class="main-title">
                            <h2>Shop by Category</h2>
                        </div>
                        <div class="main-title mb-5"><a class="title_more_btn mt10" href="page-shop-list-v2.html">View
                                All
                                Categories</a></div>
                    </div>
                </div>
            </div>
            <div class="row ovh">
                @foreach($categories as $category)
                    <div class="col-6 col-md-3 col-xl wow fadeInUp">
                        <a href="{{ url($category->slug) }}">
                            <div class="iconbox">
                                <div class="icon">
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                                </div>
                                <div class="details">
                                    <h5 class="title">{{ $category->name }}</h5>
                                    <p class="subtitle">
                                        {{ $category->items_count }} items
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="row ovh mt70">

                {{-- Banner 1 --}}
                <div class="col-lg-6 col-xl-6 wow fadeInUp" data-wow-duration=".7s">
                    <div class="banner_one home1_style color1 mb30">
                        <div class="thumb style1">
                            <img class="float-end" src="{{ asset('storage/' . $deliveryBanner1->image) }}"
                                alt="{{ $deliveryBanner1->heading }}">
                        </div>
                        <div class="details">
                            <p class="para color-light-blue">
                                {!!  $deliveryBanner1->content !!}
                            </p>
                            <h3 class="title">
                                {{ $deliveryBanner1->heading }}
                            </h3>
                            <a href="{{ $deliveryBanner1->button_link ?? '#' }}" class="shop_btn">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Banner 2 --}}
                <div class="col-lg-6 col-xl-6 wow fadeInUp" data-wow-duration=".9s">
                    <div class="banner_one home1_style color2 mb30">
                        <div class="thumb style1">
                            <img class="float-end" src="{{ asset('storage/' . $deliveryBanner2->image) }}"
                                alt="{{ $deliveryBanner2->heading }}">
                        </div>
                        <div class="details">
                            <p class="para color-light-blue">
                                {!!  $deliveryBanner2->content !!}
                            </p>
                            <h3 class="title">
                                {{ $deliveryBanner2->heading }}
                            </h3>
                            <a href="{{ $deliveryBanner2->button_link ?? '#' }}" class="shop_btn">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Category Section End -->

    <!-- Best Seller Section Start  -->
    <section class="featured-product pt0 pb90">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="main-title mb0-sm">
                        <h2>Best seller in the last month</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="popular_listing_sliders ui_kit_tab style2">
                        <div class="nav nav-tabs mb30 justify-content-start justify-content-lg-end" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Top
                                20</button>
                            <button class="nav-link" id="nav-shopping-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-shopping" role="tab" aria-controls="nav-shopping"
                                aria-selected="false">Attars</button>
                            <button class="nav-link" id="nav-destination-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-destination" role="tab" aria-controls="nav-destination"
                                aria-selected="false">Perfumes</button>
                            <button class="nav-link me-0" id="nav-bread-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-bread" role="tab" aria-controls="nav-bread"
                                aria-selected="false">All</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="popular_listing_sliders row ui_kit_tab style2">
                        <!-- Tab panes -->
                        <div class="tab-content col-lg-12" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <div
                                    class="best_item_slider_shop_lising_page shop_item_5grid_slider slider_dib_sm nav_none_400 dots_none owl-theme owl-carousel">
                                    @foreach($bestSellers as $product)
                                        @include('front.partials.best-seller-card')
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-shopping" role="tabpanel" aria-labelledby="nav-shopping-tab">
                                <div
                                    class="best_item_slider_shop_lising_page shop_item_5grid_slider slider_dib_sm nav_none_400 dots_none owl-theme owl-carousel">
                                    @foreach($attarBestSellers as $product)
                                        @include('front.partials.best-seller-card')
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-destination" role="tabpanel"
                                aria-labelledby="nav-destination-tab">
                                <div
                                    class="best_item_slider_shop_lising_page shop_item_5grid_slider slider_dib_sm nav_none_400 dots_none owl-theme owl-carousel">
                                    @foreach($perfumeBestSellers as $product)
                                        @include('front.partials.best-seller-card')
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-bread" role="tabpanel" aria-labelledby="nav-bread-tab">
                                <div
                                    class="best_item_slider_shop_lising_page shop_item_5grid_slider slider_dib_sm nav_none_400 dots_none owl-theme owl-carousel">
                                    @foreach($bestSellers as $product)
                                        @include('front.partials.best-seller-card')
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Best Seller Section End  -->

    <!-- static Delivery Divider Start-->
    <section class="deliver-divider pt0 pb90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="online_delivery text-center">
                        <h5 class="title">Members get free shipping* with no order minimum!*Restrictions apply.Try free
                            30-day
                            trial</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Delivery Divider End-->

    <!-- Premimum Product Start -->
    <section class="featured-product pt0">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="main-title mb0-sm">
                        <h2>Premium Products</h2>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="popular_listing_sliders ui_kit_tab style2">
                        <div class="nav nav-tabs mb30 justify-content-start justify-content-md-end" role="tablist">
                            <button class="nav-link active" id="nav-narive-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-narive" role="tab" aria-controls="nav-narive" aria-selected="true">New
                                arrivals</button>
                            <button class="nav-link" id="nav-bseller-tab" data-bs-toggle="tab" data-bs-target="#nav-bseller"
                                role="tab" aria-controls="nav-bseller" aria-selected="false">Best sellers</button>
                            <button class="nav-link" id="nav-brated-tab" data-bs-toggle="tab" data-bs-target="#nav-brated"
                                role="tab" aria-controls="nav-brated" aria-selected="false">Best rated</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="popular_listing_sliders row ui_kit_tab style2">
                        <div class="tab-content col-lg-12" id="nav-tabContent2">
                            <div class="tab-pane fade show active" id="nav-narive" role="tabpanel"
                                aria-labelledby="nav-narive-tab">
                                <div
                                    class="best_item_slider_shop_lising_page shop_item_5grid_slider slider_dib_sm nav_none_400 dots_none owl-theme owl-carousel">
                                    @foreach($premiumNewArrivals as $product)
                                        @include('front.partials.best-seller-card')
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-bseller" role="tabpanel" aria-labelledby="nav-bseller-tab">
                                <div
                                    class="best_item_slider_shop_lising_page shop_item_5grid_slider slider_dib_sm nav_none_400 dots_none owl-theme owl-carousel">
                                    @foreach($premiumBestSellers as $product)
                                        @include('front.partials.best-seller-card')
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-brated" role="tabpanel" aria-labelledby="nav-brated-tab">
                                <div
                                    class="best_item_slider_shop_lising_page shop_item_5grid_slider slider_dib_sm nav_none_400 dots_none owl-theme owl-carousel">
                                    @foreach($premiumBestRated as $product)
                                        @include('front.partials.best-seller-card')
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Premimum Product End -->

    <!-- Category Products Tabs Start -->
    <section class="featured-product pt0">
        <div class="container">

            <div class="row">
                <div class="col-md-5">
                    <div class="main-title mb0-sm">
                        <h2>Explore Categories</h2>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="popular_listing_sliders ui_kit_tab style2">
                        <div class="nav nav-tabs mb30 justify-content-start justify-content-md-end" role="tablist">

                            @foreach($tabCategories as $key => $category)
                                <button class="nav-link {{ $key == 0 ? 'active' : '' }}" data-bs-toggle="tab"
                                    data-bs-target="#cat-{{ $category->id }}" type="button">
                                    {{ $category->name }}
                                </button>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="popular_listing_sliders row ui_kit_tab style2">
                        <div class="tab-content col-lg-12">

                            @foreach($tabCategories as $key => $category)
                                <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="cat-{{ $category->id }}">

                                    <div
                                        class="best_item_slider_shop_lising_page shop_item_5grid_slider slider_dib_sm nav_none_400 dots_none owl-theme owl-carousel">

                                        {{-- ✅ FIX: use optimized products --}}
                                        @foreach($categoryProducts[$category->id] as $product)
                                            @include('front.partials.best-seller-card')
                                        @endforeach

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

            <div class="banner_one_large bdrs6 mt100 px-4 px-md-0">
                <div class="row">
                    <div class="col-lg-5 offset-lg-1 align-self-center">
                        <div class="apple_widget_home1 mb-4 mb-lg-0">
                            <h1 class="title">{{ $banner->heading ?? 'ARABIAN OUD'}}</h1>
                            <p class="para mt-3 mb-4">{!! $banner->content !!}</p>
                            <a href="page-shop-list-v1.html" class="btn btn-thm">Shop Now</a>
                        </div>
                    </div>
                    <div class="col-lg-6 align-self-center">
                        <div class="apple_widget_home1 animate_content text-center">
                            <div class="thumb animate_thumb"><img src="{{ asset('storage/' . $banner->image) }}"
                                    alt="{{ $banner->heading ?? '' }}"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Category Products Tabs End -->

    <!-- Hot New Arrival Product Start -->
    <section class="featured-product pt0">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-title mb0-sm">
                        <h2>Hot New Arrivals</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="popular_listing_sliders style2 ui_kit_tab">
                        <div class="justify-content-md-end justify-content-start mb30 nav nav-tabs" role="tablist">
                            <button aria-controls="nav-hnat20" aria-selected="true" class="nav-link active"
                                data-bs-target="#nav-hnat20" data-bs-toggle="tab" id="nav-hnat20-tab"
                                role="tab">All</button>
                            <button aria-controls="nav-hnababy" aria-selected="false" class="nav-link"
                                data-bs-target="#nav-hnababy" data-bs-toggle="tab" id="nav-hnababy-tab" role="tab">Top
                                20</button>
                            <button aria-controls="nav-hnaent" aria-selected="false" class="nav-link me-0"
                                data-bs-target="#nav-hnaent" data-bs-toggle="tab" id="nav-hnaent-tab"
                                role="tab">Attars</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row popular_listing_sliders style2 ui_kit_tab">
                        <div class="col-lg-12 tab-content" id="nav-tabContent4">
                            <div class="fade tab-pane active show" id="nav-hnat20" aria-labelledby="nav-hnat20-tab"
                                role="tabpanel">
                                <div class="row">
                                    @foreach($newArrivals as $product)
                                        <div class="col-lg-3 col-lg-4 col-sm-6 px-1 px-sm-0 fadeInUp wow">
                                            <div class="align-items-center bdr1 d-flex shop_item tiny_style">

                                                {{-- IMAGE --}}
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                        alt="{{ $product->name }}">
                                                </div>

                                                {{-- DETAILS --}}
                                                <div class="flex-grow-1 ms-3">
                                                    <div class="mb-2 title">
                                                        <a href="{{ url('product-details/' . $product->slug) }}">
                                                            {{ \Illuminate\Support\Str::limit($product->name, 45) }}
                                                        </a>
                                                    </div>

                                                    <div class="para text-thm1">
                                                        ₹{{ $product->product_options[0]->price ?? $product->min_price }}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="fade tab-pane" id="nav-hnababy" aria-labelledby="nav-hnababy-tab" role="tabpanel">
                                <div class="row">
                                    @foreach($topSellingArrivals as $product)
                                        <div class="col-lg-3 col-lg-4 col-sm-6 px-1 px-sm-0 fadeInUp wow">
                                            <div class="align-items-center bdr1 d-flex shop_item tiny_style">

                                                {{-- IMAGE --}}
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                        alt="{{ $product->name }}">
                                                </div>

                                                {{-- DETAILS --}}
                                                <div class="flex-grow-1 ms-3">
                                                    <div class="mb-2 title">
                                                        <a href="{{ url('product-details/' . $product->slug) }}">
                                                            {{ \Illuminate\Support\Str::limit($product->name, 45) }}
                                                        </a>
                                                    </div>

                                                    <div class="para text-thm1">
                                                        ₹{{ $product->product_options[0]->price ?? $product->min_price }}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="fade tab-pane" id="nav-hnaent" aria-labelledby="nav-hnaent-tab" role="tabpanel">
                                <div class="row">
                                    @foreach($attarArrivals as $product)
                                        <div class="col-lg-3 col-lg-4 col-sm-6 px-1 px-sm-0 fadeInUp wow">
                                            <div class="align-items-center bdr1 d-flex shop_item tiny_style">

                                                {{-- IMAGE --}}
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                        alt="{{ $product->name }}">
                                                </div>

                                                {{-- DETAILS --}}
                                                <div class="flex-grow-1 ms-3">
                                                    <div class="mb-2 title">
                                                        <a href="{{ url('product-details/' . $product->slug) }}">
                                                            {{ \Illuminate\Support\Str::limit($product->name, 45) }}
                                                        </a>
                                                    </div>

                                                    <div class="para text-thm1">
                                                        ₹{{ $product->product_options[0]->price ?? $product->min_price }}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hot New Arrival Product End -->
    <script>
        const dealEndTime = "{{ optional($maxDealEnd)->toIso8601String() }}";

        if (!dealEndTime) {
            document.getElementById("timer").innerHTML = "No active deals";
        }

        function makeTimer() {

            const endTime = new Date(dealEndTime).getTime();
            const now = new Date().getTime();
            const timeLeft = endTime - now;

            if (timeLeft <= 0) {
                document.getElementById("timer").innerHTML = "Deal Expired";
                return;
            }

            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            document.querySelector(".days").innerHTML = days;
            document.querySelector(".hours").innerHTML = hours.toString().padStart(2, '0');
            document.querySelector(".minutes").innerHTML = minutes.toString().padStart(2, '0');
            document.querySelector(".seconds").innerHTML = seconds.toString().padStart(2, '0');
        }

        setInterval(makeTimer, 1000);
        makeTimer();
    </script>

    <script>

        // add to cart
        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {

            btn.addEventListener('click', function (e) {
                e.preventDefault();

                const productId = this.dataset.product;
                const optionId = this.dataset.option; // ✅ get default option
                const quantity = 1;

                fetch("{{ route('cart.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        product_option_id: optionId,
                        quantity: quantity,
                        device_id: localStorage.getItem("device_id") // ⭐ REQUIRED
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Added!',
                            text: 'Product added to cart',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
                    .catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error adding to cart'
                        });
                    });

            });

        });

    </script>

@endsection