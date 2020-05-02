<!doctype html>
<html lang="ru">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">

    <title>TOTOSHA.top: @yield('title')</title>

</head>
<body class="bg-white m-auto">
<div id="app">
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/add.js') }}"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="{{ asset('js/slick.js') }}"></script>
<script>
    $(document).ready(function () {
        let imageCount = 5;
        let interval = 4000;
        if ($(window).width() < 900) {
            imageCount = 4;
        }
        if ($(window).width() < 760) {
            imageCount = 3;
        }

        if ($(window).width() < 640) {
            imageCount = 2  ;
            interval = 2000
        }
        if ($(window).width() < 400) {
            imageCount = 1;
            interval = 2000
        }

        $('.slickCarousel').slick({
            slidesToShow: imageCount,
            slidesToScroll: imageCount,
            // autoplay: true,
            autoplaySpeed: interval,
            dots:true,

            pauseOnHover:false,
        });
    });
</script>

</body>
</html>
