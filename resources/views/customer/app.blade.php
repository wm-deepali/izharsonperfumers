<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="auto parts, baby store, ecommerce, electronics, fashion, food, marketplace, modern, multi vendor, multipurpose, organic, responsive, shop, shopping, store">
    <meta name="description" content="Zeomart - Multi-Vendor & Marketplace HTML Template">
    <meta name="CreativeLayers" content="ATFN">
    <!-- css file -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front/css/ace-responsive-menu.css')}}">
    <link rel="stylesheet" href="{{ asset('front/css/menu.css')}}">
    <link rel="stylesheet" href="{{ asset('front/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{ asset('front/css/fontawesome-free.css')}}">
    <link rel="stylesheet" href="{{ asset('front/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front/css/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('front/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('front/css/dashbord_navitaion.css')}}">
    <!-- Responsive stylesheet -->
    <link rel="stylesheet" href="{{ asset('front/css/responsive.css')}}">
    <!-- Title -->
    <title>@yield('title') | {{ config('app.name', 'Izharson Perfumers') }}</title>
    <!-- Favicon -->
    <link href="{{ asset('front/images/favicon.ico')}}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
    <link href="{{ asset('front/images/favicon.ico')}}" sizes="128x128" rel="shortcut icon" />
    <!-- Apple Touch Icon -->
    <link href="{{ asset('front/images/apple-touch-icon-60x60.png')}}" sizes="60x60" rel="apple-touch-icon">
    <link href="{{ asset('front/images/apple-touch-icon-72x72.png')}}" sizes="72x72" rel="apple-touch-icon">
    <link href="{{ asset('front/images/apple-touch-icon-114x114.png')}}" sizes="114x114" rel="apple-touch-icon">
    <link href="{{ asset('front/images/apple-touch-icon-180x180.png')}}" sizes="180x180" rel="apple-touch-icon">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll">
    <div class="wrapper">
        <header class="dashboard_header">
            <div class="header__container pt20 pb20 pl30 pr30">
                <div class="row justify-between items-center">
                    <div class="col-sm-4 col-xl-2">
                        <div class="text-center text-lg-start d-flex mb15-520">
                            <div class="fz20 me-4">
                                <a href="#" class="dashboard_sidebar_toggle_icon text-thm1 vam"><i
                                        class="fa-sharp fa-solid fa-bars-staggered"></i></a>
                            </div>
                            <div class="dashboard_header_logo">
                                <a href="index1.html" class="logo">Zeomart<span class="text-thm">.</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xl-3 d-none d-md-block">
                        <div class="header_search_widget mb15-520">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search"
                                    aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn" type="button"><span class="fa fa-search"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5 col-xl-6 offset-xl-1 d-none d-md-block">
                        <div class="text-center text-lg-end header_right_widgets">
                            <ul class="mb0 d-flex justify-content-center justify-content-sm-end">
                                <li class=""><a class="text-center" href="page-login.html"><span
                                            class="flaticon-exit"></span></a></li>
                                <li class=""><a class="text-center" href="#"><span
                                            class="flaticon-mail-inbox-app"></span></a></li>
                                <li class=""><a class="text-center" href="#"><span
                                            class="flaticon-notification"></span></a></li>
                                <li class=" user_setting">
                                    <div class="dropdown">
                                        <a class="btn dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                            <img src="{{ asset('front/images/resource/user.png')}}" alt="user.png">
                                        </a>
                                        <div class="dropdown-menu">
                                            <div class="user_setting_content">
                                                <a class="dropdown-item active" href="page-dashboard.html"><i
                                                        class="flaticon-house mr10"></i>Dashboard</a>
                                                <a class="dropdown-item" href="page-dashboard-products.html"><i
                                                        class="flaticon-cash-on-delivery mr10"></i>Products</a>
                                                <a class="dropdown-item" href="page-dashboard-order.html"><i
                                                        class="flaticon-checked-box mr10"></i>Order</a>
                                                <a class="dropdown-item" href="page-dashboard-customer.html"><i
                                                        class="flaticon-growth mr10"></i>Customer</a>
                                                <a class="dropdown-item" href="page-dashboard-categories.html"><i
                                                        class="flaticon-folder mr10"></i>Categories</a>
                                                <a class="dropdown-item" href="page-dashboard-message.html"><i
                                                        class="flaticon-mail-inbox-app mr10"></i>Message</a>
                                                <a class="dropdown-item" href="page-dashboard-setting.html"><i
                                                        class="flaticon-settings mr10"></i>Settings</a>
                                                <a class="dropdown-item" href="{{ route('customer.logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <i class="flaticon-exit mr10"></i>Logout
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="dashboard_content_wrapper">
            <div class="dashboard dashboard_wrapper pr30 pr0-md">
                <div class="dashboard__sidebar">
                    <div class="dashboard_sidebar_list">
                        <div class="sidebar_list_item">
                            <a href="page-dashboard.html" class="items-center -is-active"><i
                                    class="flaticon-house mr15"></i>Dashboard</a>
                        </div>
                        <div class="sidebar_list_item ">
                            <a href="page-dashboard-products.html" class="items-center"><i
                                    class="flaticon-cash-on-delivery mr15"></i>Products</a>
                        </div>
                        <div class="sidebar_list_item ">
                            <a href="page-dashboard-order.html" class="items-center"><i
                                    class="flaticon-checked-box mr15"></i>Order</a>
                        </div>
                        <div class="sidebar_list_item ">
                            <a href="page-dashboard-customer.html" class="items-center"><i
                                    class="flaticon-growth mr15"></i>Customer</a>
                        </div>
                        <div class="sidebar_list_item ">
                            <a href="page-dashboard-categories.html" class="items-center"><i
                                    class="flaticon-folder mr15"></i>Categories</a>
                        </div>
                        <div class="sidebar_list_item ">
                            <a href="page-dashboard-message.html" class="items-center"><i
                                    class="flaticon-mail-inbox-app mr15"></i>Message</a>
                        </div>
                        <div class="sidebar_list_item ">
                            <a href="page-dashboard-setting.html" class="items-center"><i
                                    class="flaticon-settings mr15"></i>Settings</a>
                        </div>
                        <div class="sidebar_list_item ">
                            <a href="{{ route('customer.logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="items-center"><i class="flaticon-exit mr15"></i>Logout</a>
                            <form id="logout-form" action="{{ route('customer.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <div class="dashboard__main pl0-md">

                    @yield('content')

                    <footer class="dashboard_footer pt30 pb30">
                        <div class="container">
                            <div class="row items-center justify-content-center justify-content-md-between">
                                <div class="col-auto">
                                    <div class="copyright-widget text-center text-lg-start d-block d-lg-flex mb15-md">
                                        <p class="me-4">漏 2025 Zeomart. All Rights Reserved</p>
                                        <p><a href="#">Privacy</a> 路 <a href="#">Terms</a> 路 <a href="#">Sitemap</a></p>
                                    </div>
                                </div>
                                <div class="col-auto">
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
                    </footer>
                </div>
            </div>
        </div>
        <a class="scrollToHome" href="#"><i class="fas fa-angle-up"></i></a>
    </div>
    <!-- Wrapper End -->
    <script src="{{ asset('front/js/jquery-3.6.0.js')}}"></script>
    <script src="{{ asset('front/js/jquery-migrate-3.0.0.min.js')}}"></script>
    <script src="{{ asset('front/js/popper.min.js')}}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('front/js/bootstrap-select.min.js')}}"></script>
    <script src="{{ asset('front/js/chart.min.js')}}"></script>
    <script src="{{ asset('front/js/chart-custome.js')}}"></script>
    <script src="{{ asset('front/js/jquery.mmenu.all.js')}}"></script>
    <script src="{{ asset('front/js/ace-responsive-menu.js')}}"></script>
    <script src="{{ asset('front/js/parallax.js')}}"></script>
    <script src="{{ asset('front/js/jquery-scrolltofixed-min.js')}}"></script>
    <script src="{{ asset('front/js/wow.min.js')}}"></script>
    <script src="{{ asset('front/js/slider.js')}}"></script>
    <script src="{{ asset('front/js/range-slider.js')}}"></script>
    <script src="{{ asset('front/js/dashboard-script.js')}}"></script>
    <!-- Custom script for all pages -->
    <script src="{{ asset('front/js/script.js')}}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Pie chart
            new Chart(document.getElementById("chartjs-dashboard-pie"), {
                type: "pie",
                data: {
                    labels: ["Direct", "Affiliate", "E-mail", "Other"],
                    datasets: [{
                        data: [2602, 1253, 541, 1465],
                        backgroundColor: [
                            window.theme.primary,
                            window.theme.warning,
                            window.theme.danger,
                            "#E8EAED"
                        ],
                        borderWidth: 5,
                        borderColor: window.theme.white
                    }]
                },
                options: {
                    responsive: !window.MSInputMethodContext,
                    maintainAspectRatio: false,
                    cutoutPercentage: 70,
                    legend: {
                        display: false
                    }
                }
            });
        });
    </script>
</body>

</html>