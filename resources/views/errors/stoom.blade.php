<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- favicon -->
    <link rel=icon href={{ asset('/') }}assets/img/favicon.png sizes="20x20" type="image/png">
    <!-- Vendor Stylesheet -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/vendor.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/style.css">
    <!-- responsive Stylesheet -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/responsive.css">
</head>
<body>

    <!-- preloader area start -->
    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->

    <!-- error start  -->
    <div class="error-area">
        <div class="error-header text-center">
            <a href="index.html">
                <img src="{{ asset('/') }}assets/img/logo.png" alt="">
            </a>
        </div>
        <div class="error-content margin-top-80 text-center">
            <h2>@yield('message')</h2>
            <h6>Sorry, but the page you are looking for is not found. Please, make<br> sure you have typed the current URL.</h6>
            <img src="{{ asset('/') }}assets/img/others/404.png" alt="404">
            <div class="btn-wrapper">
                <a href="{{ app('router')->has('home') ? route('home') : url('/') }}" class="btn btn-error"><i class="icon-left-arrow-slider"></i> Go to home</a>
            </div>
        </div>
    </div>
    <!-- error end  -->

    <!-- all plugins here -->
    <script src="{{ asset('/') }}assets/js/vendor.js"></script>
    <!-- main js  -->
    <script src="{{ asset('/') }}assets/js/main.js"></script>
</body>
</html>