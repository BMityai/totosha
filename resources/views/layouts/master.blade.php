<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-171069360-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-171069360-1');
    </script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="uri" content="{{ route('addToBasket') }}">
    <meta name="wishlistadduri" content="{{ route('addToWishList') }}">
    <meta name="count_uri" content="{{ route('changeCount') }}">
    <title>Mimishka.kz @yield('title')</title>
    <meta name="description" content="@yield('description')">

</head>
<body class="bg-white m-auto">
<div id="app">
    @include('layouts.header')

    @yield('content')
</div>
@include('layouts.footer')

<script src="{{ asset('js/axios.min.js') }}"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/add.js') }}"></script>
<script src="{{ asset('js/slick.js') }}"></script>
<script src="{{ asset('js/jquery.inputmask.js') }}"></script>
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
            imageCount = 2;
            interval = 2000
        }
        if ($(window).width() < 400) {
            imageCount = 2;
            interval = 2000
        }

        $('.slickCarousel').slick({
            slidesToShow: imageCount,
            slidesToScroll: imageCount,
            autoplay: true,
            autoplaySpeed: interval,
            dots: true,
            pauseOnHover: false,
        });


        $('.productSlickCarousel').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: interval,
            dots: true,
            pauseOnHover: false,
        });
    });

    $(document).ready(function () {
        $('#birthDate').inputmask({"mask": "99/99/9999"});  //static mask
        $('#phone').inputmask({"mask": "+7 (999) 999-99-99"}); //specifying options
    });

</script>

</body>
</html>
