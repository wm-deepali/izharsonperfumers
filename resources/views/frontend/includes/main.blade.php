<!DOCTYPE HTML>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>

    <meta charset="utf-8">

    <meta http-equiv="pragma" content="no-cache" />

     <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta http-equiv="cache-control" content="max-age=604800" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Izharson Perfumers, Lucknow | @yield('title')</title>

    <link href="{{asset('frontend/images/favicon.png')}}" rel="shortcut icon" type="image/x-icon">

    <!-- Bootstrap4 files-->

    <link rel="icon" type="image/png" href="{{asset('frontend/images/favicon.png')}}">

    <link href="{{asset('frontend/css/bootstrap.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('frontend/css/owl.carousel.min.css')}}" rel="stylesheet">

    <link href="{{asset('frontend/css/owl.theme.css')}}" rel="stylesheet">

    <link href="{{asset('frontend/css/owl.theme.green.css')}}" rel="stylesheet">

    <!-- Font awesome 5 -->

    <link href="{{asset('frontend/fonts/fontawesome/css/all.min3661.css')}}" type="text/css" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- custom style -->

    <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('frontend/css/ui.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet" type="text/css" />





    <!-- jQuery -->

    <script src="{{asset('frontend/js/jquery-2.0.0.min.js')}}" type="text/javascript"></script>

    <!-- Bootstrap4 files-->

    <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>

    <!-- Font awesome 5 -->

    <script src="{{asset('frontend/js/owl.carousel.js')}}"></script>

     <script src="{{asset('frontend/js/owl.carousel2.thumbs.min.js')}}"></script>

    <!-- custom javascript -->

    <script src="{{asset('frontend/js/script.js')}}" type="text/javascript"></script>

    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>

    <script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  </head>

  <body>



     @include('frontend.includes.top_header')

     @include('frontend.includes.header_navbar')

<!-- For Showing erorr mssage uncomment info blade  -->

 <!--   <div class="container ">@include('frontend.includes.info')</div>  -->



        @yield('content')

 

        @include('frontend.includes.footer')

   



   <!-- put all js files here to load page faster  -->

     @yield('js')



  </body>

</html>