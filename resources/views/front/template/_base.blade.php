<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stooon - Fashion eCommerce HTML Template</title>
    <!-- favicon -->
    <link rel=icon href="{{ asset('/assets') }}/img/favicon.png" sizes="20x20" type="image/png">
    <!-- Vendor Stylesheet -->
    <link rel="stylesheet" href="{{ asset('/assets') }}/css/vendor.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('/assets') }}/css/style.css">
    <!-- responsive Stylesheet -->
    <link rel="stylesheet" href="{{ asset('/assets') }}/css/responsive.css">
    <style>
        .breadcrumb-area {
            padding: 15px 0 !important;
        }
        .breadcrumb-area .container {
            padding-top: 0px !important;
        }
    </style>
    @yield('css')
</head>
<body>

    @include('front.template._header')
    @yield('content')
    @include('front.template._footer')

    <!-- all plugins here -->
    <script src="{{ asset('/assets') }}/js/vendor.js"></script>
    <!-- main js  -->
    <script src="{{ asset('/assets') }}/js/main.js"></script>
    <script>
        $(function(){
            $('footer').css({
                'margin-top':'0px'
            })
        });
    </script>
    @yield('js')
</body>
</html>