@extends('front.app')

@section('title', 'Product Details')

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
                $images[] = $img->image;
            }
        }

        if (empty($images) && $product->image) {
            $images[] = $product->image;
        }
    @endphp

    <!-- Shop Single Content -->
    <section class="shop-single-content pb80 pt0 ovh">
        <div class="container">
            <div class="row wrap">
                <div class="col-xl-7">
                    <div class="column">
                        <div class="shop_single_natabmenu">
                            <div class="d-block d-sm-flex align-items-start">

                                <!-- Thumbnails -->
                                <div class="nav flex-column nav-pills me-0 me-md-3" id="v-pills-tab2" role="tablist"
                                    aria-orientation="vertical">

                                    @foreach($images as $key => $img)
                                        <button class="nav-link {{ $key == 0 ? 'active' : '' }}" id="v-pills-tab-{{ $key }}"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-img-{{ $key }}" type="button"
                                            role="tab">
                                            <img src="{{ asset('storage/' . $img) }}" alt="">
                                        </button>
                                    @endforeach

                                </div>

                                <!-- Main Images -->
                                <div class="tab-content m-auto" id="v-pills-tabContent2">

                                    @foreach($images as $key => $img)

                                        @php
                                            // create zoom id like zoom_01, zoom_02
                                            $zoomId = 'zoom_' . str_pad($key + 1, 2, '0', STR_PAD_LEFT);
                                        @endphp

                                        <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}"
                                            id="v-pills-img-{{ $key }}" role="tabpanel">

                                            <div class="shop_single_navmenu_content justify-content-center">

                                                <!-- Popup -->
                                                <a class="product_popup popup-img" href="{{ asset('storage/' . $img) }}">
                                                    <span class="flaticon-full-screen"></span>
                                                </a>

                                                <!-- Zoom -->
                                                <div class="zoomimg_wrapper m-auto">
                                                    <img class="zoom-img main-product-image" id="mainProductImage"
                                                        src="{{ asset('storage/' . $img) }}"
                                                        data-zoom-image="{{ asset('storage/' . $img) }}" width="410"
                                                        alt="Product Image">
                                                </div>

                                            </div>
                                        </div>

                                    @endforeach

                                </div>

                            </div>
                        </div>
                        <div class="shop_single_product_details ps-0 mt-4 d-block d-xl-none">
                            <div class="sspd_price mt-4 mb25">
                                ₹<span id="product-price">{{ $product->product_options->first()->price }}</span>
                                <small>
                                    <del>₹<span id="product-mrp">{{ $product->product_options->first()->mrp }}</span></del>
                                </small>
                            </div>
                            @if(!empty($product->fragrance_names))
                                <div class="mb-3">
                                    <h6 class="title mb-2">Fragrance:</h6>

                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($product->fragrance_names as $name)
                                            <span class="badge bg-light border text-dark px-3 py-2">
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
                                <ul class="shop_single_wishlist_area db-400 d-flex align-items-center mb-3">
                                    <li class="pe-2 ms-2 ms-sm-0">
                                        <a href="#" class="add-to-wishlist-btn" data-product="{{ $product->id }}">
    <span class="flaticon-heart me-2"
        style="{{ collect($wishlistIds)->contains($product->id) ? 'color:red;' : '' }}">
    </span>
    Wishlist
</a>
                                </li>
                                                
                                    <li class="pe-2 ms-2"><a href="#"><span class="flaticon-graph me-2"></span>Compare</a>
                                    </li>
                                    <li class="pe-2 ms-2"><a href="#"><span class="flaticon-question me-2"></span>Ask a
                                            Question</a></li>
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
                            <div class="vendor_iconbox style2 d-flex mb-1 mt-4">
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
                            <hr>
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
                                                      
                                                        <div class="all_review_btn mb30">
                                                            <a href="#" class="btn btn-lg btn-white bdr_thm">Write Your
                                                                Review</a>
                                                        </div>
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
                                                                            <img src="{{ asset('front/images/blog/reviewer2.png') }}"
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
                                                                                                        <i
                                                                                                            class="fas fa-star {{ $i <= $review->rating ? '' : 'text-muted' }}"></i>
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
                                                                                {{ $review->customer_name ?? 'Customer' }}
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
                                                        <div class="bsp_reveiw_wrt mb-0">
                                                            <form class="comments_form">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <h4 class="title mb20">Add a Review</h4>
                                                                        <p class="heading-color">Your email address will not
                                                                            be published. Required fields are marked *</p>
                                                                        <h5 class="mb0">Your rating of this product</h5>
                                                                        <div class="sspd_postdate vendor_single">
                                                                            <div class="sspd_review">
                                                                                <ul class="mb0">
                                                                                    <li class="list-inline-item"><a
                                                                                            href="#"><i
                                                                                                class="fas fa-star"></i></a>
                                                                                    </li>
                                                                                    <li class="list-inline-item"><a
                                                                                            href="#"><i
                                                                                                class="fal fa-star"></i></a>
                                                                                    </li>
                                                                                    <li class="list-inline-item"><a
                                                                                            href="#"><i
                                                                                                class="fal fa-star"></i></a>
                                                                                    </li>
                                                                                    <li class="list-inline-item"><a
                                                                                            href="#"><i
                                                                                                class="fal fa-star"></i></a>
                                                                                    </li>
                                                                                    <li class="list-inline-item"><a
                                                                                            href="#"><i
                                                                                                class="fal fa-star"></i></a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="heading-color mb10">Your
                                                                                review</label>
                                                                            <textarea class="form-control"
                                                                                rows="6"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="heading-color mb10">Name</label>
                                                                            <input type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="heading-color mb10">Email</label>
                                                                            <input type="email" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                value="" id="defaultCheck1">
                                                                            <label class="form-check-label"
                                                                                for="defaultCheck1">Save my name, email, and
                                                                                website in this browser for the next time I
                                                                                comment.</label>
                                                                        </div>
                                                                        <br>
                                                                        <button type="submit"
                                                                            class="btn btn-thm">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
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
                </div>
                <div class="col-xl-4 scroll-to-fixed-parent offset-xl-1 d-none d-xl-block">
                    <div class="column scroll-to-fixed-child">
                        <div class="shop_single_product_details sidebar mb-3 mb-xl-0">
                            <ul class="db-400 d-flex">
                                <li class="border-right heading-color fz14">
                                    {{ $product->categories->name ?? 'Brand' }}
                                </li>
                                <li class="mx-3 ml0-400">
                                    <div class="sspd_review mt-0">
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
                                </li>
                                <li class="border-right me-3 heading-color fz14">
                                    {{ $product->reviews_count ?? 0 }} reviews
                                </li>
                                <li class="color-light-green fz14">
                                    {{ $product->stock ?? 0 }} in stock
                                </li>
                            </ul>
                            <h4 class="title">{{ $product->name }}</h4>
                            <p class="mb15">{!! nl2br(e($product->short_description)) !!}</p>
                            <hr>
                            <div class="sspd_price mb20 mt20">
                                ₹<span id="sidebar-price">{{ $product->product_options->first()->price }}</span>

                                <small>
                                    <del>₹<span id="sidebar-mrp">{{ $product->product_options->first()->mrp }}</span></del>
                                </small>
                            </div>
                            @if(!empty($product->fragrance_names))
                                <div class="mb-3">
                                    <h6 class="title mb-2">Fragrance:</h6>

                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($product->fragrance_names as $name)
                                            <span class="badge bg-light border text-dark px-3 py-2">
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
                            <ul class="cart_btn_widget shop_single3_style align-items-center mb-1">
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
                                <li class="pe-2 ms-2"><a href="#"><span class="flaticon-graph me-2"></span>Compare</a></li>
                                <li class="pe-2 ms-2"><a href="#"><span class="flaticon-question me-2"></span>Ask a
                                        Question</a></li>
                                <li class="ms-2"><a href="#" id="shareProduct">
    <span class="flaticon-share me-2"></span>Share
</a></li></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h2 class="title">Related products</h2>
                    </div>
                    <div
                        class="navi_pagi_top_right related_product_slider slider_dib_sm shop_item_6grid_slider owl-theme owl-carousel">
                        @foreach($relatedProducts as $item)
                            <div class="item">
                                <div class="shop_item small_style bdr1 px-2 px-sm-3 mx--1">
                                    <div class="thumb pb30">
                                        <img class="w100" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                                        <div class="thumb_info">
                                            <ul class="mb0">
                                                            <li>
    <a href="#" class="add-to-wishlist-btn"
        data-product="{{ $item->id }}">
        <span class="flaticon-heart"
                                                            style="{{ collect($wishlistIds)->contains($item->id) ? 'color:red;' : '' }}">
                                                        </span>
    </a>
</li>
                                                <li><a href="{{ url('product-details/' . $item->slug) }}"><span
                                                            class="flaticon-show"></span></a>
                                                </li>
                                                <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="shop_item_cart_btn d-grid">
                                            <a href="#" class="btn btn-thm add-to-cart-btn" data-product="{{ $item->id }}">
                                        Add to cart
                                    </a>
                                        </div>
                                    </div>
                                    <div class="details">
                                        <div class="sub_title">
                                            {{ $item->categories->name ?? '' }}
                                        </div>
                                        <div class="title">
                                            <a href="{{ route('product-details', $item->slug) }}">
                                                {{ Str::limit($item->name, 60) }}
                                            </a>
                                        </div>
                                        <div class="review d-flex db-500">
                                            <ul class="mb0 me-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <li class="list-inline-item">
                                                        <a href="#">
                                                            <i
                                                                class="fas fa-star {{ $i <= $item->avg_rating ? '' : 'text-muted' }}"></i>
                                                        </a>
                                                    </li>
                                                @endfor
                                            </ul>

                                            <div class="review_count">
                                                <a href="#">{{ $item->review_count }} reviews</a>
                                            </div>
                                        </div>
                                        <div class="si_footer">
                                            <div class="price">
                                                ₹{{ $item->product_options[0]->price ?? $item->min_price }}

                                                @if(!empty($item->product_options[0]->mrp))
                                                    <small>
                                                        <del>₹{{ $item->product_options[0]->mrp }}</del>
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mt50">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h2 class="title">You may also like</h2>
                    </div>
                    <div
                        class="navi_pagi_top_right related_product_slider slider_dib_sm shop_item_6grid_slider owl-theme owl-carousel">
                        @foreach($recommendedProducts as $item)
                            <div class="item">
                                <div class="shop_item small_style bdr1 px-2 px-sm-3 mx--1">
                                    <div class="thumb pb30">
                                        <img class="w100" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                                        <div class="thumb_info">
                                            <ul class="mb0">
                                               <li>
    <a href="#" class="add-to-wishlist-btn"
        data-product="{{ $item->id }}">
       <span class="flaticon-heart"
                                                            style="{{ collect($wishlistIds)->contains($item->id) ? 'color:red;' : '' }}">
                                                        </span>
    </a>
</li>
                                                <li><a href="{{ url('product-details/' . $item->slug) }}"><span
                                                            class="flaticon-show"></span></a>
                                                </li>
                                                <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="shop_item_cart_btn d-grid">
                                              <a href="#" class="btn btn-thm add-to-cart-btn" data-product="{{ $item->id }}">
                                        Add to cart
                                    </a>
                                        </div>
                                    </div>
                                    {{-- DETAILS --}}
                                    <div class="details">

                                        {{-- BRAND / CATEGORY --}}
                                        <div class="sub_title">
                                            {{ $item->subcategories->name ?? ($item->categories->name ?? '')}}
                                        </div>

                                        {{-- NAME --}}
                                        <div class="title">
                                            <a href="{{ url('product-details/' . $item->slug) }}">
                                                {{ Str::limit($item->name, 40) }}
                                            </a>
                                        </div>

                                        {{-- RATING --}}
                                        <div class="review d-flex db-500">
                                            <ul class="mb0 me-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <li class="list-inline-item">
                                                        <a href="#">
                                                            <i
                                                                class="fas fa-star {{ $i <= $item->avg_rating ? '' : 'text-muted' }}"></i>
                                                        </a>
                                                    </li>
                                                @endfor
                                            </ul>

                                            <div class="review_count">
                                                <a href="#">{{ $item->review_count }} reviews</a>
                                            </div>
                                        </div>
                                        {{-- PRICE --}}
                                        <div class="si_footer">
                                            <div class="price">
                                                ₹{{ $item->product_options[0]->price ?? $item->min_price }}

                                                @if(!empty($item->product_options[0]->mrp))
                                                    <small>
                                                        <del>₹{{ $item->product_options[0]->mrp }}</del>
                                                    </small>
                                                @endif
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

    <script>

        document.addEventListener("DOMContentLoaded", function () {

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

                if (document.getElementById("product-price"))
                    document.getElementById("product-price").innerText = totalPrice;

                if (document.getElementById("sidebar-price"))
                    document.getElementById("sidebar-price").innerText = totalPrice;

                if (document.getElementById("product-mrp"))
                    document.getElementById("product-mrp").innerText = totalMrp;

                if (document.getElementById("sidebar-mrp"))
                    document.getElementById("sidebar-mrp").innerText = totalMrp;
            }

            // manual typing
            qtyInputs.forEach(input => {
                input.addEventListener("input", updateTotal);
            });

            // PLUS buttons
            document.querySelectorAll('.quantity-arrow-plus2').forEach(btn => {
                btn.addEventListener('click', function () {
                    let input = this.parentElement.querySelector('.quantity-input');
                    let value = parseInt(input.value) || 1;
                    value++;
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
        baseMrp   = parseFloat(this.dataset.mrp);

        updateTotal();

        // 🔥 change main image
        const newImage = this.dataset.image;
        const mainImg = document.getElementById('mainProductImage');

        if(mainImg && newImage){
            mainImg.src = newImage;
            mainImg.setAttribute("data-zoom-image", newImage);
        }
    });
});
        });
  
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

        // 🔵 show loading
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

        // 🔵 show loading
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

            const heartIcon = button.querySelector('span');

            if (data.status === "added") {
                heartIcon.style.color = "red";
            }

            if (data.status === "removed") {
                heartIcon.style.color = "";
            }

            if (data.status === "login_required") {
                window.location.href = "/customer/login";
                return;
            }

            // ✅ close loading
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
@endsection