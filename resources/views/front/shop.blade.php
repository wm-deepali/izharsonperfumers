@extends('front.app')

@section('title', 'Page Vendor List')

@section('content')

<!-- Inner Page Breadcrumb -->
    <section class="inner_page_breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col-xl-6">
            <div class="breadcrumb_content">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Electronics</a></li>
                <li class="breadcrumb-item"><a href="#">Computers</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Desktop Computers</a></li>
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
                <div class="accordion" id="accordionExample">
                  <div class="card">
                    <div class="card-header active" id="headingZero">
                      <h4>
                        <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseZero" aria-expanded="true" aria-controls="collapseZero">Department</button>
                      </h4>
                    </div>
                    <div id="collapseZero" class="collapse show" aria-labelledby="headingZero" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="left_sidebar_department_widgets">
                          <ul class="list-unstyled ps-0">
                            <li><a href="#" class="parent_list">Electronics</a></li>
                            <li><a href="#" class="parent_list">Computers & Accessories</a></li>
                            <li class="mb-1"><a class="btn parent_list before_none">Computers & Tablets</a>
                              <div>
                                <ul class="list-unstyled pb-2">
                                  <li><a href="#" class="child_list">Desktops</a></li>
                                  <li><a href="#" class="child_list">Laptops</a></li>
                                  <li><a href="#" class="child_list">Tablets</a></li>
                                </ul>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h4>
                        <button class="btn btn-link text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Filter by Brands</button>
                      </h4>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="sidebar_search_widget">
                          <div class="blog_search_widget">
                            <div class="input-group">
                              <input type="text" class="form-control mb15" placeholder="Find a Brand" aria-label="Recipient's username">
                            </div>
                          </div>
                        </div>
                        <div class="sidebar_widget_checkbox">
                          <div class="ui_kit_checkbox pb30">
                            <label class="custom_checkbox">Apple <span class="float-end">87</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox" checked="checked">Asus <span class="float-end">92</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox">Acer <span class="float-end">123</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox">Dell <span class="float-end">49</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox mb5">Lenovo <span class="float-end">12</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <a href="#" class="shop_btn">Show More</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingTwo">
                      <h4>
                        <button class="btn btn-link text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">Price</button>
                      </h4>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="sidebar_widget_checkbox">
                          <div class="zmart_custom_range_slider mb-4 mt10">
                            <input type="text" class="amount mt-0" placeholder="$20"> 
                            <input type="text" class="amount2 mt-0" placeholder="$70987">
                            <div class="slider-range mt-3 ms-2"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingThree">
                      <h4>
                        <button class="btn btn-link text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">CPU Manufacturer</button>
                      </h4>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="sidebar_widget_checkbox">
                          <div class="ui_kit_checkbox pb30">
                            <label class="custom_checkbox">AMD <span class="float-end">87</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox" checked="checked">Apple <span class="float-end">92</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox">Intel <span class="float-end">123</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox">NVIDIA <span class="float-end">49</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox mb5">Qualcomm <span class="float-end">12</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <a href="#" class="shop_btn">Show More</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingFour">
                      <h4>
                        <button class="btn btn-link text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">Memory Capacity</button>
                      </h4>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="sidebar_widget_checkbox">
                          <div class="ui_kit_checkbox pb30">
                            <label class="custom_checkbox">16 GB <span class="float-end">87</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox" checked="checked">32 GB <span class="float-end">92</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox">64 GB <span class="float-end">123</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox">128 GB <span class="float-end">49</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox mb5">1 TB <span class="float-end">12</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <a href="#" class="shop_btn">Show More</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingFive">
                      <h4>
                        <button class="btn btn-link text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">Screen Size</button>
                      </h4>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="sidebar_widget_checkbox">
                          <div class="ui_kit_checkbox pb30">
                            <label class="custom_checkbox">17 Inches & Above <span class="float-end">87</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox" checked="checked">16 to 16.9 Inches <span class="float-end">92</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox">15 to 15.9 Inches <span class="float-end">123</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox">14 to 14.9 Inches <span class="float-end">49</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox mb5">13 to 13.9 Inches <span class="float-end">12</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <a href="#" class="shop_btn">Show More</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingSix">
                      <h4>
                        <button class="btn btn-link text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">Display Resolution</button>
                      </h4>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="sidebar_widget_checkbox">
                          <div class="ui_kit_checkbox pb30">
                            <label class="custom_checkbox">1024 x 600 pixel <span class="float-end">87</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox" checked="checked">1024 x 768 pixel <span class="float-end">92</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox">1280 x 720 pixel <span class="float-end">123</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox">1280 x 800 pixel <span class="float-end">49</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox mb5">1366 x 768 pixel <span class="float-end">12</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <a href="#" class="shop_btn">Show More</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingSeven">
                      <h4>
                        <button class="btn btn-link text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">Color</button>
                      </h4>
                    </div>
                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="color_chose_list_sscs_page shop_single_natabmenu sidebar_widget_checkbox color_style color_switch">
                          <div class="align-items-center">
                            <div class="nav nav-pills" id="v-pills-tab2" role="tablist" aria-orientation="vertical">
                              <button class="nav-link p-0 active me-2" id="v-pills-color7-tab" data-bs-toggle="pill" data-bs-target="#v-pills-color7" type="button" role="tab" aria-controls="v-pills-color7" aria-selected="true">
                                <span class="custom_selectable_radio_btn d-flex">
                                  <span>
                                    <input id="radio-7" class="radio-custom dark_bg" name="radio-group" type="radio" checked="">
                                    <label for="radio-7" class="radio-custom-label dark_bg"></label>
                                  </span>
                                </span>
                              </button>
                              <button class="nav-link p-0 me-2" id="v-pills-color8-tab" data-bs-toggle="pill" data-bs-target="#v-pills-color8" type="button" role="tab" aria-controls="v-pills-color8" aria-selected="false">
                                <span class="custom_selectable_radio_btn">
                                  <span>
                                    <input id="radio-8" class="radio-custom violet_bg" name="radio-group" type="radio">
                                    <label for="radio-8" class="radio-custom-label violet_bg"></label>
                                  </span>
                                </span>
                              </button>
                              <button class="nav-link p-0 me-2" id="v-pills-color9-tab" data-bs-toggle="pill" data-bs-target="#v-pills-color9" type="button" role="tab" aria-controls="v-pills-color9" aria-selected="false">
                                <span class="custom_selectable_radio_btn">
                                  <span>
                                    <input id="radio-9" class="radio-custom light_blue_bg" name="radio-group" type="radio">
                                    <label for="radio-9" class="radio-custom-label light_blue_bg"></label>
                                  </span>
                                </span>
                              </button>
                              <button class="nav-link p-0 me-2" id="v-pills-color10-tab" data-bs-toggle="pill" data-bs-target="#v-pills-color10" type="button" role="tab" aria-controls="v-pills-color10" aria-selected="false">
                                <div class="custom_selectable_radio_btn">
                                  <div>
                                    <input id="radio-10" class="radio-custom yellow_bg" name="radio-group" type="radio">
                                    <label for="radio-10" class="radio-custom-label yellow_bg"></label>
                                  </div>
                                </div>
                              </button>
                              <button class="nav-link p-0 me-2" id="v-pills-color11-tab" data-bs-toggle="pill" data-bs-target="#v-pills-color11" type="button" role="tab" aria-controls="v-pills-color11" aria-selected="false">
                                <span class="custom_selectable_radio_btn">
                                  <span>
                                    <input id="radio-11" class="radio-custom gray_bg" name="radio-group" type="radio">
                                    <label for="radio-11" class="radio-custom-label gray_bg"></label>
                                  </span>
                                </span>
                              </button>
                              <button class="nav-link p-0" id="v-pills-color12-tab" data-bs-toggle="pill" data-bs-target="#v-pills-color12" type="button" role="tab" aria-controls="v-pills-color12" aria-selected="false">
                                <span class="custom_selectable_radio_btn">
                                  <span>
                                    <input id="radio-12" class="radio-custom" name="radio-group" type="radio">
                                    <label for="radio-12" class="radio-custom-label"></label>
                                  </span>
                                </span>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingEight">
                      <h4>
                        <button class="btn btn-link text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">Customer Rating</button>
                      </h4>
                    </div>
                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="sidebar_widget_checkbox">
                          <div class="ui_kit_radiobox2 pb30">
                            <div class="radiobox_style2">
                              <input type="radio" id="test1" name="radio-group">
                              <label class="d-flex justify-content-between" for="test1">
                                <span>
                                  <div class="sspd_postdate me-2">
                                    <div class="sspd_review">
                                      <ul class="mb0">
                                        <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fal fa-star heading-color"></i></a></li>
                                        <li class="list-inline-item"><span class="heading-color">& up</span></li>
                                      </ul>
                                    </div>
                                  </div>
                                </span>
                                <span class="count">87</span>
                              </label>
                            </div>
                            <div class="radiobox_style2">
                              <input type="radio" id="test2" name="radio-group">
                              <label class="d-flex justify-content-between" for="test2">
                                <span>
                                  <div class="sspd_postdate me-2">
                                    <div class="sspd_review">
                                      <ul class="mb0">
                                        <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fal fa-star heading-color"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fal fa-star heading-color"></i></a></li>
                                        <li class="list-inline-item"><span class="heading-color">& up</span></li>
                                      </ul>
                                    </div>
                                  </div>
                                </span>
                                <span class="count">92</span>
                              </label>
                            </div>
                            <div class="radiobox_style2">
                              <input type="radio" id="test3" name="radio-group">
                              <label class="d-flex justify-content-between" for="test3">
                                <span>
                                  <div class="sspd_postdate me-2">
                                    <div class="sspd_review">
                                      <ul class="mb0">
                                        <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fal fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fal fa-star heading-color"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fal fa-star heading-color"></i></a></li>
                                        <li class="list-inline-item"><span class="heading-color">& up</span></li>
                                      </ul>
                                    </div>
                                  </div>
                                </span>
                                <span class="count">123</span>
                              </label>
                            </div>
                            <div class="radiobox_style2">
                              <input type="radio" id="test4" name="radio-group">
                              <label class="d-flex justify-content-between" for="test4">
                                <span>
                                  <div class="sspd_postdate me-2">
                                    <div class="sspd_review">
                                      <ul class="mb0">
                                        <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fal fa-star heading-color"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fal fa-star heading-color"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fal fa-star heading-color"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fal fa-star heading-color"></i></a></li>
                                        <li class="list-inline-item"><span class="heading-color">& up</span></li>
                                      </ul>
                                    </div>
                                  </div>
                                </span>
                                <span class="count">49</span>
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingNine">
                      <h4>
                        <button class="btn btn-link text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="true" aria-controls="collapseNine">Condition</button>
                      </h4>
                    </div>
                    <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="sidebar_widget_checkbox">
                          <div class="ui_kit_checkbox pb30">
                            <label class="custom_checkbox">New <span class="float-end">87</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox" checked="checked">Used <span class="float-end">92</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox">Renewed <span class="float-end">123</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-9 col-xl-10 pl50 pl15-md">
            <div class="row">
              <div class="col-xl-12">
                <div class="main-banner-wrapper shoplist_style_v1 bdrs6 ovh">
                  <div class="banner-style-one dots_none owl-theme owl-carousel">
                    <div class="slide slide-one slide_one bg-img-none-sm" style="background-image: url(images/background/shop-listing-v2.jpg);height: 450px;">
                      <div class="container">
                        <div class="row home-content">
                          <div class="col-lg-12 p0">
                            <h2 class="banner-title heading-color mb20">Save up to $130 on select <br class="d-none d-xl-block"> laptops.</h2>
                            <p class="heading-color">All kind of products in one place. Starts from $1. Get <br class="d-none d-sm-block"> cashbacks & offers</p>
                            <a href="page-shop-cart.html" class="btn p0">
                              <button class="banner-btn btn-thm">Shop Deals</button>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="slide slide-one slide_two bg-img-none-sm" style="background-image: url(images/background/shop-listing-v7.jpg);height: 450px;">
                      <div class="container">
                        <div class="row home-content">
                          <div class="col-lg-12 p0">
                            <h2 class="banner-title heading-color mb20">Save up to $130 on select <br class="d-none d-xl-block"> laptops.</h2>
                            <p class="heading-color">All kind of products in one place. Starts from $1. Get <br class="d-none d-sm-block"> cashbacks & offers</p>
                            <a href="page-shop-cart.html" class="btn p0">
                              <button class="banner-btn btn-thm">Shop Deals</button>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="slide slide-one slide_three bg-img-none-sm" style="background-image: url(images/background/shop-listing-v2.jpg);height: 450px;">
                      <div class="container">
                        <div class="row home-content">
                          <div class="col-lg-12 p0">
                            <h2 class="banner-title heading-color mb20">Save up to $130 on select <br class="d-none d-xl-block"> laptops.</h2>
                            <p class="heading-color">All kind of products in one place. Starts from $1. Get <br class="d-none d-sm-block"> cashbacks & offers</p>
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
                  <h2 class="title">Best Seller Items</h2>
                </div>
                <div class="shop_item_4grid_slider slider_dib_sm dots_none owl-theme owl-carousel">
                  <div class="item">
                    <div class="shop_item small_style bdr1 mx--1">
                      <div class="thumb pb30">
                        <img class="w100" src="{{ asset('front/images//shop-items/shop-item11.png')}}" alt="Shop Item11">
                        <div class="thumb_info">
                          <ul class="mb0">
                            <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                            <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                            <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                          </ul>
                        </div>
                        <div class="shop_item_cart_btn d-grid">
                          <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                        </div>
                      </div>
                      <div class="details">
                        <div class="sub_title">SONY</div>
                        <div class="title"><a href="#">Apple MacBook Air 13.3" w/ Touch ID (2020) - Space Grey (Intel Core i3 1.1GHz/256GB SSD/8GB RAM) -En - Certified Refurbished</a></div>
                        <div class="review d-flex db-500">
                          <ul class="mb0 me-2">
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          </ul>
                          <div class="review_count"><a href="#">3,014 reviews</a></div>
                        </div>
                        <div class="si_footer">
                          <div class="price">$32.50 <small><del>$45</del></small></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="shop_item small_style bdr1 mx--1">
                      <div class="thumb pb30">
                        <img class="w100" src="{{ asset('front/images//shop-items/shop-item15.png')}}" alt="Shop Item15">
                        <div class="thumb_info">
                          <ul class="mb0">
                            <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                            <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                            <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                          </ul>
                        </div>
                        <div class="shop_item_cart_btn d-grid">
                          <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                        </div>
                      </div>
                      <div class="details">
                        <div class="sub_title">SONY</div>
                        <div class="title"><a href="#">Dell Inspiron 3000 15.6" Touchscreen Laptop - Black (Intel Core i5-1035G1/256GB SSD/8GB RAM/Windows 11 S)</a></div>
                        <div class="review d-flex db-500">
                          <ul class="mb0 me-2">
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          </ul>
                          <div class="review_count"><a href="#">3,014 reviews</a></div>
                        </div>
                        <div class="si_footer">
                          <div class="price">$399.00 <small><del>$45</del></small></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="shop_item small_style bdr1 mx--1">
                      <div class="thumb pb30">
                        <img class="w100" src="{{ asset('front/images//shop-items/shop-item14.png')}}" alt="Shop Item14">
                        <div class="thumb_info">
                          <ul class="mb0">
                            <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                            <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                            <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                          </ul>
                        </div>
                        <div class="shop_item_cart_btn d-grid">
                          <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                        </div>
                      </div>
                      <div class="details">
                        <div class="sub_title">Eastsport</div>
                        <div class="title"><a href="#">LG Gram 17" Laptop -Obsidian Black (Intel Evo Core i7-1165G7/1TB SSD/16GB RAM) -En -Only at Best Buy</a></div>
                        <div class="review d-flex db-500">
                          <ul class="mb0 me-2">
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          </ul>
                          <div class="review_count"><a href="#">3,014 reviews</a></div>
                        </div>
                        <div class="si_footer">
                          <div class="price">$32.50 <small><del>$45</del></small></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="shop_item small_style bdr1 mx--1">
                      <div class="thumb pb30">
                        <img class="w100" src="{{ asset('front/images//shop-items/shop-item13.png')}}" alt="Shop Item13">
                        <div class="thumb_info">
                          <ul class="mb0">
                            <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                            <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                            <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                          </ul>
                        </div>
                        <div class="shop_item_cart_btn d-grid">
                          <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                        </div>
                      </div>
                      <div class="details">
                        <div class="sub_title">rolex</div>
                        <div class="title"><a href="#">HP 15.6" Touchscreen Laptop - Natural Silver (AMD Ryzen 5 5625U/1TB SSD/12GB RAM/Windows 11)</a></div>
                        <div class="review d-flex db-500">
                          <ul class="mb0 me-2">
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          </ul>
                          <div class="review_count"><a href="#">3,014 reviews</a></div>
                        </div>
                        <div class="si_footer">
                          <div class="price">$18.124 <small><del>$45</del></small></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="shop_item small_style bdr1 mx--1">
                      <div class="thumb pb30">
                        <img class="w100" src="{{ asset('front/images//shop-items/shop-item5.png')}}" alt="Shop Item5">
                        <div class="thumb_info">
                          <ul class="mb0">
                            <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                            <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                            <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                          </ul>
                        </div>
                        <div class="shop_item_cart_btn d-grid">
                          <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                        </div>
                      </div>
                      <div class="details">
                        <div class="sub_title">rolex</div>
                        <div class="title"><a href="#">ASUS VivoBook 15 X515 15.6" Laptop - Slate Grey (Intel Core i3-1005G1/256GB SSD/8GB RAM/Win 11 S)</a></div>
                        <div class="review d-flex db-500">
                          <ul class="mb0 me-2">
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          </ul>
                          <div class="review_count"><a href="#">3,014 reviews</a></div>
                        </div>
                        <div class="si_footer">
                          <div class="price">$18.124 <small><del>$45</del></small></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="shop_item small_style bdr1 mx--1">
                      <div class="thumb pb30">
                        <img class="w100" src="{{ asset('front/images//shop-items/shop-item6.png')}}" alt="Shop item6">
                        <div class="thumb_info">
                          <ul class="mb0">
                            <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                            <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                            <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                          </ul>
                        </div>
                        <div class="shop_item_cart_btn d-grid">
                          <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                        </div>
                      </div>
                      <div class="details">
                        <div class="sub_title">Rolex</div>
                        <div class="title"><a href="#">ASUS ROG Strix G15 15.6" Gaming Laptop (AMD Ryzen 7 4800H/512GB SSD/16GB RAM/GeForce RTX 3050/Win 11)</a></div>
                        <div class="review d-flex db-500">
                          <ul class="mb0 me-2">
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          </ul>
                          <div class="review_count"><a href="#">3,014 reviews</a></div>
                        </div>
                        <div class="si_footer">
                          <div class="price">$18.124 <small><del>$45</del></small></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="shop_item small_style bdr1 mx--1">
                      <div class="thumb pb30">
                        <img class="w100" src="{{ asset('front/images//shop-items/shop-item1.png')}}" alt="Shop Item1">
                        <div class="thumb_info">
                          <ul class="mb0">
                            <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                            <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                            <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                          </ul>
                        </div>
                        <div class="shop_item_cart_btn d-grid">
                          <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                        </div>
                      </div>
                      <div class="details">
                        <div class="sub_title">SAMSUNG</div>
                        <div class="title"><a href="#">Acer Aspire 5 15.6" Laptop - Silver (Intel Core i7-1165G7/512GB SSD/12GB RAM/Windows 11)</a></div>
                        <div class="review d-flex db-500">
                          <ul class="mb0 me-2">
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          </ul>
                          <div class="review_count"><a href="#">3,014 reviews</a></div>
                        </div>
                        <div class="si_footer">
                          <div class="price">$32.50 <small><del>$45</del></small></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="shop_item small_style bdr1 mx--1">
                      <div class="thumb pb30">
                        <img class="w100" src="{{ asset('front/images//shop-items/shop-item6.png')}}" alt="Shop Item6">
                        <div class="thumb_info">
                          <ul class="mb0">
                            <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                            <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                            <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                          </ul>
                        </div>
                        <div class="shop_item_cart_btn d-grid">
                          <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                        </div>
                      </div>
                      <div class="details">
                        <div class="sub_title">SONY</div>
                        <div class="title"><a href="#">Acer Nitro 5 15.6" Gaming Laptop - Black (Intel Core i5-10300H/512GB SSD/12GB RAM/GTX 1650/Windows 11)</a></div>
                        <div class="review d-flex db-500">
                          <ul class="mb0 me-2">
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          </ul>
                          <div class="review_count"><a href="#">3,014 reviews</a></div>
                        </div>
                        <div class="si_footer">
                          <div class="price">$32.50 <small><del>$45</del></small></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt60">
              <div class="col-lg-12">
                <div class="main-title bb1 pb10">
                  <h2 class="title">Laptops and Accessories</h2>
                  <p>Shop laptops, desktops, monitors, tablets, PC gaming, hard drives and storage, accessories and more</p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-7">
                <div class="filter_components">
                  <ul class="mb0 align-items-center text-center text-lg-start">
                    <li class="list-inline-item me-2 mb-3"><p class="pagination_page_count">Showing 1–20 of 175 results</p></li>
                    <li class="list-inline-item me-2 list mb-3 pl10"><a href="#">20</a></li>
                    <li class="list-inline-item me-2 list mb-3 pl10"><a href="#">40</a></li>
                    <li class="list-inline-item me-2 list mb-3 pl10"><a href="#">60</a></li>
                    <li class="list-inline-item me-2 list mb-3 pl10"><a href="#">All</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="filter_components text-center text-lg-end ">
                  <ul class="mb-2 mb-md-0">
                    <li class="list-inline-item d-lg-none me-2 mb-3"><a class="all-filter-btn flter_btn" href="#"><span class="flaticon-sort me-2"></span>All Filter</a></li>
                    <li class="list-inline-item me-0">
                      <div class="page_control_shorting mb20 text-center text-md-end">
                        <select class="selectpicker show-tick">
                          <option>Default sorting</option>
                          <option>Best Seller</option>
                          <option>Best Match</option>
                          <option>Price Low</option>
                          <option>Price High</option>
                        </select>
                      </div>
                    </li>
                    <li class="d-none d-lg-inline-block list px-2"><a href="#">List</a></li>
                    <li class="d-none d-lg-inline-block gird ps-2"><a href="#">Grid</a></li>
                  </ul>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item1.png')}}" alt="Shop Item1">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">SAMSUNG</div>
                      <div class="title"><a href="#">Acer Aspire 5 15.6" Laptop - Silver (Intel Core i7-1165G7/512GB SSD/12GB RAM/Windows 11)</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$32.50 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item2.png')}}" alt="Shop Item2">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">SONY</div>
                      <div class="title"><a href="#">Acer Nitro 5 15.6" Gaming Laptop - Black (Intel Core i5-10300H/512GB SSD/12GB RAM/GTX 1650/Windows 11)</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$32.50 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item3.png')}}" alt="Shop Item3">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">Eastsport</div>
                      <div class="title"><a href="#">Acer Nitro 5 15.6" Gaming Laptop - Black (Intel Core i5-10300H/512GB SSD/12GB RAM/GTX 1650/Windows 11)</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$32.50 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item4.png')}}" alt="Shop Item4">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">Rolex</div>
                      <div class="title"><a href="#">Apple MacBook Air 13.3" w/ Touch ID (Fall 2020) - Space Grey (Apple M1 Chip / 256GB SSD / 8GB RAM) - En</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$18.124 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item5.png')}}" alt="Shop Item5">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">Sony</div>
                      <div class="title"><a href="#">HP 14" Laptop - Silver (Intel Core i3-1115G4/512GB SSD/8GB RAM/Windows 10)</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$32.50 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item10.png')}}" alt="Shop Item10">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">SAMSUNG</div>
                      <div class="title"><a href="#">Acer Aspire 5 15.6" Laptop - Silver (Intel Core i7-1165G7/512GB SSD/12GB RAM/Windows 11)</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$32.50 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item4.png')}}" alt="Shop Item4">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">SONY</div>
                      <div class="title"><a href="#">Acer Nitro 5 15.6" Gaming Laptop - Black (Intel Core i5-10300H/512GB SSD/12GB RAM/GTX 1650/Windows 11)</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$32.50 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item8.png')}}" alt="Shop Item8">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">Eastsport</div>
                      <div class="title"><a href="#">Acer Nitro 5 15.6" Gaming Laptop - Black (Intel Core i5-10300H/512GB SSD/12GB RAM/GTX 1650/Windows 11)</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$32.50 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item8.png')}}" alt="Shop Item8">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">Rolex</div>
                      <div class="title"><a href="#">Apple MacBook Air 13.3" w/ Touch ID (Fall 2020) - Space Grey (Apple M1 Chip / 256GB SSD / 8GB RAM) - En</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$18.124 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item11.png')}}" alt="Shop Item11">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">Sony</div>
                      <div class="title"><a href="#">HP 14" Laptop - Silver (Intel Core i3-1115G4/512GB SSD/8GB RAM/Windows 10)</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$32.50 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item12.png')}}" alt="Shop Item12">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">rolex</div>
                      <div class="title"><a href="#">Apple MacBook Pro 13.3" Retina (Intel Core i5 2.7 GHz / 8GB RAM / 128GB SSD) 2015 - Model MF839LL/A* w/ Apple Original Charger - Certified Refurbished</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$32.50 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item11.png')}}" alt="Shop Item11">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">SONY</div>
                      <div class="title"><a href="#">Apple MacBook Air 13.3" w/ Touch ID (2020) - Space Grey (Intel Core i3 1.1GHz/256GB SSD/8GB RAM) -En - Certified Refurbished</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$32.50 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item15.png')}}" alt="Shop Item15">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">SONY</div>
                      <div class="title"><a href="#">Dell Inspiron 3000 15.6" Touchscreen Laptop - Black (Intel Core i5-1035G1/256GB SSD/8GB RAM/Windows 11 S)</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$32.50 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item14.png')}}" alt="Shop Item14">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">Eastsport</div>
                      <div class="title"><a href="#">LG Gram 17" Laptop -Obsidian Black (Intel Evo Core i7-1165G7/1TB SSD/16GB RAM) -En -Only at Best Buy</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$18.124 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item13.png')}}" alt="Shop Item13">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">rolex</div>
                      <div class="title"><a href="#">HP 15.6" Touchscreen Laptop - Natural Silver (AMD Ryzen 5 5625U/1TB SSD/12GB RAM/Windows 11)</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$32.50 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item18.png')}}" alt="Shop Item18">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">Eastsport</div>
                      <div class="title"><a href="#">HP 17.3" Laptop - Natural Silver (Intel Core i5-1135G7/1TB HDD/256GB SSD/16GB RAM/Windows 10)</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$32.50 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item1.png')}}" alt="Shop Item1">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">rolex</div>
                      <div class="title"><a href="#">Dell XPS 13 13.4" Touchscreen Laptop - Silver (Intel Evo i7-1195G7/512GB SSD/16GB RAM/Win 11 Pro)</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$32.50 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item17.png')}}" alt="Shop Item17">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">SONY</div>
                      <div class="title"><a href="#">Samsung Galaxy Book 15.6" Laptop - Silver (Intel Core i5-1135G7/256GB SSD/8GB RAM/Windows 11)</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$32.50 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item14.png')}}" alt="Shop Item14">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">SONY</div>
                      <div class="title"><a href="#">ASUS VivoBook 15 X515 15.6" Laptop - Grey (Intel Pentium Silver N5030/256GB SSD/8GB RAM/Windows 11)</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$18.124 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-4 col-xl-3 p0 pl15-520">
                  <div class="shop_item bdr1 m--1">
                    <div class="thumb pb30">
                      <img src="{{ asset('front/images//shop-items/shop-item16.png')}}" alt="Shop Item16">
                      <div class="thumb_info">
                        <ul class="mb0">
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-heart"></span></a></li>
                          <li><a href="page-dashboard-wish-list.html"><span class="flaticon-show"></span></a></li>
                          <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                        </ul>
                      </div>
                      <div class="shop_item_cart_btn d-grid">
                        <a href="page-shop-cart.html" class="btn btn-thm">Add to Cart</a>
                      </div>
                    </div>
                    <div class="details">
                      <div class="sub_title">rolex</div>
                      <div class="title"><a href="#">HP ENVY 13.3" Laptop - Natural Silver (Intel Evo i5-1135G7/512GB SSD/8GB RAM/Windows 10)</a></div>
                      <div class="review d-flex db-500">
                        <ul class="mb0 me-2">
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                          <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                        </ul>
                        <div class="review_count"><a href="#">3,014 reviews</a></div>
                      </div>
                      <div class="si_footer">
                        <div class="price">$32.50 <small><del>$45</del></small></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="mbp_pagination mt30 text-center">
                    <ul class="page_navigation">
                      <li class="page-item">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true"> <span class="fas fa-angle-left"></span></a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">4</a></li>
                      <li class="page-item"><a class="page-link" href="#">5</a></li>
                      <li class="page-item"><a class="page-link" href="#">...</a></li>
                      <li class="page-item"><a class="page-link" href="#">20</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#"><span class="fas fa-angle-right"></span></a>
                      </li>
                    </ul>
                    <p class="mt20 pagination_page_count text-center">1 – 20 of 300+ properties found</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


@endsection