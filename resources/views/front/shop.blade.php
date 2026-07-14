@extends('front.app')

<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"-->
<!--    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">-->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"-->
<!--    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"-->
<!--    crossorigin="anonymous"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>-->

    @section('title', 
    isset($currentSubcategory) && $currentSubcategory
        ? ($currentSubcategory->meta_title ?? $currentSubcategory->name . ' Manufacturers & Dealers in Lucknow')
        : (isset($currentCategory) && $currentCategory
            ? ($currentCategory->meta_title ?? $currentCategory->name . ' Manufacturers & Dealers in Lucknow')
            : 'Shop Products'
        )
)

<style>
    .productcard-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        transition: .35s;
        border: 1px solid #f1f1f1;
    }

    .productcard-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(0, 0, 0, .15);
    }

    /* IMAGE */

    .productcard-image {
        position: relative;
        background: #f9fafc;
        padding: 15px;
        text-align: center;
    }

    .productcard-image {
        width: 100%;
        height: 320px !important;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
    }

    .productcard-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }



    /* ICONS */

    .productcard-icons {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .productcard-icon {
        background: #fff;
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        box-shadow: 0 4px 10px rgba(0, 0, 0, .15);
    }

    /* BODY */

    .productcard-body {
        padding: 0px 16px 16px 16px;
    }

    .productcard-category {
        font-size: 12px;
        color: #888;
        margin-bottom: 4px;
        background: #f1f1f145;
        border-radius: 4px;
        padding: 0px 10px;
    }

    .productcard-title {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 6px;
        margin-top: 10px;
    }

    .productcard-title a {
        color: #222;
        text-decoration: none;
    }

    /* RATING */

    .productcard-rating {
        font-size: 13px;
        margin-bottom: 6px;
    }

    .productcard-rating i {
        color: #ddd;
    }

    .productcard-rating i.active {
        color: #f6b100;
    }

    /* PRICE */

    .productcard-price {
        font-size: 17px;
        font-weight: 700;
        color: #222;
        margin-bottom: 10px;
    }

    .productcard-oldprice {
        font-size: 13px;
        color: #999;
        margin-left: 6px;
        text-decoration: line-through;
    }

    /* BUTTONS */

    .productcard-buttons {
        display: flex;
        gap: 8px;
    }

    .productcard-btn {
        flex: 1;
        padding: 8px;
        font-size: 13px;
        border-radius: 8px;
        text-align: center;
        text-decoration: none;
        font-weight: 600;
    }

    .productcard-cart {
        background: #eef2ff;
        color: #4f46e5;
    }

    .productcard-buy {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: #fff;
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

    @media(max-width:480px) {

        .ptb {
            padding: 15px 0px;
        }

        .productslider-item {
            flex: 0 0 50%;
        }

        .productcard-buttons {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .productcard-body {
            padding: 0px 7px 7px 7px;
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
            font-size: 12px;
            font-weight: 600;
            color: #222;
            margin-bottom: 6px;
        }

        .newmarging {
            margin-top: 10px;
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
</style>
<style>
    .productcard-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        transition: .35s;
        border: 1px solid #f1f1f1;
    }

    .productcard-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(0, 0, 0, .15);
    }

    /* IMAGE */

    .productcard-image {
        position: relative;
        background: #f9fafc;
        padding: 15px;
        text-align: center;
    }

    .productcard-image {
        width: 100%;
        height: 320px !important;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
    }

    .productcard-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }



    /* ICONS */

    .productcard-icons {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .productcard-icon {
        background: #fff;
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        box-shadow: 0 4px 10px rgba(0, 0, 0, .15);
    }

    /* BODY */

    .productcard-body {
        padding: 0px 16px 16px 16px;
    }

    .productcard-category {
        font-size: 12px;
        color: #888;
        margin-bottom: 4px;
        background: #f1f1f145;
        border-radius: 4px;
        padding: 0px 10px;
    }

    .productcard-title {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 6px;
        margin-top: 10px;
    }

    .productcard-title a {
        color: #222;
        text-decoration: none;
    }

    /* RATING */

    .productcard-rating {
        font-size: 13px;
        margin-bottom: 6px;
    }

    .productcard-rating i {
        color: #ddd;
    }

    .productcard-rating i.active {
        color: #f6b100;
    }

    /* PRICE */

    .productcard-price {
        font-size: 17px;
        font-weight: 700;
        color: #222;
        margin-bottom: 10px;
    }

    .productcard-oldprice {
        font-size: 13px;
        color: #999;
        margin-left: 6px;
        text-decoration: line-through;
    }

   .inner_page_breadcrumb {
    padding: 10px 0 !important;
    position: relative;
    background: #f9f9f9 !important;
}

    .productcard-buttons {
        display: flex;
        gap: 8px;
    }

    .productcard-btn {
        flex: 1;
        padding: 8px;
        font-size: 13px;
        border-radius: 8px;
        text-align: center;
        text-decoration: none;
        font-weight: 600;
    }

    .productcard-cart {
        background: #eef2ff;
        color: #4f46e5;
    }

    .productcard-buy {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: #fff;
    }

    .shop-v3-checkbox-label {
        font-size: 15px;
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
            font-size: 11px;
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
    }
</style>

@section('content')

    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="breadcrumb_content">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">Home</a>
                            </li>

 <li class="breadcrumb-item">
                                <a href="{{ route('shop.category') }}">Shop</a>
                            </li>
                            
                            @if($currentCategory)
                                <li class="breadcrumb-item">
                                    <a href="{{ route('shop.category', $currentCategory->slug) }}">
                                        {{ $currentCategory->name }}
                                    </a>
                                </li>
                            @endif

                            @if(isset($currentSubcategory) && $currentSubcategory)
                                <li class="breadcrumb-item active">
                                    {{ $currentSubcategory->name }}
                                </li>
                            @endif

                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="p0 bb1 overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="custom_shop_category_nav_list_menu">
                        <ul class="mb0 d-flex">

                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('shop.category', $category->slug) }}?{{ http_build_query(request()->except(['page'])) }}"
                                        class="{{ isset($currentCategory) && $currentCategory->id == $category->id ? 'active' : '' }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileFilterDrawer">

    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Filters</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">

       <form method="GET" id="filterFormMobile" action="{{ $currentSubcategory
        ? route('shop.category', [$currentCategory->slug, $currentSubcategory->slug])
        : ($currentCategory ? route('shop.category', $currentCategory->slug) : route('shop.category')) }}">

                            @if(request()->hasAny(['price', 'size', 'fragrance', 'deal', 'rating', 'sort', 'perPage']))
                                <a href="{{ url()->current() }}" class="btn btn-outline-danger btn-sm w-100 mb-4">
                                    <i class="fas fa-times me-2"></i> Clear Filters
                                </a>
                            @endif

                            <div class="accordion shop-v3-accordion" id="shopV3AccordionMobile">

                                <!-- Sub Categories -->
                                @if($subcategories->count())
                                    <div  class="accordion-item shop-v3-accordion-item border-0 mb-3 rounded-3 shadow-sm">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button shop-v3-accordion-btn fw-bold" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#v3subcat">
                                                Sub Categories
                                            </button>
                                        </h2>
                                        <div id="v3subcat" class="accordion-collapse collapse show">
                                            <div class="accordion-body shop-v3-accordion-body">
                                                <ul class="list-unstyled mb-0">
                                                    @foreach($subcategories as $sub)
                                                        <li class="mb-2">
                                                            <a href="{{ route('shop.category', [$currentCategory->slug, $sub->slug]) }}?{{ http_build_query(request()->except(['page'])) }}"
                                                                class="shop-v3-subcat-link {{ request()->segment(3) == $sub->slug ? 'active' : '' }}">
                                                                {{ $sub->name }}
                                                                <span
                                                                    class="badge bg-light text-muted float-end">{{ $sub->productssn_count }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Price -->
                                <div class="accordion-item shop-v3-accordion-item border-0 mb-3 rounded-3 shadow-sm">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed shop-v3-accordion-btn fw-bold"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#v3priceMobile">
                                            Price
                                        </button>
                                    </h2>
                                    <div id="v3priceMobile" class="accordion-collapse collapse">
                                        <div class="accordion-body shop-v3-accordion-body">
                                            @php $ranges = ['0-500', '500-1000', '1000-3000', '3000+']; @endphp
                                            @if(count($ranges))
                                                @foreach($ranges as $range)
                                                    <label class="shop-v3-checkbox-label d-flex align-items-center mb-2">
                                                        <input type="checkbox" name="price[]" value="{{ $range }}" class="me-2" {{ in_array($range, request('price', [])) ? 'checked' : '' }}>
                                                        ₹{{ str_replace('-', ' – ₹', $range) }}
                                                    </label>
                                                @endforeach
                                            @else
                                                <div class="shop-v3-no-data-mini text-center py-3">
                                                    <small class="text-muted">No price ranges available</small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Pack Size -->
                                <div class="accordion-item shop-v3-accordion-item border-0 mb-3 rounded-3 shadow-sm">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed shop-v3-accordion-btn fw-bold"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#v3size">
                                            Pack Size
                                        </button>
                                    </h2>
                                    <div id="v3size" class="accordion-collapse collapse">
                                        <div class="accordion-body shop-v3-accordion-body">
                                            @if(($packSizes ?? [])->count())
                                                @foreach($packSizes as $size)
                                                    <label class="shop-v3-checkbox-label d-flex align-items-center mb-2">
                                                        <input type="checkbox" name="size[]" value="{{ $size->id }}" class="me-2" {{ in_array($size->id, request('size', [])) ? 'checked' : '' }}>
                                                        {{ $size->quantity }} {{ $size->quantity_in }}
                                                    </label>
                                                @endforeach
                                            @else
                                                <div class="shop-v3-no-data-mini text-center py-3">
                                                    <small class="text-muted">No pack sizes available</small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Fragrance Type -->
                                <div class="accordion-item shop-v3-accordion-item border-0 mb-3 rounded-3 shadow-sm">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed shop-v3-accordion-btn fw-bold"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#v3fragrance">
                                            Fragrance Type
                                        </button>
                                    </h2>
                                    <div id="v3fragrance" class="accordion-collapse collapse">
                                        <div class="accordion-body shop-v3-accordion-body">
                                            @if(($fragranceTypes ?? [])->count())
                                                @foreach($fragranceTypes as $type)
                                                    <label class="shop-v3-checkbox-label d-flex align-items-center mb-2">
                                                        <input type="checkbox" name="fragrance[]" value="{{ $type->id }}"
                                                            class="me-2" {{ in_array($type->id, request('fragrance', [])) ? 'checked' : '' }}>
                                                        {{ $type->title }}
                                                    </label>
                                                @endforeach
                                            @else
                                                <div class="shop-v3-no-data-mini text-center py-3">
                                                    <small class="text-muted">No fragrance types available</small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Deals -->
                                <div class="accordion-item shop-v3-accordion-item border-0 mb-3 rounded-3 shadow-sm">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed shop-v3-accordion-btn fw-bold"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#v3deals">
                                            Deals & Offers
                                        </button>
                                    </h2>
                                    <div id="v3deals" class="accordion-collapse collapse">
                                        <div class="accordion-body shop-v3-accordion-body">
                                            <label class="shop-v3-checkbox-label d-flex align-items-center mb-2">
                                                <input type="checkbox" name="deal" value="1" class="me-2" {{ request('deal') ? 'checked' : '' }}>
                                                On Sale
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Rating -->
                                <div class="accordion-item shop-v3-accordion-item border-0 rounded-3 shadow-sm">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed shop-v3-accordion-btn fw-bold"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#v3rating">
                                            Customer Rating
                                        </button>
                                    </h2>
                                    <div id="v3rating" class="accordion-collapse collapse">
                                        <div class="accordion-body shop-v3-accordion-body">
                                            <label class="d-flex align-items-center mb-2" style="font-size:18px;">
                                                <input type="radio" name="rating" value="5" class="me-2" {{ request('rating') == 5 ? 'checked' : '' }}>
                                                ⭐⭐⭐⭐⭐
                                            </label>
                                            <label class="d-flex align-items-center mb-2" style="font-size:18px;">
                                                <input type="radio" name="rating" value="4" class="me-2" {{ request('rating') == 4 ? 'checked' : '' }}>
                                                ⭐⭐⭐⭐
                                            </label>
                                            <label class="d-flex align-items-center mb-2" style="font-size:18px;">
                                                <input type="radio" name="rating" value="3" class="me-2" {{ request('rating') == 3 ? 'checked' : '' }}>
                                                ⭐⭐⭐
                                            </label>
                                            <label class="d-flex align-items-center mb-2" style="font-size:18px;">
                                                <input type="radio" name="rating" value="2" class="me-2" {{ request('rating') == 2 ? 'checked' : '' }}>
                                                ⭐⭐
                                            </label>
                                            <label class="d-flex align-items-center mb-2" style="font-size:18px;">
                                                <input type="radio" name="rating" value="1" class="me-2" {{ request('rating') == 1 ? 'checked' : '' }}>
                                                ⭐
                                            </label>
                                            
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
    </div>

</div>

    <!-- Listing Grid View -->
    <section class="shop-v3-listing py-0 py-md-5 bg-light">
        <div class="container shop-v3-container">

            <div class="row g-4">

                <!-- Sidebar Filters -->
                <div class="col-lg-3 d-none d-lg-block shop-v3-sidebar-col">
                    <div class="shop-v3-sidebar shadow rounded-4 bg-white p-4 position-sticky" style="top: 90px;">

                        <h5 class="shop-v3-filters-title mb-4 fw-bold">Filters</h5>

                        <form method="GET" id="filterForm" action="{{ $currentSubcategory
        ? route('shop.category', [$currentCategory->slug, $currentSubcategory->slug])
        : ($currentCategory ? route('shop.category', $currentCategory->slug) : route('shop.category')) }}">

                            @if(request()->hasAny(['price', 'size', 'fragrance', 'deal', 'rating', 'sort', 'perPage']))
                                <a href="{{ url()->current() }}" class="btn btn-outline-danger btn-sm w-100 mb-4">
                                    <i class="fas fa-times me-2"></i> Clear Filters
                                </a>
                            @endif

                            <div class="accordion shop-v3-accordion" id="shopV3Accordion">

                                <!-- Sub Categories -->
                                @if($subcategories->count())
                                    <div  class="accordion-item shop-v3-accordion-item border-0 mb-3 rounded-3 shadow-sm">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button shop-v3-accordion-btn fw-bold" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#v3subcat">
                                                Sub Categories
                                            </button>
                                        </h2>
                                        <div id="v3subcat" class="accordion-collapse collapse show">
                                            <div class="accordion-body shop-v3-accordion-body">
                                                <ul class="list-unstyled mb-0">
                                                    @foreach($subcategories as $sub)
                                                        <li class="mb-2">
                                                            <a href="{{ route('shop.category', [$currentCategory->slug, $sub->slug]) }}?{{ http_build_query(request()->except(['page'])) }}"
                                                                class="shop-v3-subcat-link {{ request()->segment(3) == $sub->slug ? 'active' : '' }}">
                                                                {{ $sub->name }}
                                                                <span
                                                                    class="badge bg-light text-muted float-end">{{ $sub->productssn_count }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Price -->
                                <div class="accordion-item shop-v3-accordion-item border-0 mb-3 rounded-3 shadow-sm">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed shop-v3-accordion-btn fw-bold"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#v3price">
                                            Price
                                        </button>
                                    </h2>
                                    <div id="v3price" class="accordion-collapse collapse">
                                        <div class="accordion-body shop-v3-accordion-body">
                                            @php $ranges = ['0-500', '500-1000', '1000-3000', '3000+']; @endphp
                                            @if(count($ranges))
                                                @foreach($ranges as $range)
                                                    <label class="shop-v3-checkbox-label d-flex align-items-center mb-2">
                                                        <input type="checkbox" name="price[]" value="{{ $range }}" class="me-2" {{ in_array($range, request('price', [])) ? 'checked' : '' }}>
                                                        ₹{{ str_replace('-', ' – ₹', $range) }}
                                                    </label>
                                                @endforeach
                                            @else
                                                <div class="shop-v3-no-data-mini text-center py-3">
                                                    <small class="text-muted">No price ranges available</small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Pack Size -->
                                <div class="accordion-item shop-v3-accordion-item border-0 mb-3 rounded-3 shadow-sm">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed shop-v3-accordion-btn fw-bold"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#v3size">
                                            Pack Size
                                        </button>
                                    </h2>
                                    <div id="v3size" class="accordion-collapse collapse">
                                        <div class="accordion-body shop-v3-accordion-body">
                                            @if(($packSizes ?? [])->count())
                                                @foreach($packSizes as $size)
                                                    <label class="shop-v3-checkbox-label d-flex align-items-center mb-2">
                                                        <input type="checkbox" name="size[]" value="{{ $size->id }}" class="me-2" {{ in_array($size->id, request('size', [])) ? 'checked' : '' }}>
                                                        {{ $size->quantity }} {{ $size->quantity_in }}
                                                    </label>
                                                @endforeach
                                            @else
                                                <div class="shop-v3-no-data-mini text-center py-3">
                                                    <small class="text-muted">No pack sizes available</small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Fragrance Type -->
                                <div class="accordion-item shop-v3-accordion-item border-0 mb-3 rounded-3 shadow-sm">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed shop-v3-accordion-btn fw-bold"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#v3fragrance">
                                            Fragrance Type
                                        </button>
                                    </h2>
                                    <div id="v3fragrance" class="accordion-collapse collapse">
                                        <div class="accordion-body shop-v3-accordion-body">
                                            @if(($fragranceTypes ?? [])->count())
                                                @foreach($fragranceTypes as $type)
                                                    <label class="shop-v3-checkbox-label d-flex align-items-center mb-2">
                                                        <input type="checkbox" name="fragrance[]" value="{{ $type->id }}"
                                                            class="me-2" {{ in_array($type->id, request('fragrance', [])) ? 'checked' : '' }}>
                                                        {{ $type->title }}
                                                    </label>
                                                @endforeach
                                            @else
                                                <div class="shop-v3-no-data-mini text-center py-3">
                                                    <small class="text-muted">No fragrance types available</small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Deals -->
                                <div class="accordion-item shop-v3-accordion-item border-0 mb-3 rounded-3 shadow-sm">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed shop-v3-accordion-btn fw-bold"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#v3deals">
                                            Deals & Offers
                                        </button>
                                    </h2>
                                    <div id="v3deals" class="accordion-collapse collapse">
                                        <div class="accordion-body shop-v3-accordion-body">
                                            <label class="shop-v3-checkbox-label d-flex align-items-center mb-2">
                                                <input type="checkbox" name="deal" value="1" class="me-2" {{ request('deal') ? 'checked' : '' }}>
                                                On Sale
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Rating -->
                                <div class="accordion-item shop-v3-accordion-item border-0 rounded-3 shadow-sm">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed shop-v3-accordion-btn fw-bold"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#v3rating">
                                            Customer Rating
                                        </button>
                                    </h2>
                                    <div id="v3rating" class="accordion-collapse collapse">
                                        <div class="accordion-body shop-v3-accordion-body">
                                            <label class="d-flex align-items-center mb-2" style="font-size:18px;">
                                                <input type="radio" name="rating" value="5" class="me-2" {{ request('rating') == 5 ? 'checked' : '' }}>
                                                ⭐⭐⭐⭐⭐
                                            </label>
                                            <label class="d-flex align-items-center mb-2" style="font-size:18px;">
                                                <input type="radio" name="rating" value="4" class="me-2" {{ request('rating') == 4 ? 'checked' : '' }}>
                                                ⭐⭐⭐⭐
                                            </label>
                                            <label class="d-flex align-items-center mb-2" style="font-size:18px;">
                                                <input type="radio" name="rating" value="3" class="me-2" {{ request('rating') == 3 ? 'checked' : '' }}>
                                                ⭐⭐⭐
                                            </label>
                                            <label class="d-flex align-items-center mb-2" style="font-size:18px;">
                                                <input type="radio" name="rating" value="2" class="me-2" {{ request('rating') == 2 ? 'checked' : '' }}>
                                                ⭐⭐
                                            </label>
                                            <label class="d-flex align-items-center mb-2" style="font-size:18px;">
                                                <input type="radio" name="rating" value="1" class="me-2" {{ request('rating') == 1 ? 'checked' : '' }}>
                                                ⭐
                                            </label>
                                            
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-9 new-iz-products-area">

                    <div class="d-lg-none mb-3">
    <button class="btn btn-dark w-100"
        data-bs-toggle="offcanvas"
        data-bs-target="#mobileFilterDrawer">
        🔍 Filters
    </button>
</div>

   <!-- Main Header -->
                    <div class="new-iz-main-header d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                        <div>
                            <h2 class="new-iz-section-title mb-1 fw-bold">
                                {{ $currentSubcategory->name ?? ($currentCategory->name ?? 'All Products') }}
                            </h2>
                            <div class="text-muted small">{{ $products->total() }} products found</div>
                        </div>
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <!--<div class="d-flex align-items-center gap-2">-->
                            <!--    <small class="text-muted">Show:</small>-->
                            <!--    @foreach([12,24,36,60] as $n)-->
                            <!--        <a href="{{ request()->fullUrlWithQuery(['perPage' => $n, 'page' => 1]) }}"-->
                            <!--           class="{{ request('perPage',12) == $n ? 'fw-bold text-primary' : '' }}">{{ $n }}</a>-->
                            <!--    @endforeach-->
                            <!--</div>-->
                            <select name="sort" class="form-select form-select-sm new-iz-sort-select"
    onchange="this.closest('form') ? this.closest('form').submit() : document.getElementById('filterForm').submit()">
                                <option value="">Sort by</option>
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price Low →
                                    High
                                </option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price High
                                    →
                                    Low</option>
                            </select>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="row g-3 g-md-4 new-iz-product-grid" id="productsGrid">
                        @foreach($products as $product)
                            <div class="col-6 col-md-4 col-xl-4 product-item">
                                <div class="productcard-card">

                                    <!-- IMAGE -->
                                    <div class="productcard-image">

                                    <img src="{{ asset('storage/' . ($product->image_thumb ?? $product->image)) }}" alt="{{ $product->name }}">

                                        <!-- ACTION ICONS -->
                                        <div class="productcard-icons">

                                            <a href="#" class="productcard-icon add-to-wishlist-btn"
                                                data-product="{{ $product->id }}">
                                                <i class="flaticon-heart"
                                                    style="{{ collect($wishlistIds)->contains($product->id) ? 'color:red;' : '' }}"></i>
                                            </a>

                                            <a href="{{ url('product-details/' . $product->slug) }}" class="productcard-icon">
                                                <i class="flaticon-show"></i>
                                            </a>

                                        </div>

                                    </div>


                                    <!-- DETAILS -->
                                    <div class="productcard-body">

                                        <!-- CATEGORY -->
                                        <div class="productcard-category">
                                            {{ $product->subcategories->name ?? ($product->categories->name ?? '')}}
                                        </div>

                                        <!-- TITLE -->
                                        <h3 class="productcard-title">
                                            <a href="{{ url('product-details/' . $product->slug) }}">
                                                {{ Str::limit($product->name, 40) }}
                                            </a>
                                        </h3>


                                        <!-- RATING -->
                                        <div class="productcard-rating">

                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $product->avg_rating ? 'active' : '' }}"></i>
                                            @endfor

                                            <span>({{ $product->review_count }})</span>

                                        </div>


                                        <!-- PRICE -->
                                        <div class="productcard-price">

                                            ₹{{ $product->product_options[0]->price ?? $product->min_price }}

                                            @if(!empty($product->product_options[0]->mrp))
                                                <span class="productcard-oldprice">
                                                    ₹{{ $product->product_options[0]->mrp }}
                                                </span>
                                            @endif

                                        </div>


                                        <!-- BUTTONS -->
                                        <div class="productcard-buttons">

                                            <a href="#" class="productcard-btn productcard-cart add-to-cart-btn"
                                                data-product="{{ $product->id }}"
                                                data-option="{{ optional($product->product_options->first())->id }}">
                                                Add to Cart
                                            </a>

                                            <a href="{{ url('product-details/' . $product->slug) }}"
                                                class="productcard-btn productcard-buy">
                                                Buy Now
                                            </a>

                                        </div>

                                    </div>

                                </div>
                              
                            </div>
                        @endforeach
                    </div>

                    <!-- Load More -->
                    @if($products->hasMorePages())
                        <div class="text-center mt-5">
                            <button id="loadMoreBtn"
                                class="new-iz-loadmore-btn btn btn-thm btn-lg px-5 py-3 rounded-pill shadow-sm">
                                <i class="fas fa-plus me-2"></i> Load More (12 more)
                            </button>
                        </div>
                    @endif

                    <!-- No Products Found -->
                    @if($products->count() == 0)
                        <div class="new-iz-no-products card border-0 shadow-lg text-center py-5 my-5 bg-white rounded-4">
                            <div class="card-body">
                                <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
                                <h4 class="fw-bold text-secondary mb-3">No Products Found</h4>
                                <p class="lead text-muted mb-4">We couldn't find any products matching your current filters.</p>
                                <a href="{{ url()->current() }}" class="btn btn-thm btn-lg px-5 py-3 rounded-pill">
                                    Clear Filters & Browse All
                                </a>
                            </div>
                        </div>
                    @endif



                    @if($bestSellers->count())
                        <div class="new-iz-bestsellers mb-5">
                            <h2 class="new-iz-section-title mb-1 mb-md-4  fw-bold">
                                {{ $currentCategory ? $currentCategory->name . ' Best Sellers' : 'Best Sellers' }}
                            </h2>

                            <div class="row g-3 g-md-4 new-iz-product-grid">
                                @foreach($bestSellers as $product)
                                    <div class="col-6 col-md-4 col-xl-4 product-item">
                                        <div class="productcard-card">

                                            <!-- IMAGE -->
                                            <div class="productcard-image">

                                                <img src="{{ asset('storage/' . ($product->image_thumb ?? $product->image)) }}" alt="{{ $product->name }}">

                                                <!-- ACTION ICONS -->
                                                <div class="productcard-icons">

                                                    <a href="#" class="productcard-icon add-to-wishlist-btn"
                                                        data-product="{{ $product->id }}">
                                                        <i class="flaticon-heart"
                                                            style="{{ collect($wishlistIds)->contains($product->id) ? 'color:red;' : '' }}"></i>
                                                    </a>

                                                    <a href="{{ url('product-details/' . $product->slug) }}"
                                                        class="productcard-icon">
                                                        <i class="flaticon-show"></i>
                                                    </a>

                                                </div>
                                            </div>

                                            <!-- DETAILS -->
                                            <div class="productcard-body">

                                                <!-- CATEGORY -->
                                                <div class="productcard-category">
                                                    {{ $product->subcategories->name ?? ($product->categories->name ?? '')}}
                                                </div>

                                                <!-- TITLE -->
                                                <h3 class="productcard-title">
                                                    <a href="{{ url('product-details/' . $product->slug) }}">
                                                        {{ Str::limit($product->name, 40) }}
                                                    </a>
                                                </h3>


                                                <!-- RATING -->
                                                <div class="productcard-rating">

                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $product->avg_rating ? 'active' : '' }}"></i>
                                                    @endfor

                                                    <span>({{ $product->review_count }})</span>

                                                </div>


                                                <!-- PRICE -->
                                                <div class="productcard-price">

                                                    ₹{{ $product->product_options[0]->price ?? $product->min_price }}

                                                    @if(!empty($product->product_options[0]->mrp))
                                                        <span class="productcard-oldprice">
                                                            ₹{{ $product->product_options[0]->mrp }}
                                                        </span>
                                                    @endif

                                                </div>


                                                <!-- BUTTONS -->
                                                <div class="productcard-buttons">

                                                    <a href="#" class="productcard-btn productcard-cart add-to-cart-btn"
                                                        data-product="{{ $product->id }}"
                                                        data-option="{{ optional($product->product_options->first())->id }}">
                                                        Add to Cart
                                                    </a>

                                                    <a href="{{ url('product-details/' . $product->slug) }}"
                                                        class="productcard-btn productcard-buy">
                                                        Buy Now
                                                    </a>

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                
                </div>

                <!-- Load More Script -->
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        let currentPage = {{ $products->currentPage() }};
                        const loadMoreBtn = document.getElementById('loadMoreBtn');
                        if (loadMoreBtn) {
                            loadMoreBtn.addEventListener('click', function () {
                                currentPage++;
                                const url = new URL(window.location.href);
                                url.searchParams.set('page', currentPage);
                                url.searchParams.set('perPage', 12);
                                fetch(url.toString(), {
                                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                                })
                                    .then(response => response.text())
                                    .then(html => {
                                        const parser = new DOMParser();
                                        const doc = parser.parseFromString(html, 'text/html');
                                        const newItems = doc.querySelectorAll('.product-item');
                                        const grid = document.getElementById('productsGrid');
                                        newItems.forEach(item => grid.appendChild(item));
                                        if (!doc.querySelector('#loadMoreBtn')) {
                                            loadMoreBtn.style.display = 'none';
                                        }
                                    })
                                    .catch(() => alert('Error loading more products'));
                            });
                        }
                    });
                </script>

                <!-- Complete Custom CSS -->
                <style>
                    /* General */
                    .new-iz-section-title {
                        font-size: 1.9rem;
                        letter-spacing: -0.5px;
                        color: #111;
                        margin-top:20px;
                    }

                    /* Product Card */
                    .new-iz-product-card {
                        padding: 10px;
                        transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
                        border: none;
                        border-radius: 16px;
                        overflow: hidden;
                        background: white;
                        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
                    }

                    .new-iz-product-card:hover {
                        transform: translateY(-12px);
                        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15) !important;
                    }

                    .new-iz-img-wrapper {
                        position: relative;
                        overflow: hidden;
                    }

                    .new-iz-overlay {
                        opacity: 1;

                        backdrop-filter: blur(8px);
                        transition: opacity 0.35s ease;
                        z-index: 10;
                    }

                    .new-iz-product-card:hover .new-iz-overlay {
                        opacity: 1;
                    }

                    .new-iz-action-btn {
                        min-width: 49%;
                        font-size: 0.95rem;
                        font-weight: 600;
                        transition: all 0.25s ease;
                        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                    }

                    .new-iz-action-btn:hover {
                        transform: translateY(-3px);
                        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                    }

                    .new-iz-category-badge {
                        font-size: 0.82rem;
                        padding: 5px 14px;
                        z-index: 5;
                        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
                    }

                    .new-iz-title {
                        font-size: 1.08rem;
                        line-height: 1.35;
                        min-height: 2.8em;
                        overflow: hidden;
                        display: -webkit-box;
                        -webkit-line-clamp: 2;
                        -webkit-box-orient: vertical;
                    }

                    .new-iz-rating {
                        font-size: 0.95rem;
                    }

                    .new-iz-price {
                        font-size: 1.45rem;
                        letter-spacing: -0.5px;
                    }

                    /* Load More Button */
                    .new-iz-loadmore-btn {
                        font-size: 1.1rem;
                        padding: 14px 40px !important;
                        transition: all 0.3s;
                    }

                    .new-iz-loadmore-btn:hover {
                        transform: translateY(-3px);
                        box-shadow: 0 10px 30px rgba(13, 110, 253, 0.3);
                    }

                    /* No Products */
                    .new-iz-no-products {
                        /* max-width: 680px; */
                        margin: 6rem auto;
                        border-radius: 20px;
                    }
                </style>


            </div>
        </div>

        <!-- Custom Styles -->

    </section>

    <style>
        .shop-v3-section-title {
            font-size: 1.8rem;
            letter-spacing: -0.5px;
            color: #111;
        }

        .shop-v3-accordion-btn {
            background: #f8f9fa !important;
            border-radius: 10px !important;
            font-size: 1.05rem;
        }

        .shop-v3-accordion-btn:not(.collapsed) {
            background: #e3f2fd !important;
            color: #0d6efd !important;
        }

        .shop-v3-checkbox-label input {
            accent-color: #0d6efd;
            transform: scale(1.15);
            margin-right: 10px;
        }

        .shop-v3-no-data-mini {
            background: #f8f9fa;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .shop-v3-product-card {
            transition: all 0.28s ease;
            border: none;
        }

        .shop-v3-product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12) !important;
        }

        .shop-v3-img-wrapper {
            overflow: hidden;
        }

        .shop-v3-overlay {
            background: rgba(13, 110, 253, 0.75);
            backdrop-filter: blur(4px);
            transition: opacity 0.28s;
        }

        .shop-v3-quick-btn {
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
            transition: all 0.2s;
        }

        .shop-v3-quick-btn:hover {
            background: #0d6efd;
            color: white !important;
            transform: scale(1.1);
        }

        .shop-v3-no-products {
            max-width: 620px;
            margin: 6rem auto;
        }
    </style>
    <!-- Load More AJAX Script (unchanged) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let currentPage = {{ $products->currentPage() }};
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function () {
                    currentPage++;
                    const url = new URL(window.location.href);
                    url.searchParams.set('page', currentPage);
                    url.searchParams.set('perPage', 12);
                    fetch(url.toString(), {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newItems = doc.querySelectorAll('.product-item');
                            const grid = document.getElementById('productsGrid');
                            newItems.forEach(item => grid.appendChild(item));
                            if (!doc.querySelector('#loadMoreBtn')) {
                                loadMoreBtn.style.display = 'none';
                            }
                        })
                        .catch(() => alert('Error loading more products'));
                });
            }
        });
    </script>

    <!-- Final CSS (add/replace in your <style> tag) -->
    <style>
        .shop-v3-product-card {
            transition: all 0.3s ease;
            border: none;
        }

        .shop-v3-product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12) !important;
        }

        .shop-v3-overlay {
            opacity: 0;
            transition: opacity 0.35s ease;
            z-index: 10;
            backdrop-filter: blur(5px);
        }

        .shop-v3-product-card:hover .shop-v3-overlay {
            opacity: 1;
        }

        .shop-v3-action-btn {
            min-width: 140px;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .shop-v3-action-btn:hover {
            transform: scale(1.08);
        }

        .shop-v3-category-badge {
            font-size: 0.8rem;
            z-index: 5;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .shop-v3-title {
            font-size: 1.05rem;
            line-height: 1.35;
            min-height: 2.8em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .shop-v3-price {
            font-size: 1.4rem;
        }

        .shop-v3-rating {
            font-size: 0.95rem;
        }

        .shop-v3-no-products {
            max-width: 650px;
            margin: 6rem auto;
        }
    </style>
    <script>
       document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll("#filterForm input, #filterForm select, #filterFormMobile input, #filterFormMobile select")
        .forEach(el => {
            el.addEventListener("change", function () {
                this.closest("form").submit();
            });
        });

});
    </script>


    <script>

        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {

            btn.addEventListener('click', function (e) {

                e.preventDefault();

                const productId = this.dataset.product;
                const optionId = this.dataset.option || null;
                const quantity = 1;

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

if (!heartIcon) return; // stop error


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