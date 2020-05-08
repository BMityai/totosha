<header>
    <div id="displayOverlayMenu" class="h-full w-full bg-blue-600 absolute z-10 h-screen overflow-auto">
        <div class="container p-1 mt-16 pb-3">
            <div class="logoMenu w-1/2 z-10 ml-auto mr-auto opacity-75 hover:opacity-100">
                <a href="/" class="inline-block">
                    <img src="{{ asset('images/logos/logo_center_teddy.png') }}" alt=""
                         class="opacity-75 hover:opacity-100">
                </a>
            </div>
            <div class="menuContent pl-4 pr-4 block sm:flex justify-around mt-10 text-white text-xl font-bold">
                <div class="menuCategories w-full sm:w-2/5">
                    <h2 class="uppercase">Категории</h2>
                    <hr>
                    @foreach($categories as $category)
                        <a href="{{ route('category', $category->slug) }}"><p class="opacity-75 hover:opacity-100 mt-4"> {{ $category->name }}</p></a>
                    @endforeach
                </div>
                <div class="menuInfoContent w-full sm:w-2/5 mt-10 sm:mt-0">
                    <h2 class="uppercase">Инфо</h2>
                    <hr>
                    <a href=""><p class="opacity-75 hover:opacity-100 mt-4">О нас</p></a>
                    <a href=""><p class="opacity-75 hover:opacity-100 mt-4">Отзывы</p></a>
                    <a href=""><p class="opacity-75 hover:opacity-100 mt-4">Оплата и доставка</p></a>
                    <a href=""><p class="opacity-75 hover:opacity-100 mt-4">Возврат товара</p></a>
                    <a href=""><p class="opacity-75 hover:opacity-100 mt-4">Как оформить заказ?</p></a>
                    <a href=""><p class="opacity-75 hover:opacity-100 mt-4">Бонусная программа</p></a>
                    <a href=""><p class="opacity-75 hover:opacity-100 mt-4">Контакты</p></a>
                    <a href=""><p class="opacity-75 hover:opacity-100 mt-4">Оптовые продажи</p></a>
                    <a href=""><p class="opacity-75 hover:opacity-100 mt-4">Принимаем заказы</p></a>
                </div>
            </div>
        </div>
    </div>
    <div id="displayOverlayCabinet"
         class="shadow-md rounded px-8 pt-6 pb-8 mb-4 h-auto w-3/4 sm:w-1/2 md:1/3 lg:w-1/3 bg-blue-600 fixed z-10">
        <div class="login">
            <form class="" action="{{ route('login') }}">
                <div class="mb-4">
                    <label class="block text-white text-base font-bold mb-2" for="emailForm">
                        Email
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="emailForm" name="email" type="text" placeholder="Email">
                </div>
                <div class="mb-6">
                    <label class="block text-white text-base font-bold mb-2" for="password">
                        Пароль
                    </label>
                    <input
                        class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="password" type="password" placeholder="******************" name="password">
                    <p class="text-red-700 font-bold text-base italic">Please choose a password.</p>
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="w-1/2 bg-orange-600 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Войти
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-white hover:text-gray-400" href="#">
                        Забыли пароль?
                    </a>
                </div>
            </form>
            <form class="registerLink" method="get" action="{{ route('register') }}">
                <button type="submit">Регистрация</button>
            </form>
        </div>
    </div>
    <div id="displayOverlayCart"
         class=" shadow-md rounded px-5 pt-6 pb-6 mb-4 h-auto w-3/4 sm:w-1/2 md:1/3 lg:w-1/3 bg-blue-600 fixed z-10">
        <div class="miniCartItemsContent overflow-y-auto">
            <minicart-component></minicart-component>
            <minicart-component></minicart-component>
            <minicart-component></minicart-component>
            <minicart-component></minicart-component>
            <minicart-component></minicart-component>
            <minicart-component></minicart-component>
            <minicart-component></minicart-component>
            <minicart-component></minicart-component>
            <minicart-component></minicart-component>
        </div>
        <div class="totalPrice flex justify-between text-xl text-white opacity-75 font-bold">
            <p>Итого:</p>
            <p>3421 ₸</p>
        </div>

        <div>
            <a href="">
                <p class="bg-orange-500 hover:bg-orange-600 rounded text-center p-2">Перейти в корзину</p>
            </a>
        </div>

    </div>
    <div id="displayOverlayAddToCart"
         class=" shadow-md rounded pt-12 bg-green-400 fixed z-10 text-white w-full text-center text-bold">
    </div>
    <div id="displayOverlayAddToWishList"
         class=" shadow-md rounded pt-12 bg-red-500 fixed z-10 text-white w-full text-center text-bold">
    </div>



    <div class="bg-blue-600 h-12 fixed top-0 right-0 left-0 z-20">
        <div class="container h-full flex justify-between">

            <div id="menuToggle" class="z-20 opacity-75 hover:opacity-100 cursor-pointer" onclick="menuShow()">
                <span id="sandwich_1"></span>
                <span id="sandwich_2"></span>
                <span id="sandwich_3"></span>
            </div>

            <div class="logo h-full z-10 absolute">
                <a href="/" class="h-full inline-block">
                    <img src="{{ asset('images/logos/logo-white-no_bgrnd.png') }}" alt=""
                         class="logoFullImg h-full opacity-75 hover:opacity-100">
                    <img src="{{ asset('images/logos/logo_no_teddy.png') }}" alt=""
                         class="logoSmallImg h-full opacity-75 hover:opacity-100">
                </a>
            </div>
            <div class="rightElements text-right p-2 z-10 flex">
                <div class="wishList h-full inline-block">
                    <a href="#" class="h-full inline-block relative">
                        <img class="h-full opacity-75 hover:opacity-100"
                             src="{{ asset('images/ico/header/wish_list.png') }}" alt="">
                        <span id="wishlistInfoNum" class="infoNum absolute z-10 ">21</span>
                        <span class="info absolute bg-white text-white">6</span>
                    </a>
                </div>

                <div id="cartId" class="basket h-full inline-block ml-4" onclick="cartShow()">
                    <div class="h-full inline-block relative">
                        <img class="h-full opacity-75 hover:opacity-100 cursor-pointer"
                             src="{{ asset('images/ico/header/shopping-bag.png') }}" alt="">
                        <span id="cartInfoNum" class="infoNum absolute z-10 ">2</span>
                        <span class="info absolute bg-white text-white">6</span>
                    </div>
                </div>

                <div id="cabinetId" class="cabinet h-full inline-block ml-4" onclick="cabinetMenuShow()">
                    <img class="h-full opacity-75 hover:opacity-100 cursor-pointer"
                         src="{{ asset('images/ico/header/login.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>

</header>
