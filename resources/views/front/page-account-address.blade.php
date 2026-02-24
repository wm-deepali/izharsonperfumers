@extends('front.app')

@section('title', 'Page Vendor List')

@section('content')

    <!-- Our Dashbord -->
    <section class="our-dashbord dashbord pb90">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-xl-2 dn-md">
                    <div class="users_account_details extra-dashboard-menu">
                        <div class="account_details_user d-flex pb10 bb1 mb10">
                            <img class="me-3" src="{{ asset('front/images/team/ad-thumb.png')}}" alt="Generic placeholder image">
                            <div class="content_details text-start">
                                <h5 class="title">Ali Tufan</h5>
                                <a class="stitle" href="mailto:alitfn58@gmail.com">alitfn58@gmail.com</a>
                            </div>
                        </div>
                        <div class="ed_menu_list">
                            <ul>
                                <li><a href="page-account-details.html"><span class="flaticon-growth"></span>Account
                                        Details</a></li>
                                <li><a href="page-account-order.html"><span class="flaticon-checked-box"></span>Order</a>
                                </li>
                                <li><a class="active" href="page-account-address.html"><span
                                            class="flaticon-location"></span>Address</a></li>
                                <li><a href="page-account-wishlist.html"><span class="flaticon-badge"></span>Wishlist</a>
                                </li>
                                <li><a href="page-account-invoice.html"><span class="flaticon-invoice"></span>Invoices</a>
                                </li>
                                <li><a href="page-login.html"><span class="flaticon-exit"></span>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-xl-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dashboard_navigationbar dn db-md mt50">
                                <div class="dropdown">
                                    <button onclick="myFunction()" class="dropbtn"><i class="fas fa-bars pr10"></i>
                                        Dashboard Navigation</button>
                                    <ul id="myDropdown" class="dropdown-content">
                                        <li><a href="page-account-details.html"><span class="flaticon-growth"></span>Account
                                                Details</a></li>
                                        <li><a href="page-account-order.html"><span
                                                    class="flaticon-checked-box"></span>Order</a></li>
                                        <li><a class="active" href="page-account-address.html"><span
                                                    class="flaticon-location"></span>Address</a></li>
                                        <li><a href="page-account-wishlist.html"><span
                                                    class="flaticon-badge"></span>Wishlist</a></li>
                                        <li><a href="page-account-invoice.html"><span
                                                    class="flaticon-invoice"></span>Invoices</a></li>
                                        <li><a href="page-login.html"><span class="flaticon-exit"></span>Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-10">
                            <div class="account_user_deails pl40 pl0-lg">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2 class="title mb30">Address</h2>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="dboard_address mb30-md">
                                            <h4 class="title mb15">Billing Address <span class="float-end">Edit</span></h4>
                                            <p>Daniel Robinson</p>
                                            <p>1418 River Drive, Suite 35 Cottonhall, CA 9622</p>
                                            <p>United States</p>
                                            <p class="mt30">sale@zenmart.com</p>
                                            <p>+3 8493 92 932 021</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 offset-lg-1">
                                        <div class="dboard_address">
                                            <h4 class="title mb15">Shipping Address <span class="float-end">Edit</span></h4>
                                            <p>Daniel Robinson</p>
                                            <p>1418 River Drive, Suite 35 Cottonhall, CA 9622</p>
                                            <p>United States</p>
                                            <p class="mt30">sale@zenmart.com</p>
                                            <p>+3 8493 92 932 021</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection