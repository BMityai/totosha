<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mimishka.kz @yield('title') </title>
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

    <script src="{{ asset('js/tiny.js') }}" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        .bg-black-alt {
            background: #191919;
        }

        .text-black-alt {
            color: #191919;
        }

        .border-black-alt {
            border-color: #191919;
        }

    </style>

</head>
<body class="bg-black-alt font-sans leading-normal tracking-normal">

<nav id="header" class="bg-gray-900 fixed w-full z-10 top-0 shadow">


    <div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3 md:pb-0">

        <div class="w-1/2 pl-2 md:pl-0">
            <a class="text-gray-100 text-base xl:text-xl no-underline hover:no-underline font-bold" href="#">
                Mimishka.kz
            </a>
        </div>
        <div class="w-1/2 pr-0">
            <div class="flex relative inline-block float-right">

                <div class="relative text-sm text-gray-100">
                    <button id="userButton" class="flex items-center focus:outline-none mr-3">
                        <span class="hidden md:inline-block text-gray-100">Admin</span>
                        <svg class="pl-2 h-2 fill-current text-gray-100" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129"
                             xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                            <g>
                                <path
                                    d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z"/>
                            </g>
                        </svg>
                    </button>
                    <div id="userMenu"
                         class="bg-gray-900 rounded shadow-md mt-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 invisible">
                        <ul class="list-reset">
                            <li><a href="#"
                                   class="px-4 py-2 block text-gray-100 hover:bg-gray-800 no-underline hover:no-underline">My
                                    account</a></li>
                            <li><a href="#"
                                   class="px-4 py-2 block text-gray-100 hover:bg-gray-800 no-underline hover:no-underline">Notifications</a>
                            </li>
                            <li>
                                <hr class="border-t mx-2 border-gray-400">
                            </li>
                            <li><a href="#"
                                   class="px-4 py-2 block text-gray-100 hover:bg-gray-800 no-underline hover:no-underline">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="block lg:hidden pr-4">
                    <button id="nav-toggle"
                            class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-100 hover:border-teal-500 appearance-none focus:outline-none">
                        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>
                                Menu</title>
                            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                        </svg>
                    </button>
                </div>
            </div>

        </div>

        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-gray-900 z-20"
             id="nav-content">
            <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">
                <li class="mr-6 my-2 md:my-0">
                    <a href="{{ route('admin.home') }}"
                       class="@if(request()->route()->uri == 'admin') border-b-2 border-blue-400 text-blue-400 @endif   block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline border-b-2 border-gray-900 hover:border-blue-400 hover:text-blue-400">
                        <i class="fas fa-home fa-fw mr-3 @if(request()->route()->uri == 'admin')text-blue-400 @endif"></i><span
                            class="pb-1 md:pb-0 text-sm"> Главная</span>
                    </a>
                </li>
                <li class="mr-6 my-2 md:my-0">
                    <a href="{{ route('admin.orders') }}"
                       class="@if(stripos(request()->route()->uri, 'order')) border-b-2 border-blue-400 text-blue-400 @endif   block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline border-b-2 border-gray-900 hover:border-blue-400 hover:text-blue-400">
                        <i class="fas fa-coins mr-3  @if(request()->route()->uri == 'admin/orders')text-blue-400 @endif"></i><span
                            class="pb-1 md:pb-0 text-sm">Заказы</span>
                    </a>
                </li>
                <li class="mr-6 my-2 md:my-0">
                    <a href="{{ route('admin.products') }}"
                       class="@if(stripos(request()->route()->uri, 'product')) border-b-2 border-blue-400 text-blue-400 @endif   block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline border-b-2 border-gray-900 hover:border-blue-400 hover:text-blue-400">
                        <i class="fas fa-fighter-jet mr-3 @if(request()->route()->uri == 'admin/products')text-blue-400 @endif"></i><span
                            class="pb-1 md:pb-0 text-sm">Продукция</span>
                    </a>
                </li>
                <li class="mr-6 my-2 md:my-0">
                    <a href="#"
                       class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-green-400">
                        <i class="fas fa-list-ol mr-3"></i><span class="pb-1 md:pb-0 text-sm">Категории</span>
                    </a>
                </li>
                <li class="mr-6 my-2 md:my-0">
                    <a href="#"
                       class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-red-400">
                        <i class="fa fa-users mr-3"></i><span class="pb-1 md:pb-0 text-sm">Пользователи</span>
                    </a>
                </li>
            </ul>


        </div>

    </div>
</nav>


@yield('content')

<script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="{{ asset('js/jquery.inputmask.js') }}"></script>



<script>
    var userMenuDiv = document.getElementById("userMenu");
    var userMenu = document.getElementById("userButton");

    var navMenuDiv = document.getElementById("nav-content");
    var navMenu = document.getElementById("nav-toggle");

    document.onclick = check;

    function check(e) {
        var target = (e && e.target) || (event && event.srcElement);

        //User Menu
        if (!checkParent(target, userMenuDiv)) {
            // click NOT on the menu
            if (checkParent(target, userMenu)) {
                // click on the link
                if (userMenuDiv.classList.contains("invisible")) {
                    userMenuDiv.classList.remove("invisible");
                } else {
                    userMenuDiv.classList.add("invisible");
                }
            } else {
                // click both outside link and outside menu, hide menu
                userMenuDiv.classList.add("invisible");
            }
        }

        //Nav Menu
        if (!checkParent(target, navMenuDiv)) {
            // click NOT on the menu
            if (checkParent(target, navMenu)) {
                // click on the link
                if (navMenuDiv.classList.contains("hidden")) {
                    navMenuDiv.classList.remove("hidden");
                } else {
                    navMenuDiv.classList.add("hidden");
                }
            } else {
                // click both outside link and outside menu, hide menu
                navMenuDiv.classList.add("hidden");
            }
        }

    }

    function checkParent(t, elm) {
        while (t.parentNode) {
            if (t == elm) {
                return true;
            }
            t = t.parentNode;
        }
        return false;
    }


    $(document).ready(function () {
        $('#fromDate').inputmask({"mask": "99/99/9999"});  //static mask
        $('#toDate').inputmask({"mask": "99/99/9999"});  //static mask
    });
</script>

</body>
</html>
