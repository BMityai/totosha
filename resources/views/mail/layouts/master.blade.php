<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

<header style="height: 100px; width: 100%; background-color: #2b6cb0; border-radius: 10px">
    <div style="height: 100%;text-align: center">
        <a href="{{ route('home') }}" class="inline-block">
            <img src="{{ asset('images/logos/logo_center_teddy.png') }}" alt=""
                 style="height: 80%">
        </a>
    </div>
</header>
<div style="padding: 5px">

@yield('content')

</div>
</body>
</html>
