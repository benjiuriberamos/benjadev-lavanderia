<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dataside</title>
    <meta name="description" content="Dataside cooporation"/>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/solid/dist') }}/css/style.css">
	<script src="https://unpkg.com/animejs@3.0.1/lib/anime.min.js"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    @yield('css')

</head>
<body class="is-boxed has-animations">
    <div class="body-wrap">
        @include('front.template._header')
        <main>
            @yield('content')
        </main>
        @include('front.template._footer')
    </div>

    <script src="{{ asset('assets/solid/dist') }}/js/main.min.js"></script>
    @yield('js')

</body>
</html>
