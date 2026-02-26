@extends('front.app')

@section('title', 'Page Vendor List')

@section('content')

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

  <section class="inner_page_breadcrumb">
    <div class="container">
      <div class="row">
        <div class="col-xl-6">
          <div class="breadcrumb_content">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Home</a>
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

  <!-- Listing Grid View -->
  <section class="our-listing pt0">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-xl-2 d-none d-lg-block">
          <div class="sidebar_accordion_widget">
            <div class="faq_according text-start">
              <form method="GET" id="filterForm" action="{{ $currentSubcategory
    ? route('shop.category', [$currentCategory->slug, $currentSubcategory->slug])
    : ($currentCategory
      ? route('shop.category', $currentCategory->slug)
      : route('shop.category')) }}">
                @if(request()->hasAny(['price', 'size', 'fragrance', 'deal', 'rating', 'sort', 'perPage']))
                  <div class="mb-3">
                    <a href="{{ url()->current() }}" class="btn btn-sm btn-outline-secondary w-100">
                      Clear Filters
                    </a>
                  </div>
                @endif
                <div class="accordion" id="accordionExample">

                  <!-- ✅ SUB CATEGORIES -->
                  <div class="card">
                    <div class="card-header active" id="headingZero">
                      <h4>
                        <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseZero">
                          Sub Categories
                        </button>
                      </h4>
                    </div>
                    <div id="collapseZero" class="collapse show">
                      <div class="card-body">

                        @if($subcategories->count())
                          <div class="left_sidebar_department_widgets">
                            <ul class="list-unstyled ps-0">
                              @foreach($subcategories as $sub)
                                <li>
                                  <a href="{{ route('shop.category', [$currentCategory->slug, $sub->slug]) }}?{{ http_build_query(request()->except(['page'])) }}"
                                    class="{{ request()->segment(3) == $sub->slug ? 'fw-bold text-primary' : '' }}">
                                    {{ $sub->name }}
                                    <span class="float-end">{{ $sub->productssn_count }}</span>
                                  </a>
                                </li>
                              @endforeach
                            </ul>
                          </div>
                        @endif

                      </div>
                    </div>
                  </div>

                  <!-- ✅ PRICE RANGE -->
                  <div class="card">
                    <div class="card-header" id="headingPrice">
                      <h4>
                        <button class="btn btn-link text-start" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapsePrice">
                          Price
                        </button>
                      </h4>
                    </div>
                    <div id="collapsePrice" class="collapse show">
                      <div class="card-body">
                        <div class="ui_kit_checkbox pb30">

                          @php $priceRanges = ['0-500', '500-1000', '1000-3000', '3000+']; @endphp

                          @foreach($priceRanges as $range)
                            <label class="custom_checkbox">
                              ₹{{ str_replace('-', ' - ₹', $range) }}
                              <input type="checkbox" name="price[]" value="{{ $range }}" {{ in_array($range, request('price', [])) ? 'checked' : '' }}>
                              <span class="checkmark"></span>
                            </label>
                          @endforeach

                        </div>
                      </div>
                    </div>
                  </div>


                  <!-- ✅ PACK SIZE -->
                  <div class="card">
                    <div class="card-header" id="headingSize">
                      <h4>
                        <button class="btn btn-link text-start" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseSize">
                          Pack Size
                        </button>
                      </h4>
                    </div>
                    <div id="collapseSize" class="collapse show">
                      <div class="card-body">
                        <div class="ui_kit_checkbox pb30">

                          @foreach($packSizes ?? [] as $size)
                            <label class="custom_checkbox">
                              {{ $size->quantity }} {{ $size->quantity_in }}
                              <input type="checkbox" name="size[]" value="{{ $size->id }}" {{ in_array($size->id, request('size', [])) ? 'checked' : '' }}>
                              <span class="checkmark"></span>
                            </label>
                          @endforeach

                        </div>
                      </div>
                    </div>
                  </div>


                  <!-- ✅ FRAGRANCE TYPE -->
                  <div class="card">
                    <div class="card-header" id="headingFragrance">
                      <h4>
                        <button class="btn btn-link text-start" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseFragrance">
                          Fragrance Type
                        </button>
                      </h4>
                    </div>
                    <div id="collapseFragrance" class="collapse show">
                      <div class="card-body">
                        <div class="ui_kit_checkbox pb30">

                          @foreach($fragranceTypes ?? [] as $type)
                            <label class="custom_checkbox">
                              {{ $type->title }}
                              <input type="checkbox" name="fragrance[]" value="{{ $type->id }}" {{ in_array($type->id, request('fragrance', [])) ? 'checked' : '' }}>
                              <span class="checkmark"></span>
                            </label>
                          @endforeach

                        </div>
                      </div>
                    </div>
                  </div>


                  <!-- ✅ DEALS -->
                  <div class="card">
                    <div class="card-header" id="headingDeals">
                      <h4>
                        <button class="btn btn-link text-start" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseDeals">
                          Deals & Offers
                        </button>
                      </h4>
                    </div>
                    <div id="collapseDeals" class="collapse show">
                      <div class="card-body">
                        <label class="custom_checkbox">
                          On Sale
                          <input type="checkbox" name="deal" value="1" {{ request('deal') ? 'checked' : '' }}>
                          <span class="checkmark"></span>
                        </label>
                      </div>
                    </div>
                  </div>


                  <!-- ✅ RATING -->
                  <div class="card">
                    <div class="card-header" id="headingRating">
                      <h4>
                        <button class="btn btn-link text-start" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseRating">
                          Customer Rating
                        </button>
                      </h4>
                    </div>
                    <div id="collapseRating" class="collapse show">
                      <div class="card-body">

                        <label>
                          <input type="radio" name="rating" value="4" {{ request('rating') == 4 ? 'checked' : '' }}>
                          ⭐ 4★ & up
                        </label><br>

                        <label>
                          <input type="radio" name="rating" value="3" {{ request('rating') == 3 ? 'checked' : '' }}>
                          ⭐ 3★ & up
                        </label>

                      </div>
                    </div>
                  </div>

                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-xl-10 pl50 pl15-md">
          <div class="row">
            <div class="col-xl-12">
              <div class="main-banner-wrapper shoplist_style_v1 bdrs6 ovh">
                <div class="banner-style-one dots_none owl-theme owl-carousel">
                  @foreach($shopBanners as $banner)
                  <div class="slide slide-one slide_one bg-img-none-sm"
                    style="background-image: url('{{ asset('storage/' . $banner->image) }}')!important;height: 450px;">
                    <div class="container">
                      <div class="row home-content">
                        <div class="col-lg-12 p0">
                          <h2 class="banner-title heading-color mb20">{{ $banner->heading }}</h2>
                          <p class="heading-color">{!! $banner->content !!}</p>
                          <a href="{{ $banner->url }}" class="btn p0">
                            <button class="banner-btn btn-thm">{{ $banner->url_txt ?? 'Shop Deals' }}</button>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  <div class="slide slide-one slide_two bg-img-none-sm"
                    style="background-image: url(images/background/shop-listing-v7.jpg);height: 450px;">
                    <div class="container">
                      <div class="row home-content">
                        <div class="col-lg-12 p0">
                          <h2 class="banner-title heading-color mb20">Save up to $130 on select <br
                              class="d-none d-xl-block"> laptops.</h2>
                          <p class="heading-color">All kind of products in one place. Starts from $1. Get <br
                              class="d-none d-sm-block"> cashbacks & offers</p>
                          <a href="page-shop-cart.html" class="btn p0">
                            <button class="banner-btn btn-thm">Shop Deals</button>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="slide slide-one slide_three bg-img-none-sm"
                    style="background-image: url(images/background/shop-listing-v2.jpg);height: 450px;">
                    <div class="container">
                      <div class="row home-content">
                        <div class="col-lg-12 p0">
                          <h2 class="banner-title heading-color mb20">Save up to $130 on select <br
                              class="d-none d-xl-block"> laptops.</h2>
                          <p class="heading-color">All kind of products in one place. Starts from $1. Get <br
                              class="d-none d-sm-block"> cashbacks & offers</p>
                          <a href="page-shop-cart.html" class="btn p0">
                            <button class="banner-btn btn-thm">Shop Deals</button>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- /.main-banner-wrapper -->
            </div>
          </div>
          <div class="row mt50">
            <div class="col-lg-12">
              <div class="main-title">
                <h2 class="title">
                  {{ $currentCategory ? $currentCategory->name . ' Best Sellers' : 'Best Seller Items' }}
                </h2>
              </div>
              <div class="shop_item_4grid_slider slider_dib_sm dots_none owl-theme owl-carousel">
                @foreach($bestSellers as $product)
                  <div class="item">
                    <div class="shop_item small_style bdr1 mx--1">
                      <div class="thumb pb30">
                        <img class="w100" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        <div class="thumb_info">
                          <ul class="mb0">
                            <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                            <li><a href="{{ url('product-details/' . $product->slug) }}"><span
                                  class="flaticon-show"></span></a>
                            </li>
                            <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                          </ul>
                        </div>
                        <div class="shop_item_cart_btn d-grid">
                          <a href="#" class="btn btn-thm">Add to Cart</a>
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
                                  <i class="fas fa-star {{ $i <= $product->avg_rating ? '' : 'text-muted' }}"></i>
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
          <div class="row mt60">
            <div class="col-lg-12">
              <div class="main-title bb1 pb10">
                <h2 class="title">
                  {{ $currentSubcategory->name ?? ($currentCategory->name ?? 'All Products') }}
                </h2>
                <p>{{ $products->total() }} products found
                </p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-7">
              <div class="filter_components">
                <ul class="mb0 align-items-center text-center text-lg-start">
                  <li class="list-inline-item me-2 mb-3">
                    <p class="pagination_page_count">
                      Showing {{ $products->firstItem() }}–
                      {{ $products->lastItem() }}
                      of {{ $products->total() }} results
                    </p>
                  </li>
                  <li class="list-inline-item me-2 list mb-3 pl10"><a
                      href="{{ request()->fullUrlWithQuery(['perPage' => 20, 'page' => 1]) }}">20</a></li>
                  <li class="list-inline-item me-2 list mb-3 pl10"><a
                      href="{{ request()->fullUrlWithQuery(['perPage' => 40, 'page' => 1]) }}">40</a></li>
                  <li class="list-inline-item me-2 list mb-3 pl10"><a
                      href="{{ request()->fullUrlWithQuery(['perPage' => 60, 'page' => 1]) }}">60</a></li>
                  <li class="list-inline-item me-2 list mb-3 pl10"><a
                      href="{{ request()->fullUrlWithQuery(['perPage' => 100, 'page' => 1]) }}">All</a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="filter_components text-center text-lg-end ">
                <ul class="mb-2 mb-md-0">
                  <li class="list-inline-item d-lg-none me-2 mb-3"><a class="all-filter-btn flter_btn" href="#"><span
                        class="flaticon-sort me-2"></span>All Filter</a></li>
                  <li class="list-inline-item me-0">
                    <div class="page_control_shorting mb20 text-center text-md-end">
                      <select name="sort" form="filterForm" onchange="document.getElementById('filterForm').submit()"
                        class="selectpicker show-tick">

                        <option value="">Default sorting</option>

                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>
                          Newest
                        </option>

                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                          Price Low → High
                        </option>

                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                          Price High → Low
                        </option>

                      </select>
                    </div>
                  </li>
                  <li class="d-none d-lg-inline-block list px-2"><a href="#">List</a></li>
                  <li class="d-none d-lg-inline-block gird ps-2"><a href="#">Grid</a></li>
                </ul>
              </div>
            </div>
            <div class="row">
              @foreach($products as $product)
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="{{ url('product-details/' . $product->slug) }}"><span
                                class="flaticon-show"></span></a>
                          </li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="#" class="btn btn-thm">Add to Cart</a>
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
                                <i class="fas fa-star {{ $i <= $product->avg_rating ? '' : 'text-muted' }}"></i>
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
                            </small>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="mbp_pagination mt30 text-center">

                  <ul class="page_navigation">

                    {{-- PREVIOUS --}}
                    <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                      <a class="page-link" href="{{ $products->appends(request()->query())->previousPageUrl() ?? '#' }}">
                        <span class="fas fa-angle-left"></span>
                      </a>
                    </li>

                    {{-- PAGE NUMBERS --}}
                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                      <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $products->appends(request()->query())->url($i) }}">
                          {{ $i }}
                        </a>
                      </li>
                    @endfor

                    {{-- NEXT --}}
                    <li class="page-item {{ !$products->hasMorePages() ? 'disabled' : '' }}">
                      <a class="page-link" href="{{ $products->appends(request()->query())->nextPageUrl() ?? '#' }}">
                        <span class="fas fa-angle-right"></span>
                      </a>
                    </li>

                  </ul>

                  <p class="mt20 pagination_page_count text-center">
                    {{ $products->firstItem() }} – {{ $products->lastItem() }}
                    of {{ $products->total() }} products found
                  </p>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const form = document.getElementById("filterForm");

      form.querySelectorAll("input, select").forEach(el => {
        el.addEventListener("change", () => form.submit());
      });
    });
  </script>

@endsection