@extends('front.app')

@section('title', 'Izharson Perfumers')

<style>
    .feature-card {
    height: 100%;
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.35);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 
        0 8px 32px rgba(31, 38, 135, 0.15),
        inset 0 0 0 1px rgba(255, 255, 255, 0.18);
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
}

.feature-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 
        0 20px 40px rgba(31, 38, 135, 0.22),
        inset 0 0 0 1px rgba(255, 255, 255, 0.28);
}

.card-content {
    padding: 2rem 1.5rem;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
}

.icon-wrapper {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, rgba(255,255,255,0.9), rgba(240,245,255,0.7));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.4rem;
    box-shadow: 
        0 6px 12px rgba(0,0,0,0.08),
        inset 0 2px 4px rgba(255,255,255,0.9);
    transition: all 0.4s ease;
}

.feature-card:hover .icon-wrapper {
    transform: scale(1.12) translateY(-4px);
    box-shadow: 
        0 10px 20px rgba(0,0,0,0.12),
        inset 0 3px 6px rgba(255,255,255,1);
}

.feature-icon {
    font-size: 2.1rem;
    color: #6366f1;          /* indigo-500 – change to your brand color */
    background: linear-gradient(45deg, #6366f1, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.card-title {
    font-weight: 700;
    font-size: 1.25rem;
    margin-bottom: 1rem;
    color: #1e293b;
}

.card-text {
    font-size: 0.98rem;
    color: #475569;
    line-height: 1.6;
    margin: 0;
    flex-grow: 1;
}
.main-banner-wrapper .carousel-btn-block .carousel-btn{
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-card{
background:#fff;
border-radius:12px;
overflow:hidden;
box-shadow:0 5px 15px rgba(0,0,0,.08);
transition:all .3s ease;
height:100%;
}

.product-card:hover{
transform:translateY(-5px);
box-shadow:0 15px 30px rgba(0,0,0,.15);
}

.product-img{
width:100%;
height:auto;
display:flex;
align-items:center;
justify-content:center;
background:#f9f9f9;
padding:10px;
}

.product-img img{
max-width:100%;
max-height:180px;
object-fit:contain;
}

.product-info{
padding:15px;
text-align:center;
}

.product-title{
font-size:15px;
font-weight:600;
color:#222;
margin-bottom:6px;
}

.product-title a{
color:#222;
text-decoration:none;
}

.product-title a:hover{
color:#c59d5f;
}

.product-price{
font-size:16px;
font-weight:700;
color:#c59d5f;
}

.productslider-wrapper{
position:relative;
overflow:hidden;
}

.productslider-track{
display:flex;
gap:20px;
transition:transform .4s ease;
}

.productslider-item{
flex:0 0 25%;
}

@media(max-width:992px){
.productslider-item{
flex:0 0 33.33%;
}
}

@media(max-width:768px){
.productslider-item{
flex:0 0 50%;
}
}

@media(max-width:480px){
.productslider-item{
flex:0 0 50%;
}
}

/* arrows */

.productslider-nav{
position:absolute;
top:45%;
transform:translateY(-50%);
background:#fff;
border:none;
width:40px;
height:40px;
border-radius:50%;
box-shadow:0 4px 10px rgba(0,0,0,.2);
cursor:pointer;
z-index:10;
}

.productslider-prev{
left:-10px;
}

.productslider-next{
right:-10px;
}
.productslider-wrapper{
position:relative;
overflow:hidden;
padding:0px 0px 40px 0px;
}

.productslider-track{
display:flex;
gap:20px;
transition:transform .4s ease;
}

.productslider-item{
flex:0 0 25%;
}

@media(max-width:992px){
.productslider-item{
flex:0 0 33.33%;
}
}

@media(max-width:768px){
.productslider-item{
flex:0 0 50%;
}
}
.newmarging{
    margin-top:70px;
}
.ptb{
    padding:48px 0px;
}


@media(min-width:481px){
    .cardsecview1{
        display:none;
    }
    .homebannerpd{
    padding-top:30px ;
    padding-bottom:0px;
}
}

@media(max-width:480px){
    .homebannerpd{
    padding-top:10px;
    padding-bottom:0px;
}
    .cardsecview{
        display:none;
    }
    .title_more_btn{
        display:none !important;
    }
    
    .ptb{
    padding:15px 0px;
}
.productslider-item{
flex:0 0 50%;
}
.productcard-buttons {
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.productcard-body{
    padding:0px 7px 7px 7px;
}
.productslider-track {
    display: flex;
    gap: 7px;
    transition: transform .4s ease;
}
.product-info {
    padding: 7px;
    text-align: center;
}
.product-card {
    background: #fff;
    border-radius: 3px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, .08);
    transition: all .3s ease;
    height: 100%;
}
.product-img {
    width: 100%;
    height: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f9f9f9;
    padding: 7px;
}
.product-title {
    font-size: 16px;
    font-weight: 600;
    color: #222;
    margin-bottom: 6px;
}
.newmarging{
    margin-top:10px;
}
.card-content {
    padding: 15px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
}
.card-title {
    font-weight: 700;
    font-size: 16px;
    margin-bottom: 1rem;
    color: #1e293b;
    margin-bottom: 0px;
}
.card-text {
    font-size: 12px;
    color: #475569;
    line-height: 1.6;
    margin: 0;
    flex-grow: 1;
}

}

/* arrows */

.productslider-nav{
position:absolute;
top:45%;
transform:translateY(-50%);
background:#fff;
border:none;
width:40px;
height:40px;
border-radius:50%;
box-shadow:0 4px 10px rgba(0,0,0,.2);
cursor:pointer;
z-index:10;
}

.productslider-nav.prev{
left:-10px;
}

.productslider-nav.next{
right:-10px;
}


</style>

@section('content')

   
    <section class="home-one homebannerpd">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-banner-wrapper home1_style bdrs6 ovh">
                        <div class="banner-style-one owl-theme owl-carousel">

                            @foreach($sliders as $slider)
                                <div class="slide slide-one"
                                    onclick="window.location='{{ $slider->button_link ?? '#' }}'"
                                    style="background-image:url('{{ asset('storage/' . $slider->image) }}'); height:445px; cursor:pointer;"">

                                    <div class="container">
                                        <div class="row home-content">
                                            <div class="col-lg-6 offset-lg-1 col-xl-5">

                                                @if($slider->title)
                                                <span class="tag" style="color: {{ $slider->color }}">
                                                    {{ $slider->title }}
                                                </span>
                                                @endif
                                                
                                                @if($slider->sub_title)
                                                <h3 class="banner-title">
                                                    {{ $slider->sub_title }}
                                                </h3>
                                                @endif
                                                
                                                @if($slider->content)
                                                <p>
                                                    {{ $slider->content ?? ''}}
                                                </p>
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
<section class="features ptb cardsecview" style="">
    <div class="container">
        <div class="row g-4">
            @foreach($features as $feature)
                <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                    <div class="feature-card">
                        <div class="card-content">
                            <div class="icon-wrapper">
                                <span class="{{ $feature->icon }} feature-icon"></span>
                            </div>
                            <h5 class="card-title">{{ $feature->title }}</h5>
                            <p class="card-text">{{ $feature->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
    <!-- Extra Features Section End -->

    @if($dealProducts->isNotEmpty() && $maxDealEnd)
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
                        <div class="main-title mb-5"> <a class="title_more_btn mt10"
                                href="{{ route('shop.category') }}">View
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
                                                <li>
                                                    <a href="#" class="add-to-wishlist-btn" data-product="{{ $product->id }}">
                                                        <span class="flaticon-heart"
                                                            style="{{ collect($wishlistIds)->contains($product->id) ? 'color:red;' : '' }}">
                                                        </span>
                                                    </a>
                                                </li>
                                                <li><a href="{{ url('product-details/' . $product->slug) }}"><span
                                                            class="flaticon-show"></span></a></li>
                                                <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="shop_item_cart_btn d-grid">
                                            <a href="#" class="btn btn-thm add-to-cart-btn" data-product="{{ $product->id }}"
                                                data-option="{{ optional($product->product_options->first())->id }}">
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
     @endif

    <!-- Category Section Start -->
    <section class="top-category pb30 pt20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between">
                        <div class="main-title">
                            <h2>Shop by Category</h2>
                        </div>
                        <div class="main-title mb-5"><a class="title_more_btn mt10" href="{{ route('shop.category') }}">View
                                All
                                Categories</a></div>
                    </div>
                </div>
            </div>
            <div class="row ovh">
                @foreach($categories as $category)
                    <div class="col-3 col-md-3 col-xl ">
                        <a href="{{ route('shop.category', $category->slug) }}" class="category_item">
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
                <div class="col-3 col-md-3 col-xl ">
<a href="{{ route('shop.category') }}" class="category_item">
                            <div class="iconbox">
                                <div class="icon" style="
    display: flex;
    align-items: center;
    justify-content: center;
">
                                    <!--<img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">-->
                                    <h5 class="title m-0"><i class="fa-solid fa-plus" style="font-size:24px"></i></h5>
                                </div>
                                <div class="details">
                                    <h5 class="title">All Categories</h5>
                                    
                                </div>
                            </div>
                        </a>
                    </div>
            </div>
            <div class="row ovh newmarging">

                {{-- Banner 1 --}}
                <div class="col-lg-6 col-xl-6 wow fadeInUp" data-wow-duration=".7s">
                    <div class="banner_one home1_style color1 mb30">
                        <a href="{{ $deliveryBanner1->button_link ?? '#' }}" >
                        <div class="thumb style1">
                            <img class="float-end" src="{{ asset('storage/' . $deliveryBanner1->image) }}"
                                alt="{{ $deliveryBanner1->heading }}">
                        </div>
                        </a>
                        <div class="details">
                            <p class="para color-light-blue">
                                {!!  $deliveryBanner1->content !!}
                            </p>
                            <h3 class="title">
                                {{ $deliveryBanner1->heading }}
                            </h3>
                            <!--<a href="{{ $deliveryBanner1->button_link ?? '#' }}" class="shop_btn">-->
                            <!--    Shop Now-->
                            <!--</a>-->
                        </div>
                    </div>
                </div>

                {{-- Banner 2 --}}
                <div class="col-lg-6 col-xl-6 wow fadeInUp" data-wow-duration=".9s">
                    <div class="banner_one home1_style color2 mb30">
                         <a href="{{ $deliveryBanner2->button_link ?? '#' }}" class="shop_btn">
                        <div class="thumb style1">
                            
                            <img class="float-end" src="{{ asset('storage/' . $deliveryBanner2->image) }}"
                                alt="{{ $deliveryBanner2->heading }}">
                        </div>
                        </a>
                        <div class="details">
                            <p class="para color-light-blue">
                                {!!  $deliveryBanner2->content !!}
                            </p>
                            <h3 class="title">
                                {{ $deliveryBanner2->heading }}
                            </h3>
                            <!--<a href="{{ $deliveryBanner2->button_link ?? '#' }}" class="shop_btn">-->
                            <!--    Shop Now-->
                            <!--</a>-->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    
    <!-- Category Section End -->
       

    <!-- Best Seller Section Start  -->
    <section class="featured-product pt0 ">
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

{{-- TAB 1 --}}
<div class="tab-pane fade show active" id="nav-home">

<div class="productslider-wrapper">

<button class="productslider-nav prev">
<i class="fas fa-arrow-left"></i>
</button>

<div class="productslider-track">

@foreach($bestSellers as $product)
<div class="productslider-item">
@include('front.partials.best-seller-card')
</div>
@endforeach

</div>

<button class="productslider-nav next">
<i class="fas fa-arrow-right"></i>
</button>

</div>
</div>


{{-- TAB 2 --}}
<div class="tab-pane fade" id="nav-shopping">

<div class="productslider-wrapper">

<button class="productslider-nav prev">
<i class="fas fa-arrow-left"></i>
</button>

<div class="productslider-track">

@foreach($attarBestSellers as $product)
<div class="productslider-item">
@include('front.partials.best-seller-card')
</div>
@endforeach

</div>

<button class="productslider-nav next">
<i class="fas fa-arrow-right"></i>
</button>

</div>
</div>


{{-- TAB 3 --}}
<div class="tab-pane fade" id="nav-destination">

<div class="productslider-wrapper">

<button class="productslider-nav prev">
<i class="fas fa-arrow-left"></i>
</button>

<div class="productslider-track">

@foreach($perfumeBestSellers as $product)
<div class="productslider-item">
@include('front.partials.best-seller-card')
</div>
@endforeach

</div>

<button class="productslider-nav next">
<i class="fas fa-arrow-right"></i>
</button>

</div>
</div>


{{-- TAB 4 --}}
<div class="tab-pane fade" id="nav-bread">

<div class="productslider-wrapper">

<button class="productslider-nav prev">
<i class="fas fa-arrow-left"></i>
</button>

<div class="productslider-track">

@foreach($bestSellers as $product)
<div class="productslider-item">
@include('front.partials.best-seller-card')
</div>
@endforeach

</div>

<button class="productslider-nav next">
<i class="fas fa-arrow-right"></i>
</button>

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
    <section class="deliver-divider pt0 paddin90">
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
     <!-- Extra Features Section Start -->
<section class="features ptb cardsecview1" style="">
    <div class="container">
        <div class="row g-4">
            @foreach($features as $feature)
                <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                    <div class="feature-card">
                        <div class="card-content">
                            <div class="icon-wrapper">
                                <span class="{{ $feature->icon }} feature-icon"></span>
                            </div>
                            <h5 class="card-title">{{ $feature->title }}</h5>
                            <p class="card-text">{{ $feature->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
    <!-- Extra Features Section End -->

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

<div class="tab-pane fade show active" id="nav-narive">

<div class="productslider-wrapper">

<button class="productslider-nav prev">
<i class="fas fa-arrow-left"></i>
</button>

<div class="productslider-track">

@foreach($premiumNewArrivals as $product)
<div class="productslider-item">
@include('front.partials.best-seller-card')
</div>
@endforeach

</div>

<button class="productslider-nav next">
<i class="fas fa-arrow-right"></i>
</button>

</div>

</div>


<div class="tab-pane fade" id="nav-bseller">

<div class="productslider-wrapper">

<button class="productslider-nav prev">
<i class="fas fa-arrow-left"></i>
</button>

<div class="productslider-track">

@foreach($premiumBestSellers as $product)
<div class="productslider-item">
@include('front.partials.best-seller-card')
</div>
@endforeach

</div>

<button class="productslider-nav next">
<i class="fas fa-arrow-right"></i>
</button>

</div>

</div>


<div class="tab-pane fade" id="nav-brated">

<div class="productslider-wrapper">

<button class="productslider-nav prev">
<i class="fas fa-arrow-left"></i>
</button>

<div class="productslider-track">

@foreach($premiumBestRated as $product)
<div class="productslider-item">
@include('front.partials.best-seller-card')
</div>
@endforeach

</div>

<button class="productslider-nav next">
<i class="fas fa-arrow-right"></i>
</button>

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

                                   <div class="productslider-wrapper pt-4 pb-5">

    <button class="productslider-nav productslider-prev">
        <i class="fas fa-arrow-left"></i>
    </button>

    <div class="productslider-track">

        @foreach($categoryProducts[$category->id] as $product)
            <div class="productslider-item">
                @include('front.partials.best-seller-card')
            </div>
        @endforeach

    </div>

    <button class="productslider-nav productslider-next">
        <i class="fas fa-arrow-right"></i>
    </button>

</div>

                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

           
        </div>
    </section>
    
    <div class="" style="background:#f9f9f9;">
         <div class="banner_one_large bdrs6 margin1001 px-4 px-md-0">
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
                                       <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">

<div class="product-card">

    <!-- IMAGE -->
    <div class="product-img">
        <a href="{{ url('product-details/' . $product->slug) }}">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        </a>
    </div>

    <!-- DETAILS -->
    <div class="product-info">

        <h6 class="product-title">
            <a href="{{ url('product-details/' . $product->slug) }}">
                {{ \Illuminate\Support\Str::limit($product->name, 40) }}
            </a>
        </h6>

        <div class="product-price">
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
                                        <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">

<div class="product-card">

    <!-- IMAGE -->
    <div class="product-img">
        <a href="{{ url('product-details/' . $product->slug) }}">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        </a>
    </div>

    <!-- DETAILS -->
    <div class="product-info">

        <h6 class="product-title">
            <a href="{{ url('product-details/' . $product->slug) }}">
                {{ \Illuminate\Support\Str::limit($product->name, 40) }}
            </a>
        </h6>

        <div class="product-price">
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
                                        <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">

<div class="product-card">

    <!-- IMAGE -->
    <div class="product-img">
        <a href="{{ url('product-details/' . $product->slug) }}">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        </a>
    </div>

    <!-- DETAILS -->
    <div class="product-info">

        <h6 class="product-title">
            <a href="{{ url('product-details/' . $product->slug) }}">
                {{ \Illuminate\Support\Str::limit($product->name, 40) }}
            </a>
        </h6>

        <div class="product-price">
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

                const button = this;
                const productId = button.dataset.product;
                const optionId = button.dataset.option || null;
                const quantity = 1;

                button.disabled = true;

                Swal.fire({
                    title: 'Adding to cart...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

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
                        device_id: localStorage.getItem("device_id")
                    })
                })
                    .then(res => res.json())
                    .then(data => {

                        button.disabled = false;

                        if (data.cart_count !== undefined) {
                            document.getElementById("cart-count").innerText = data.cart_count;
                            document.getElementById("cart-total").innerText = "₹" + parseFloat(data.total_price).toFixed(2);
                            refreshMiniCart();
                        }

                        Swal.fire({
                            icon: 'success',
                            title: 'Added!',
                            text: data.message,
                            timer: 1200,
                            showConfirmButton: false
                        });

                    })
                    .catch(() => {

                        button.disabled = false;

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Unable to add product'
                        });

                    });

            });

        });

        document.querySelectorAll('.add-to-wishlist-btn').forEach(btn => {

            btn.addEventListener('click', function (e) {

                e.preventDefault();

                const button = this;
                const productId = button.dataset.product;

                // 🔵 show loading
                Swal.fire({
                    title: 'Updating wishlist...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                fetch("/wishlist/toggle", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        Swal.close(); // ✅ stop loading

                     const heartIcon = button.querySelector('span, i');

if (!heartIcon) return; // stop error

                        if (data.status == "added") {
                            heartIcon.style.color = "red";
                        }

                        if (data.status == "removed") {
                            heartIcon.style.color = "";
                        }

                        if (data.status == "login_required") {
                            window.location.href = "/customer/login";
                        }

                    })
                    .catch(error => {

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Unable to update wishlist'
                        });

                        console.error("Wishlist error:", error);
                    });

            });

        });

    </script>
    
    <script>
        const track = document.querySelector(".productslider-track");
const prev = document.querySelector(".productslider-prev");
const next = document.querySelector(".productslider-next");

let position = 0;

next.addEventListener("click", () => {
    position -= 25;
    track.style.transform = `translateX(${position}%)`;
});

prev.addEventListener("click", () => {
    position += 25;
    track.style.transform = `translateX(${position}%)`;
});

    </script>
    
    <script>
        document.querySelectorAll(".productslider-wrapper").forEach(wrapper => {

let track = wrapper.querySelector(".productslider-track");
let prev = wrapper.querySelector(".prev");
let next = wrapper.querySelector(".next");

let position = 0;

next.onclick = () => {
position -= 25;
track.style.transform = `translateX(${position}%)`;
}

prev.onclick = () => {
position += 25;
track.style.transform = `translateX(${position}%)`;
}

});

document.querySelectorAll(".productslider-wrapper").forEach(wrapper => {

let track = wrapper.querySelector(".productslider-track");
let prev = wrapper.querySelector(".prev");
let next = wrapper.querySelector(".next");

let position = 0;

next.onclick = () => {
position -= 25;
track.style.transform = `translateX(${position}%)`;
}

prev.onclick = () => {
position += 25;
track.style.transform = `translateX(${position}%)`;
}

});


    </script>
@endsection