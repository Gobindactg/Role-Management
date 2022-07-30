<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Role Permission</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('Backend.Partial.css')
    <!-- modernizr css -->
    <script src="{{asset('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body>
    <!-- preloader area start -->
    <!-- <div id="preloader">
        <div class="loader"></div>
    </div> -->
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        @include('Backend.Partial.sidebar')
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
        
            <!-- header area start -->
            @include('Backend.Partial.header')
            <!-- header area end -->

            @yield('content')

            <!-- footer area start-->
            @include('Backend.Partial.footer')

            <!-- footer area end-->
        </div>
        <!-- page container area end -->
        <!-- offset area start -->
       

        @include('Backend.Partial.setting')
        <!-- offset area end -->
        @include('sweetalert::alert')
        @include('Backend.Partial.js')
        @yield('script')
</body>

</html>