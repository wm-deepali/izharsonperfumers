@extends('front.app')

@section('title', 'Page Vendor List')

@section('content')

<!-- Custom Shop Category List Menu -->
    <section class="p0 bb1 overflow-hidden">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="custom_shop_category_nav_list_menu">
              <ul class="mb0 d-flex">
                <li><a href="#">All Electronics</a></li>
                <li><a href="#">Smart TV</a></li>
                <li><a class="active" href="#">Laptops</a></li>
                <li><a href="#">Cell Phones</a></li>
                <li><a href="#">Camera & Photo</a></li>
                <li><a href="#">Portable Audio</a></li>
                <li><a href="#">Computers</a></li>
                <li><a href="#">iPad & Tablets</a></li>
                <li><a href="#">Pc Gaming</a></li>
                <li><a href="#">Smart Home</a></li>
                <li><a href="#">Headphones</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    
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

  	<!-- Main Blog Post Content -->
  	<section class="blog_post_container pt30 pb80">
  		<div class="container">
        <div class="row">
          <div class="col-lg-6 m-auto">
            <div class="main-title text-center">
              <h2 class="title">Vendor List</h2>
            </div>
          </div>
        </div>
  			<div class="row mt50">
          <div class="col-lg-3 col-xl-2">
            <div class="sidebar_accordion_widget">
              <div class="faq_according text-start">
                <div class="accordion" id="accordionExample">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h4>
                        <button class="btn btn-link text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Filter by Category</button>
                      </h4>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="sidebar_search_widget">
                          <div class="blog_search_widget">
                            <div class="input-group">
                              <input type="text" class="form-control mb15" placeholder="Search" aria-label="Recipient's username">
                            </div>
                          </div>
                        </div>
                        <div class="sidebar_widget_checkbox">
                          <div class="ui_kit_checkbox mb5">
                            <label class="custom_checkbox">Today’s Hot Deals <span class="float-end">87</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox" checked="checked">Home & Kitchen <span class="float-end">92</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox">Home & Furniture <span class="float-end">123</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox">Electronics <span class="float-end">49</span>
                              <input type="checkbox">
                              <span class="checkmark"></span>
                            </label>
                            <label class="custom_checkbox">Clothing & Accessories <span class="float-end">12</span>
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
                      <h4 class="mb-3">
                        <button class="btn btn-link collapsed text-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Filter by Location</button>
                      </h4>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="sidebar_location_filter">
                          <div class="form-group">
                            <div class="checkout_country_form actegory">
                              <select class="selectpicker show-tick">
                                <option>Country</option>
                                <option value="Turkey">Turkey</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="UK">UK</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="checkout_country_form">
                              <select class="selectpicker show-tick">
                                <option>State</option>
                                <option value="Istanbul">Istanbul</option>
                                <option value="London">London</option>
                                <option value="NewYork">New York</option>
                                <option value="Paris">Paris</option>
                                <option value="Dubai">Dubai</option>
                                <option value="Rome">Rome</option>
                                <option value="Singapore">Singapore</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="checkout_country_form">
                              <select class="selectpicker show-tick">
                                <option>City</option>
                                <option value="Istanbul">Istanbul</option>
                                <option value="London">London</option>
                                <option value="NewYork">New York</option>
                                <option value="Paris">Paris</option>
                                <option value="Dubai">Dubai</option>
                                <option value="Rome">Rome</option>
                                <option value="Singapore">Singapore</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="location_zip">
                              <input class="form-control form_control" type="text" placeholder="Zip">
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
  				<div class="col-lg-9 col-xl-10 pl50 pl15-lg">
            <div class="row">
              <div class="col-md-6">
                <div class="vendor_grid_preview mb20">
                  <p class="pagination_page_count">Showing 1–20 of 175 results</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="page_control_shorting mb20 text-center text-md-end">
                  <select class="selectpicker show-tick">
                    <option>Default sorting</option>
                    <option>Most Recent</option>
                    <option>Recent</option>
                    <option>Best Selling</option>
                    <option>Old Review</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-xl-4">
                <div class="vendor_grid">
                  <div class="thumb">
                    <img src="{{ asset('front/images/vendors/1.jpg') }}" alt="Vendor 1 Image">
                  </div>
                  <div class="details">
                    <h5 class="title">Apple Store</h5>
                    <div class="flex-grow-1 mb15">
                      <div class="d-block d-md-flex">
                        <div class="sspd_postdate me-2 mb10-sm">
                          <div class="sspd_review">
                            <ul class="mb0">
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            </ul>
                          </div>
                        </div>
                        <h6 class="sub_title">965 seller reviews</h6>
                      </div>
                    </div>
                    <div class="vendor_address mb20">
                      <ul class="mb0">
                        <li><a href="#">1418 River Drive, Suite 35 Cottonhall, CA 9622 United States</a></li>
                        <li><a href="#">sale@zenmart.com</a></li>
                        <li><a href="#">+3 8493 92 932 021</a></li>
                      </ul>
                    </div>
                    <div class="d-grid">
                      <a class="btn btn-white bdr_thm" href="page-vendor-single.html">Visit Store</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="vendor_grid">
                  <div class="thumb">
                    <img src="{{ asset('front/images/vendors/2.jpg') }}" alt="Vendor 2 Image">
                  </div>
                  <div class="details">
                    <h5 class="title">Apple Store</h5>
                    <div class="flex-grow-1 mb15">
                      <div class="d-block d-md-flex">
                        <div class="sspd_postdate me-2 mb10-sm">
                          <div class="sspd_review">
                            <ul class="mb0">
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            </ul>
                          </div>
                        </div>
                        <h6 class="sub_title">965 seller reviews</h6>
                      </div>
                    </div>
                    <div class="vendor_address mb20">
                      <ul class="mb0">
                        <li><a href="#">1418 River Drive, Suite 35 Cottonhall, CA 9622 United States</a></li>
                        <li><a href="#">sale@zenmart.com</a></li>
                        <li><a href="#">+3 8493 92 932 021</a></li>
                      </ul>
                    </div>
                    <div class="d-grid">
                      <a class="btn btn-white bdr_thm" href="page-vendor-single.html">Visit Store</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="vendor_grid">
                  <div class="thumb">
                    <img src="{{ asset('front/images/vendors/3.jpg') }}" alt="Vendor 3 Image">
                  </div>
                  <div class="details">
                    <h5 class="title">Apple Store</h5>
                    <div class="flex-grow-1 mb15">
                      <div class="d-block d-md-flex">
                        <div class="sspd_postdate me-2 mb10-sm">
                          <div class="sspd_review">
                            <ul class="mb0">
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            </ul>
                          </div>
                        </div>
                        <h6 class="sub_title">965 seller reviews</h6>
                      </div>
                    </div>
                    <div class="vendor_address mb20">
                      <ul class="mb0">
                        <li><a href="#">1418 River Drive, Suite 35 Cottonhall, CA 9622 United States</a></li>
                        <li><a href="#">sale@zenmart.com</a></li>
                        <li><a href="#">+3 8493 92 932 021</a></li>
                      </ul>
                    </div>
                    <div class="d-grid">
                      <a class="btn btn-white bdr_thm" href="page-vendor-single.html">Visit Store</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="vendor_grid">
                  <div class="thumb">
                    <img src="{{ asset('front/images/vendors/4.jpg') }}" alt="Vendor 4 Image">
                  </div>
                  <div class="details">
                    <h5 class="title">Apple Store</h5>
                    <div class="flex-grow-1 mb15">
                      <div class="d-block d-md-flex">
                        <div class="sspd_postdate me-2 mb10-sm">
                          <div class="sspd_review">
                            <ul class="mb0">
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            </ul>
                          </div>
                        </div>
                        <h6 class="sub_title">965 seller reviews</h6>
                      </div>
                    </div>
                    <div class="vendor_address mb20">
                      <ul class="mb0">
                        <li><a href="#">1418 River Drive, Suite 35 Cottonhall, CA 9622 United States</a></li>
                        <li><a href="#">sale@zenmart.com</a></li>
                        <li><a href="#">+3 8493 92 932 021</a></li>
                      </ul>
                    </div>
                    <div class="d-grid">
                      <a class="btn btn-white bdr_thm" href="page-vendor-single.html">Visit Store</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="vendor_grid">
                  <div class="thumb">
                    <img src="{{ asset('front/images/vendors/5.jpg') }}" alt="Vendor 5 Image">
                  </div>
                  <div class="details">
                    <h5 class="title">Apple Store</h5>
                    <div class="flex-grow-1 mb15">
                      <div class="d-block d-md-flex">
                        <div class="sspd_postdate me-2 mb10-sm">
                          <div class="sspd_review">
                            <ul class="mb0">
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            </ul>
                          </div>
                        </div>
                        <h6 class="sub_title">965 seller reviews</h6>
                      </div>
                    </div>
                    <div class="vendor_address mb20">
                      <ul class="mb0">
                        <li><a href="#">1418 River Drive, Suite 35 Cottonhall, CA 9622 United States</a></li>
                        <li><a href="#">sale@zenmart.com</a></li>
                        <li><a href="#">+3 8493 92 932 021</a></li>
                      </ul>
                    </div>
                    <div class="d-grid">
                      <a class="btn btn-white bdr_thm" href="page-vendor-single.html">Visit Store</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="vendor_grid">
                  <div class="thumb">
                    <img src="{{ asset('front/images/vendors/6.jpg') }}" alt="Vendor 6 Image">
                  </div>
                  <div class="details">
                    <h5 class="title">Apple Store</h5>
                    <div class="flex-grow-1 mb15">
                      <div class="d-block d-md-flex">
                        <div class="sspd_postdate me-2 mb10-sm">
                          <div class="sspd_review">
                            <ul class="mb0">
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                              <li class="list-inline-item"><a href="#"><i class="fas fa-star"></i></a></li>
                            </ul>
                          </div>
                        </div>
                        <h6 class="sub_title">965 seller reviews</h6>
                      </div>
                    </div>
                    <div class="vendor_address mb20">
                      <ul class="mb0">
                        <li><a href="#">1418 River Drive, Suite 35 Cottonhall, CA 9622 United States</a></li>
                        <li><a href="#">sale@zenmart.com</a></li>
                        <li><a href="#">+3 8493 92 932 021</a></li>
                      </ul>
                    </div>
                    <div class="d-grid">
                      <a class="btn btn-white bdr_thm" href="page-vendor-single.html">Visit Store</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="mbp_pagination text-center">
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
  	</section>

@endsection
