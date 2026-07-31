@extends('front.app')

@section('title', $product->meta_title ?? $product->name)


<style>
    .productcard-card{
background:#fff;
border-radius:16px;
overflow:hidden;
/*box-shadow:0 10px 25px rgba(0,0,0,.08);*/
transition:.35s;
border:1px solid #f1f1f1;
}

.productcard-card:hover{
transform:translateY(-6px);
/*box-shadow:0 18px 40px rgba(0,0,0,.15);*/
}

/* IMAGE */

.productcard-image{
position:relative;
background:#f9fafc;
padding:15px;
text-align:center;
}

.productcard-image{
    width:100%;
    height:320px !important;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#fff;
}

.productcard-image img{
    max-width:100%;
    max-height:100%;
    object-fit:contain;
}



/* ICONS */

.productcard-icons{
position:absolute;
top:10px;
right:10px;
display:flex;
flex-direction:column;
gap:8px;
}

.productcard-icon{
background:#fff;
width:34px;
height:34px;
display:flex;
align-items:center;
justify-content:center;
border-radius:50%;
box-shadow:0 4px 10px rgba(0,0,0,.15);
}

/* BODY */

.productcard-body{
padding:0px 16px 16px 16px;
}

.productcard-category{
font-size:12px;
color:#888;
margin-bottom:4px;
    background: #f1f1f145;
    border-radius: 4px;
    padding: 0px 10px;
}

.productcard-title{
font-size:15px;
font-weight:600;
margin-bottom:6px;
margin-top: 10px;
}

.productcard-title a{
color:#222;
text-decoration:none;
}

/* RATING */

.productcard-rating{
font-size:13px;
margin-bottom:6px;
}

.productcard-rating i{
color:#ddd;
}

.productcard-rating i.active{
color:#f6b100;
}

/* PRICE */

.productcard-price{
font-size:17px;
font-weight:700;
color:#222;
margin-bottom:10px;
}

.productcard-oldprice{
font-size:13px;
color:#999;
margin-left:6px;
text-decoration:line-through;
}

/* BUTTONS */

.productcard-buttons{
display:flex;
gap:8px;
}

.productcard-btn{
flex:1;
padding:8px;
font-size:13px;
border-radius:8px;
text-align:center;
text-decoration:none;
font-weight:600;
}

.productcard-cart{
background:#eef2ff;
color:#4f46e5;
}

.productcard-buy{
background:linear-gradient(135deg,#6366f1,#4f46e5);
color:#fff;
}

  @media(max-width:540px) {
        .productcard-image {
            width: 100%;
            height: auto !important;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
        }

        .productcard-image {
            position: relative;
            background: #f9fafc;
            padding: 7px;
            text-align: center;
        }

        .productcard-title {
            margin-bottom: 5px;
            font-size: 15px;
            margin-bottom: 4px;
            margin-bottom: 6px;
            margin-top: 7px;
        }

        .productcard-btn {
            flex: 1;
            padding: 2px;
            font-size: 13px;
            border-radius: 8px;
            text-align: center;
            text-decoration: none;
            font-weight: 600;
        }

        .productcard-rating {
            display: none;
        }

        .productcard-body {
            padding: 0px 7px 7px 7px;
        }

        .productcard-category {
            font-size: 12px;
            color: #888;
            margin-bottom: 4px;
            margin-top: 4px;
            background: #f1f1f145;
            border-radius: 4px;
            padding: 0px 10px;
        }

        .new-iz-section-title {
            font-size: 16px;
            letter-spacing: -0.5px;
            color: #111;
        }

        .shop-v3-container {
            padding: 10px !important;
        }
        .new-iz-section-title {
    font-size: 20px !important;
    margin-top: 18px;
    letter-spacing: -0.5px;
    color: #111;
}
.productcard-buttons {
    display: flex;
    flex-direction: column;
    gap: 8px;
}
    }
    
</style>

<style>

    .productslider-wrapper {
        position: relative;
        overflow: hidden;
    }

    .productslider-track {
        display: flex;
        gap: 20px;
        transition: transform .4s ease;
    }

    .productslider-item {
        flex: 0 0 25%;
    }

    @media(max-width:992px) {
        .productslider-item {
            flex: 0 0 33.33%;
        }
    }

    @media(max-width:768px) {
        .productslider-item {
            flex: 0 0 50%;
        }
    }

    @media(max-width:480px) {
        .productslider-item {
            flex: 0 0 50%;
        }
    }

    .productslider-nav {
        position: absolute;
        top: 45%;
        transform: translateY(-50%);
        background: #fff;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        box-shadow: 0 4px 10px rgba(0, 0, 0, .2);
        cursor: pointer;
        z-index: 10;
    }

    .productslider-prev {
        left: -10px;
    }

    .productslider-next {
        right: -10px;
    }

    .productslider-wrapper {
        position: relative;
        overflow: hidden;
        padding: 0px 0px 40px 0px;
    }

    .productslider-track {
        display: flex;
        gap: 20px;
        transition: transform .4s ease;
    }

    .productslider-item {
        flex: 0 0 25%;
    }

    @media(max-width:992px) {
        .productslider-item {
            flex: 0 0 33.33%;
        }
    }

    @media(max-width:768px) {
        .productslider-item {
            flex: 0 0 50%;
        }
    }

   

    @media(max-width:480px) {
        .productslider-item {
            flex: 0 0 50%;
        }

        .productslider-track {
            display: flex;
            gap: 7px;
            transition: transform .4s ease;
        }

    }

    .productslider-nav {
        position: absolute;
        top: 45%;
        transform: translateY(-50%);
        background: #fff;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        box-shadow: 0 4px 10px rgba(0, 0, 0, .2);
        cursor: pointer;
        z-index: 10;
    }

    .productslider-nav.prev {
        left: -10px;
    }

    .productslider-nav.next {
        right: -10px;
    }

</style>

@section('content')

    <!-- Inner Page Breadcrumb -->
    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="breadcrumb_content">
                        <ol class="breadcrumb">

                            <!-- Home -->
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">Home</a>
                            </li>

                            <!-- Shop -->
                            <li class="breadcrumb-item">
                                <a href="{{ route('shop.category') }}">Shop</a>
                            </li>

                            <!-- Category -->
                            @if($product->categories)
                                <li class="breadcrumb-item">
                                    <a href="{{ route('shop.category', $product->categories->slug) }}">
                                        {{ $product->categories->name }}
                                    </a>
                                </li>
                            @endif

                            <!-- Subcategory -->
                            @if($product->subcategories)
                                <li class="breadcrumb-item">
                                    <a
                                        href="{{ route('shop.category', [$product->categories->slug, $product->subcategories->slug]) }}">
                                        {{ $product->subcategories->name }}
                                    </a>
                                </li>
                            @endif

                            <!-- Product Name -->
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $product->name }}
                            </li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

@php
    $images = [];

    foreach ($product->product_options as $opt) {
        foreach ($opt->product_variant_images as $img) {
            $images[] = [
                'full'  => $img->image,
                'thumb' => $img->image_thumb ?? $img->image,
            ];
        }
    }

    if (empty($images) && $product->image) {
        $images[] = [
            'full'  => $product->image,
            'thumb' => $product->image_thumb ?? $product->image,
        ];
    }

    // ✅ Discount calculation for main + sidebar price blocks
    $mainOpt = $product->product_options->first();
    $mainOptPrice = (float) ($mainOpt->price ?? 0);
    $mainOptMrp = $mainOpt->mrp ?? null;
    $mainHasDiscount = !is_null($mainOptMrp) && (float) $mainOptMrp > 0 && (float) $mainOptMrp > $mainOptPrice;
@endphp

    <!-- Shop Single Content -->
    <section class="shop-single-content pb80 pt0 ovh">
        <div class="container">
            <div class="row wrap">
                <div class="col-xl-7">
                    <div class="column">
                        <div class="shop_single_natabmenu">
                            <div class="d-flex flex-column-reverse flex-sm-row align-items-start">

                                <!-- Thumbnails -->
                                <div class="nav flex-row mt-2 mt-md-0 flex-md-column nav-pills me-0 me-md-3 gap-2" id="v-pills-tab2" role="tablist"
                                    aria-orientation="vertical">

                                  @foreach($images as $key => $img)
    <button class="nav-link {{ $key == 0 ? 'active' : '' }}" id="v-pills-tab-{{ $key }}"
        data-bs-toggle="pill" data-bs-target="#v-pills-img-{{ $key }}" type="button"
        role="tab">
        <img src="{{ asset('storage/' . $img['thumb']) }}" alt="">
    </button>
@endforeach

                                </div>

                                <!-- Main Images -->
                                <div class="tab-content m-auto" id="v-pills-tabContent2">

                                @foreach($images as $key => $img)
    @php
        $zoomId = 'zoom_' . str_pad($key + 1, 2, '0', STR_PAD_LEFT);
    @endphp

    <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}"
        id="v-pills-img-{{ $key }}" role="tabpanel">

        <div class="shop_single_navmenu_content justify-content-center">

            <a class="product_popup popup-img" href="{{ asset('storage/' . $img['full']) }}">
                <span class="flaticon-full-screen"></span>
            </a>

            <div class="zoomimg_wrapper m-auto">
                <img class="zoom-img main-product-image" id="mainProductImage"
                    src="{{ asset('storage/' . $img['full']) }}"
                    data-zoom-image="{{ asset('storage/' . $img['full']) }}" width="410"
                    alt="Product Image">
            </div>

        </div>
    </div>
@endforeach
                                </div>

                            </div>
                        </div>
                        <div class="shop_single_product_details  mt-4 d-block d-xl-none d-n" style="border: 1px solid #d0cbcb;
    padding: 20px;
    border-radius: 10px;">
      <h4 class="title">{{ $product->name }}</h4>
                            <p class="pb-0 m-0">{!! nl2br(e($product->short_description)) !!}</p>
                            <ul class="db-400 d-flex justify-content-between">
                                <div class="d-flex gap-2">
                                   
                                <li class=" ml0-400">
                                    <div class="sspd_review mt-0">
                                        <ul class="mb0  d-flex align-items-center ">
                                            @for($i = 1; $i <= 5; $i++)
                                                <li class="list-inline-item">
                                                    <a href="#">
                                                        <i
                                                            class="fas fa-star {{ $i <= $product->avg_rating ? '' : 'text-muted' }}"></i>
                                                    </a>
                                                </li>
                                            @endfor
                                            <li class="me-3 heading-color " style="font-size:15px">
   ( {{ ($product->reviews_count ?? 0) > 0 
        ? $product->reviews_count . ' reviews' 
        : 'No reviews' }} )
</li>

                                        </ul>
                                    </div>
                                </li>
                                
                                </div>
                                
                                <!--<li class="color-light-green " style="font-size:15px">-->
                                <!--    {{ $product->stock ?? 0 }} in stock-->
                                <!--</li>-->
                            </ul>
                            <hr>
                            <div class="sspd_price mt-2 mb-3">
                                ₹<span id="product-price">{{ $mainOptPrice }}</span>
                                <small id="product-mrp-wrap" style="{{ $mainHasDiscount ? '' : 'display:none;' }}">
                                    <del>₹<span id="product-mrp">{{ $mainOptMrp }}</span></del>
                                </small>
                            </div>
                            @if(!empty($product->fragrance_names))
                                <div class="mb-3">
                                    <h6 class="title mb-2">Fragrance:</h6>

                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($product->fragrance_names as $name)
                                            <span class="badge bg-light border text-dark px-3 py-2" style="font-size:15px;font-weight:500">
                                                {{ $name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="cloth_size_list_sscs_page">

                                <div class="tab-content m-auto" id="v-pills-tabContent4">
                                    @foreach($product->product_options as $index => $option)
                                        @php $pack = $option->packaging; @endphp

                                        <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="pack{{ $index }}">
                                            <h6 class="title mb-2">
                                                Select Weight:
                                                <span class="fw400">
                                                    {{ $pack->quantity }}{{ $pack->quantity_in }}
                                                </span>
                                            </h6>
                                        </div>
                                    @endforeach

                                </div>
                                <!-- Buttons -->
                                <div class="d-block d-sm-flex align-items-start">
                                    <div class="nav nav-pills" role="tablist">

                                        @foreach($product->product_options as $index => $option)
                                            @php $pack = $option->packaging;
                                                $variantImg = $option->product_variant_images->first()->image ?? $product->image;
                                            @endphp 
                                            <button class="nav-link me-2 {{ $index == 0 ? 'active' : '' }}"
                                                data-bs-toggle="pill" data-bs-target="#pack{{ $index }}" type="button"
                                                role="tab" data-price="{{ $option->price }}" data-mrp="{{ $option->mrp }}"
                                                data-image="{{ asset('storage/' . $variantImg) }}"
                                                data-option="{{ $option->id }}">
                                                {{ $pack->quantity }}{{ $pack->quantity_in }}

                                            </button>

                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="mb-0">
                                <ul class="cart_btn_widget shop_single3_style db-767 d-flex mb-0">
                                    <li class="me-3 mb-2">
                                        <div class="cart_btn home_page_sidebar">
                                            <div class="quantity-block home_page_sidebar">
                                                <button class="quantity-arrow-minus2 shop_single_page_sidebar"><img
                                                        src="{{ asset('front/images/icons/minus.svg') }}" alt=""></button>
                                                <input class="quantity-input quantity-num2 shop_single_page_sidebar"
                                                    type="number" value="1" min="1">
                                                <button class="quantity-arrow-plus2 shop_single_page_sidebar"> <span
                                                        class="flaticon-close"></span> </button>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="me-0 me-sm-3 mb-3">
                                        <a href="#" class="btn btn-thm bdrs60 add-to-cart-btn"
   data-product="{{ $product->id }}">
   Add to cart
</a>
                                    </li>
                                    <li class="me-0 me-sm-3 mb-3"><a href="#"class="btn btn-white bdr_thm bdrs60 buy-now-btn"
   data-product="{{ $product->id }}">
   Buy Now
</a></li>
                                </ul>
                                <ul class="shop_single_wishlist_area  d-flex align-items-center mb-3" style="flex-wrap:nowrap;">
                                    <li class="pe-2 ms-2 ms-sm-0">
                                        <a href="#" class="add-to-wishlist-btn" data-product="{{ $product->id }}">
    <span class="flaticon-heart me-2"
        style="{{ collect($wishlistIds)->contains($product->id) ? 'color:red;' : '' }}">
    </span>
    Wishlist
</a>
                                </li>
                                                
                            
                                    <li class="ms-2"><a href="#" id="shareProduct">
    <span class="flaticon-share me-2"></span>Share
</a></li>
                                </ul>
                            </div>
                            <hr class="mt-0 mb20">
                            <ul class="sspd_sku mb30">
                                <li><a href="#">SKU:{{ $product->sku }} </a></li>
                                <li><a href="#">Category: {{ $product->categories->name ?? 'N/A' }}</a></li>
                            </ul>
                            <hr>
                            <!-- <div class="vendor_iconbox style2 d-flex mb-1 mt-4">
                                <span class="icon fz30 heading-color"><span class="flaticon-truck"></span></span>
                                <div class="details ms-3 mt-0">
                                    <p class="heading-color">Free Shipping & Returns: On all orders over ₹200.00</p>
                                </div>
                            </div>
                            <div class="vendor_iconbox style2 d-flex mb-1">
                                <span class="icon fz30 heading-color"><span class="flaticon-shop"></span></span>
                                <div class="details ms-3 mt-0">
                                    <p class="heading-color">Sold and shipped by <a href="#"
                                            class="fw500 heading-color fz16">TFN-STORE | TUFAN STORE LLC Fulfilled by
                                            Zenmart</a></p>
                                </div>
                            </div>
                            <div class="vendor_iconbox style2 d-flex mb-0">
                                <span class="icon fz30 heading-color"><span class="flaticon-return-box"></span></span>
                                <div class="details ms-3 mt-0">
                                    <p class="heading-color">Free 15-Day returns <a class="tdu" href="">Details</a></p>
                                </div>
                            </div>
                            <hr> -->
                        </div>
                        <div class="shortcode_widget_accprdons shop_single_accordion px-0 mt-5">
                            <div class="faq_according text-start">
                                <div class="shop_single_description">
                                    <h4 class="title">Overview</h4>

                                    <p class="para">
                                        {!! Str::limit(strip_tags($product->description), 250) !!}
                                    </p>

                                    @if(strlen(strip_tags($product->description)) > 250)
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item">

                                                <div id="flush-collapseOne" class="accordion-collapse collapse">
                                                    <div class="accordion-body px-0 pt-0">
                                                        <p class="para"> {!! strip_tags($product->description) !!}

                                                        </p>
                                                    </div>
                                                </div>

                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed px-0 pt-3 text-thm1" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne">
                                                        Read More
                                                    </button>
                                                </h2>

                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <hr>
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="headingInfo">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link collapsed text-start" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseInfo">
                                                    Additional Information
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseInfo" class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                {!! $product->additional_information !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTerms">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link collapsed text-start" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTerms">
                                                    Terms & Conditions
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseTerms" class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                {!! $product->terms_condition !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingFive">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link collapsed text-start" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                    aria-expanded="false" aria-controls="collapseFive">Shipping and
                                                    Returns</button>
                                            </h2>
                                        </div>
                                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                                            data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p class="shipping_return_para mb-0 mt-3">
                                                    {!! $product->shipping_information !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-0">
                                        <div class="card-header" id="headingSeven">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link collapsed text-start" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseSeven"
                                                    aria-expanded="false" aria-controls="collapseSeven">Customer
                                                    Reviews</button>
                                            </h2>
                                        </div>
                                        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven"
                                            data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-10 col-xl-7">
                                                        <div class="review_average mb30">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0">
                                                                    <div class="title">
                                                                        {{ number_format($product->product_review->avg('rating'), 1) ?? '0.0' }}
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <div class="sspd_postdate">
                                                                        <div class="sspd_review">
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
                                                                        </div>
                                                                    </div>
                                                                    <div class="total_review">{{ $product->review_count }}
                                                                        reviews</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @foreach($product->rating_breakdown as $star => $percent)
<div class="d-flex justify-content-between align-items-center single_line_review pr30 pr0-lg mb10">
    
    <div class="me-1">{{ $star }} star</div>

    <div class="progress-bar mx-3">
        <div class="progress-bar__bg"></div>
        <div class="progress-bar__bar" style="width: {{ $percent }}%"></div>
    </div>

    <div class="heading-color">{{ $percent }}%</div>
</div>
@endforeach
                                                      
                                                      
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="product_single_content mb30">
                                                            <div class="mbp_pagination_comments">
                                                                <h5 class="mb30">
                                                                    {{ $product->product_review->count() }} Review For This
                                                                    Product
                                                                </h5>

                                                              @forelse($product->product_review as $review)

<div class="mbp_first d-flex align-items-center mb20">

    <div class="flex-shrink-0">
        <img src="{{ optional($review->customer)->image 
            ? asset('storage/' . $review->customer->image) 
            : asset('front/images/blog/reviewer2.png') }}"
        class="mr-3" alt="reviewer">
    </div>

    <div class="flex-grow-1 ms-4">

        <div class="d-block d-md-flex">

            <div class="sspd_postdate me-2 mb10-sm">
                <div class="sspd_review">
                    <ul class="mb0">
                        @for($i = 1; $i <= 5; $i++)
                            <li class="list-inline-item">
                                <a href="#">
                                    <i class="fas fa-star {{ $i <= $review->rating ? '' : 'text-muted' }}"></i>
                                </a>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>

            <h5 class="sub_title">
                {{ $review->review ?? 'Customer Review' }}
            </h5>

        </div>

        <div class="review_post_meta">
            Reviewed by
            {{ optional($review->customer)->name ?? 'Customer' }}
            -
            {{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}
        </div>

    </div>

</div>

<div class="review_content_para mb30">
    <p>{{ $review->review }}</p>
</div>

<hr>

@empty
<p>No reviews yet.</p>
@endforelse

                                                                <div class="all_review_btn text-center">
                                                                    <a href="#" class="btn btn-lg btn-white bdr_thm">See All
                                                                        Review</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if(auth()->guard('customer')->check() && $canReview)

        <div class="bsp_reveiw_wrt mb-0">
            <form class="comments_form" action="{{ route('customer.review.submit') }}" method="POST">
                @csrf

                <input type="hidden" name="order_id" value="{{ $orderId }}">
                <input type="hidden" name="order_detail_id" value="{{ $orderDetailId }}">
               <input type="hidden" name="rating" id="rating" value="0">

                <div class="row">
                    <div class="col-md-12">
                        <h4 class="title mb20">Add a Review</h4>
                        <p class="heading-color">Your email address will not be published. Required fields are marked *</p>

                        <h5 class="mb0">Your rating of this product</h5>

                        <div class="sspd_postdate vendor_single">
                            <div class="sspd_review">
                                <ul class="mb0">

                                  @for($i = 1; $i <= 5; $i++)
    <li class="list-inline-item">
        <a href="#" class="rating-star" data-value="{{ $i }}">
            <i class="fas fa-star" style="color:#ccc;"></i>
        </a>
    </li>
@endfor

                                </ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="heading-color mb10">Your review</label>
                            <textarea name="review" class="form-control" rows="6"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="heading-color mb10">Name</label>
                            <input type="text" class="form-control"
                                value="{{ auth()->guard('customer')->user()->name }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="heading-color mb10">Email</label>
                            <input type="email" class="form-control"
                                value="{{ auth()->guard('customer')->user()->email }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <br>
                        <button type="submit" class="btn btn-thm">Submit</button>
                    </div>
                </div>
            </form>
        </div>

    @endif

                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4  offset-xl-1 d-none d-xl-block">
                    
                        <div class="shop_single_product_details sidebar  mb-3 mb-xl-0 " style="border: 1px solid #d0cbcb;
    padding: 20px;
    border-radius: 10px;" >
                            <ul class="db-400 d-flex justify-content-between">
                                <div class="d-flex gap-2">
                                    <li class=" heading-color " style="font-size:15px; font-weight:600;">
                                    {{ $product->categories->name ?? 'Brand' }}
                                </li>
                                
                                
                                </div>
                                
                                <!--<li class="color-light-green " style="font-size:15px">-->
                                <!--    {{ $product->stock ?? 0 }} in stock-->
                                <!--</li>-->
                            </ul>
                            <h4 class="title m-0">{{ $product->name }}</h4>
                            
                            <p class="m-0">{!! nl2br(e($product->short_description)) !!}</p>
                             <ul class="db-400 d-flex justify-content-between">
                                <div class="d-flex gap-2">
                                   
                                <li class=" ml0-400">
                                    <div class="sspd_review mt-0">
                                        <ul class="mb0  d-flex align-items-center ">
                                            @for($i = 1; $i <= 5; $i++)
                                                <li class="list-inline-item">
                                                    <a href="#">
                                                        <i
                                                            class="fas fa-star {{ $i <= $product->avg_rating ? '' : 'text-muted' }}"></i>
                                                    </a>
                                                </li>
                                            @endfor
                                            <li class="me-3 heading-color " style="font-size:15px">
   ( {{ ($product->reviews_count ?? 0) > 0 
        ? $product->reviews_count . ' reviews' 
        : 'No reviews' }} )
</li>

                                        </ul>
                                    </div>
                                </li>
                                
                                </div>
                                
                                <!--<li class="color-light-green " style="font-size:15px">-->
                                <!--    {{ $product->stock ?? 0 }} in stock-->
                                <!--</li>-->
                            </ul>
                            <hr>
                            <div class="sspd_price mb20 mt20">
                                ₹<span id="sidebar-price">{{ $mainOptPrice }}</span>

                                <small id="sidebar-mrp-wrap" style="{{ $mainHasDiscount ? '' : 'display:none;' }}">
                                    <del>₹<span id="sidebar-mrp">{{ $mainOptMrp }}</span></del>
                                </small>
                            </div>
                            @if(!empty($product->fragrance_names))
                                <div class="mb-3">
                                    <h6 class="title mb-2">Fragrance:</h6>

                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($product->fragrance_names as $name)
                                            <span class="badge bg-light border text-dark px-3 py-2" style="font-size:14px;font-weight:500">
                                                {{ $name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="cloth_size_list_sscs_page">
                                <!-- Selected Label -->
                                <div class="tab-content m-auto">
                                    @foreach($product->product_options as $index => $option)
                                        @php $pack = $option->packaging; @endphp

                                        <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="pack{{ $index }}">
                                            <h6 class="title mb-2">
                                                Select Weight:
                                                <span class="fw400">
                                                    {{ $pack->quantity }}{{ $pack->quantity_in }}
                                                </span>
                                            </h6>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Buttons -->
                                <div class="d-block d-sm-flex align-items-start">
                                    <div class="nav nav-pills" role="tablist">

                                        @foreach($product->product_options as $index => $option)
                                            @php
                                             $pack = $option->packaging; 
    $variantImg = $option->product_variant_images->first()->image ?? $product->image;
@endphp

<button class="nav-link me-2 {{ $index == 0 ? 'active' : '' }}"
    data-bs-toggle="pill"
    data-bs-target="#pack{{ $index }}"
    type="button"
    role="tab"
    data-price="{{ $option->price }}"
    data-mrp="{{ $option->mrp }}"
    data-image="{{ asset('storage/' . $variantImg) }}" data-option="{{ $option->id }}">

                                                {{ $pack->quantity }}{{ $pack->quantity_in }}

                                            </button>

                                        @endforeach

                                    </div>
                                </div>
                            </div>

                            <hr>
                            <ul class="cart_btn_widget shop_single3_style align-items-center d-flex justify-content-between mb-1">
                                <li class="list-inline-item me-3 mb-2">
                                    <div class="cart_btn home_page_sidebar d-grid">
                                        <div class="quantity-block home_page_sidebar">
                                            <button class="quantity-arrow-minus2 shop_single_page_sidebar"><img
                                                    src="{{ asset('front/images/icons/minus.svg') }}" alt=""></button>
                                            <input class="quantity-input quantity-num2 shop_single_page_sidebar"
                                                type="number" value="1" min="1">
                                            <button class="quantity-arrow-plus2 shop_single_page_sidebar"> <span
                                                    class="flaticon-close"></span> </button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-inline-item me-3 mb-3">
                                    <a href="#" class="btn btn-thm bdrs60 add-to-cart-btn" data-product="{{ $product->id }}">
                                        Add to cart
                                    </a>
                                    </li>
                            </ul>
                            <div class="cart_btns d-grid mb-3">
                                <a href="#" class="btn btn-white bdr_thm ss_cart_btn buy-now-btn"
   data-product="{{ $product->id }}">
   Buy Now
</a>
                            </div>
                            <ul class="shop_single_wishlist_area d-block d-sm-flex align-items-center mb-0">
                                <li class="pe-2 ms-2 ms-sm-0">
                                  <a href="#" class="add-to-wishlist-btn" data-product="{{ $product->id }}">
    <span class="flaticon-heart me-2"
        style="{{ collect($wishlistIds)->contains($product->id) ? 'color:red;' : '' }}">
    </span>
    Wishlist
</a>
</li>

                                <li class="pe-2 ms-2"><a href="#"><span class="flaticon-question me-2"></span>Ask a
                                        Question</a></li>
                                <li class="ms-2"><a href="#" id="shareProduct">
    <span class="flaticon-share me-2"></span>Share
</a></li>
                            </ul>
                        </div>
                    
                </div>
            </div>
            
             @if ($relatedProducts->isNotEmpty())
            <div class="row" style="position:relative;">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h2 class="title">Related products</h2>
                    </div>
                      <div class="productslider-wrapper">

                                    <button class="productslider-nav prev" aria-label="Previous slide">
                                        <i class="fas fa-arrow-left"></i>
                                    </button>

                                    <div class="productslider-track">

                                        @foreach($relatedProducts as $product)
                                            <div class="productslider-item">
                                                @include('front.partials.best-seller-card')
                                            </div>
                                        @endforeach

                                    </div>

                                    <button class="productslider-nav next" aria-label="Next slide">
                                        <i class="fas fa-arrow-right"></i>
                                    </button>

                                </div>
                </div>
            </div>
            
             @endif

            @if ($recommendedProducts->isNotEmpty())
            
            <div class="row mt50">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h2 class="title">You may also like</h2>
                    </div>
                    
                    
                  <div class="productslider-wrapper">

                                    <button class="productslider-nav prev" aria-label="Previous slide">
                                        <i class="fas fa-arrow-left"></i>
                                    </button>

                                    <div class="productslider-track">

                                        @foreach($recommendedProducts as $product)
                                            <div class="productslider-item">
                                                @include('front.partials.best-seller-card')
                                            </div>
                                        @endforeach

                                    </div>

                                    <button class="productslider-nav next" aria-label="Next slide">
                                        <i class="fas fa-arrow-right"></i>
                                    </button>

                                </div>
                </div>
            </div>
             @endif
             
        </div>
    </section>
   <script src="{{ asset('front/js/jquery-3.6.0.js') }}"></script>
<script>
document.querySelectorAll('.card-header').forEach(header => {
    header.style.cursor = 'pointer';
    header.addEventListener('click', function (e) {
        // agar seedha button pe click hua hai, toh use apna kaam karne do (double trigger na ho)
        if (e.target.closest('button')) return;

        const btn = this.querySelector('button[data-bs-toggle="collapse"]');
        if (btn) btn.click();
    });
});
(function () {

   
 try {
        if ($("#mainProductImage").length && typeof $.fn.ezPlus === 'function') {
            $("#mainProductImage").ezPlus();
        }
    } catch (e) {
        console.warn("ezPlus zoom init failed:", e);
    }


    let priceEl = document.getElementById("product-price");
    let mrpEl = document.getElementById("product-mrp");

    let basePrice = priceEl ? parseFloat(priceEl.innerText) : 0;
    let baseMrp = mrpEl ? parseFloat(mrpEl.innerText) : 0;

    const qtyInputs = document.querySelectorAll(".quantity-input");

    function getQty() {
        let qty = parseInt(qtyInputs[0].value) || 1;
        return qty < 1 ? 1 : qty;
    }

    function syncQty(value) {
        qtyInputs.forEach(input => input.value = value);
    }

    function updateTotal() {
        let qty = getQty();
        syncQty(qty);

        const totalPrice = (basePrice * qty).toFixed(2);
        const totalMrp = (baseMrp * qty).toFixed(2);
        const hasDiscount = baseMrp > 0 && baseMrp > basePrice;

        if (document.getElementById("product-price"))
            document.getElementById("product-price").innerText = totalPrice;
        if (document.getElementById("sidebar-price"))
            document.getElementById("sidebar-price").innerText = totalPrice;
        if (document.getElementById("product-mrp"))
            document.getElementById("product-mrp").innerText = totalMrp;
        if (document.getElementById("sidebar-mrp"))
            document.getElementById("sidebar-mrp").innerText = totalMrp;

        const productMrpWrap = document.getElementById("product-mrp-wrap");
        const sidebarMrpWrap = document.getElementById("sidebar-mrp-wrap");
        if (productMrpWrap) productMrpWrap.style.display = hasDiscount ? "" : "none";
        if (sidebarMrpWrap) sidebarMrpWrap.style.display = hasDiscount ? "" : "none";
    }

    // manual typing
    qtyInputs.forEach(input => {
        input.addEventListener("input", function () {
            let val = parseInt(this.value) || 1;
            if (val < 1) val = 1;
            syncQty(val);
            updateTotal();
        });
    });

    // PLUS buttons
    document.querySelectorAll('.quantity-arrow-plus2').forEach(btn => {
        btn.addEventListener('click', function () {
            let input = this.parentElement.querySelector('.quantity-input');
            let value = (parseInt(input.value) || 1) + 1;
            syncQty(value);
            updateTotal();
        });
    });

    // MINUS buttons
    document.querySelectorAll('.quantity-arrow-minus2').forEach(btn => {
        btn.addEventListener('click', function () {
            let input = this.parentElement.querySelector('.quantity-input');
            let value = parseInt(input.value) || 1;
            value = value > 1 ? value - 1 : 1;
            syncQty(value);
            updateTotal();
        });
    });

    // variant change
    document.querySelectorAll('[data-price]').forEach(btn => {
        btn.addEventListener('click', function () {
            basePrice = parseFloat(this.dataset.price);
            baseMrp = parseFloat(this.dataset.mrp);
            updateTotal();

            const newImage = this.dataset.image;
            const mainImg = document.getElementById('mainProductImage');
            if (mainImg && newImage) {
                $('.zoomContainer').remove();
                $('#mainProductImage').removeData('ezPlus');
                mainImg.src = newImage;
                mainImg.setAttribute("data-zoom-image", newImage);
                $("#mainProductImage").ezPlus();
            }
        });
    });

})();


document.getElementById('shareProduct')?.addEventListener('click', function(e){
    e.preventDefault();

    const url = window.location.href;
    const title = document.title;

    if (navigator.share) {
        navigator.share({
            title: title,
            url: url
        });
    } else {
        navigator.clipboard.writeText(url);
        alert("Link copied! Share anywhere 👍");
    }
});

let selectedOption = document.querySelector('[data-option].active')?.dataset.option;

if(!selectedOption){
    selectedOption = document.querySelector('[data-option]')?.dataset.option;
}
// track variant change
document.querySelectorAll('[data-option]').forEach(btn=>{
    btn.addEventListener('click', function(){
        selectedOption = this.dataset.option;
    });
});

// add to cart
document.querySelectorAll('.add-to-cart-btn').forEach(btn=>{
    btn.addEventListener('click', function(e){
        e.preventDefault();

        const productId = this.dataset.product;
        const quantity = document.querySelector('.quantity-input').value || 1;

        Swal.fire({
            title: 'Adding to cart...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch("{{ route('cart.store') }}", {
            method: "POST",
            headers: {
                "Content-Type":"application/json",
                "X-CSRF-TOKEN":"{{ csrf_token() }}"
            },
            body: JSON.stringify({
                product_id: productId,
                product_option_id: selectedOption,
                quantity: quantity,
                device_id: localStorage.getItem("device_id")
            })
        })
        .then(res => res.json())
        .then(data => {

             if (data.cart_count !== undefined) {
                            document.getElementById("cart-count").innerText = data.cart_count;
                            document.getElementById("cart-total").innerText = "₹" + parseFloat(data.total_price).toFixed(2);
                            refreshMiniCart();
                        }

            Swal.fire({
                icon: 'success',
                title: 'Added to Cart!',
                text: 'Your product has been added successfully.',
                timer: 1500,
                showConfirmButton: false
            });
        })
        .catch(err => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Unable to add product'
            });
        });
    });
});


document.querySelectorAll('.buy-now-btn').forEach(btn=>{
    btn.addEventListener('click', function(e){
        e.preventDefault();

        const productId = this.dataset.product;
        const quantity = document.querySelector('.quantity-input').value || 1;

        Swal.fire({
            title: 'Processing...',
            text: 'Preparing checkout',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch("{{ route('cart.store') }}", {
            method: "POST",
            headers: {
                "Content-Type":"application/json",
                "X-CSRF-TOKEN":"{{ csrf_token() }}"
            },
            body: JSON.stringify({
                product_id: productId,
                product_option_id: selectedOption,
                quantity: quantity,
                device_id: localStorage.getItem("device_id")
            })
        })
        .then(res => res.json())
        .then(data => {

         if (data.cart_count !== undefined) {
                            document.getElementById("cart-count").innerText = data.cart_count;
                            document.getElementById("cart-total").innerText = "₹" + parseFloat(data.total_price).toFixed(2);
                            refreshMiniCart();
                        }

            Swal.fire({
                icon: 'success',
                title: 'Redirecting to checkout...',
                timer: 1000,
                showConfirmButton: false
            });

            setTimeout(()=>{
                window.location.href = "{{ route('checkout') }}";
            },1000);
        })
        .catch(err => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Unable to process Buy Now'
            });
        });
    });
});


document.querySelectorAll('.add-to-wishlist-btn').forEach(btn => {

    btn.addEventListener('click', function (e) {

        e.preventDefault();

        const button = this;
        const productId = button.dataset.product;

        Swal.fire({
            title: 'Updating Wishlist...',
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

            const heartIcon = button.querySelector('span, i');
            if (!heartIcon) return;

            if (data.status === "added") {
                heartIcon.style.color = "red";
            }

            if (data.status === "removed") {
                heartIcon.style.color = "";
            }

            if (data.status == "login_required") {
    window.location.href = "{{ route('customer.login') }}?redirect=" + encodeURIComponent(window.location.href);
}

            Swal.close();

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
document.querySelectorAll('.rating-star').forEach((star, index) => {

    star.addEventListener('click', function(e) {
        e.preventDefault();

        let rating = parseInt(this.dataset.value);
        document.getElementById('rating').value = rating;

        document.querySelectorAll('.rating-star').forEach((el, i) => {
            if (i < rating) {
                el.querySelector('i').style.color = '#f6b100';
            } else {
                el.querySelector('i').style.color = '#ccc';
            }
        });
    });

});



</script>

<script>
document.querySelectorAll(".productslider-wrapper").forEach(wrapper => {

    const track = wrapper.querySelector(".productslider-track");
    const prev  = wrapper.querySelector(".prev, .productslider-prev");
    const next  = wrapper.querySelector(".next, .productslider-next");

    if (!track || !prev || !next) return;

    let position = 0;
    const itemsVisible = window.innerWidth <= 768 ? 2
                        : window.innerWidth <= 992 ? 3
                        : 4;
    const step = 100 / itemsVisible;
    const maxPosition = -Math.max(track.children.length - itemsVisible, 0) * step;

    next.addEventListener("click", () => {
        position = Math.max(position - step, maxPosition);
        track.style.transform = `translateX(${position}%)`;
    });

    prev.addEventListener("click", () => {
        position = Math.min(position + step, 0);
        track.style.transform = `translateX(${position}%)`;
    });
});
</script>

@endsection