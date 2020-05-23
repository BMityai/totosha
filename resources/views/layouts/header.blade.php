<header>
    <div id="displayOverlayMenu" class="h-full w-full bg-blue-600 absolute z-30 h-screen overflow-auto">
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
                        <a href="{{ route('category', $category->slug) }}"><p
                                class="opacity-75 hover:opacity-100 mt-4"> {{ $category->name }}</p></a>
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
         class="shadow-md rounded px-8 pt-6 pb-8 mb-4 h-auto w-3/4 sm:w-1/2 md:1/3 lg:w-1/3 bg-blue-600 fixed z-30 @if(session()->has('getLogin')) showCabinetMenu @endif">

        @auth
            @if(request()->user()->hasVerifiedEmail())
                <div class="bonusCabinet flex justify-center text-white text-xl">
                    <p>Мои бонусы: </p>
                    <p>&#8195; {{ \Illuminate\Support\Facades\Auth::user()->bonus }} ₸</p>
                </div>

                <a href="{{ route('ordersHistory') }}">
                    <div class="flex text-white mt-2 rounded p-2 hover:bg-blue-700">
                        <img class="w-8 h-8" src="{{ asset('images/ico/cabinet/orders.png') }}" alt="">
                        <p class="text-lg ml-4">История заказов</p>
                    </div>
                </a>

                <a href="{{ route('bonusHistory') }}">
                    <div class="flex text-white mt-2 rounded p-2 hover:bg-blue-700">
                        <img class="w-8 h-8" src="{{ asset('images/ico/cabinet/bonus.png') }}" alt="">
                        <p class="text-lg ml-4">Бонусный счет</p>
                    </div>
                </a>

                <a href="{{ route('wishList') }}">
                    <div class="flex text-white mt-2 rounded p-2 hover:bg-blue-700">
                        <img class="w-8 h-8" src="{{ asset('images/ico/cabinet/wishlist.png') }}" alt="">
                        <p class="text-lg ml-4"> Мой WishList</p>
                    </div>
                </a>

                <a href="{{ route('getFormForUpdateUserData') }}">
                    <div class="flex text-white mt-2 rounded p-2 hover:bg-blue-700">
                        <img class="w-8 h-8" src="{{ asset('images/ico/cabinet/anketa.png') }}" alt="">
                        <p class="text-lg ml-4"> Обновить анкету</p>
                    </div>
                </a>

                <a href="{{ route('changePasswordForm') }}">
                    <div class="flex text-white mt-2 rounded p-2 hover:bg-blue-700">
                        <img class="w-8 h-8" src="{{ asset('images/ico/cabinet/password.png') }}" alt="">
                        <p class="text-lg ml-4"> Сменить пароль</p>
                    </div>
                </a>

                <a href="{{ route('logout') }}">
                    <div class="flex text-white mt-2 rounded p-2 hover:bg-blue-700">
                        <img class="w-8 h-8" src="{{ asset('images/ico/cabinet/logout.png') }}" alt="">
                        <p class="text-lg ml-4"> Выйти</p>
                    </div>
                </a>

            @else
                <p class="text-white text-lg text-center">Регистрация не завершена, необходимо верифицировать email</p>
                <p class="text-center font-bold mt-4"><a class="hover:underline text-white text-lg"
                                                         href="{{ route('verification.notice') }}">Подтвердить email</a>
                </p>
                <p class="text-center font-bold mt-4"><a class="hover:underline text-white text-lg"
                                                         href="{{ route('logout') }}">Выйти и зарегистрироваться
                        повторно</a></p>
            @endif
        @endauth

        @guest()
            <div class="login">
                <form class="" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-white text-base font-bold mb-2" for="emailForm">
                            Email
                        </label>
                        <input
                            class="shadow appearance-none border @error('email') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="emailForm" name="email" type="text" placeholder="Email" value="{{old('email')}}">
                        @error('email')
                        <span class="text-red-700 font-bold text-base italic" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label class="block text-white text-base font-bold" for="password">
                            Пароль
                        </label>
                        <input
                            class="shadow appearance-none border @error('password') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                            id="password" type="password" placeholder="******************" name="password">
                        @error('password')
                        <span class="text-red-700 font-bold text-base italic" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="flex items-center justify-between">
                        <button
                            class="w-1/2 bg-orange-600 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                            Войти
                        </button>
                        <a class="inline-block align-baseline font-bold text-sm text-white hover:text-gray-400"
                           href="{{ route('password.request') }}">
                            Забыли пароль?
                        </a>
                    </div>
                </form>
                <form class="registerLink" method="get" action="{{ route('register') }}">
                    <button type="submit">Регистрация</button>
                </form>
            </div>
        @endguest
    </div>
    <div id="displayOverlayCart"
         class=" shadow-md rounded px-5 pt-6 pb-6 mb-4 h-auto w-3/4 sm:w-1/2 md:1/3 lg:w-1/3 bg-blue-600 fixed z-30">
        <div id="notEmptyCart" class="@if($cartInfo->count() > 0) block @else hidden @endif">
            <div id="miniCartItemsContent" class="miniCartItemsContent overflow-y-auto">
                @foreach($cartInfo as $productInCart)
                    @include('layouts.miniCartItem', ['productInCart' => $productInCart])
                @endforeach
            </div>
            <div class="totalPrice flex justify-between text-xl text-white opacity-75 font-bold">
                <p>Итого:</p>
                <p id="cartTotalPrice"></p>
            </div>
            <div>
                <a href="{{ route('basket') }}">
                    <p class="bg-orange-500 hover:bg-orange-600 rounded text-center p-2">Перейти в корзину</p>
                </a>
            </div>
        </div>
        <p id="emptyCart" class="text-white text-center @if($cartInfo->count() > 0) hidden @else block @endif">Ваша
            корзина пуста</p>

    </div>
    <div id="displayOverlayAddToCart"
         class=" shadow-md rounded pt-12 fixed z-10 text-white w-full text-center text-bold">
    </div>
    <div id="displayOverlayAddToWishList"
         class=" shadow-md rounded pt-12 fixed z-10 text-white w-full text-center text-bold">
    </div>
    <div
        class="authErrorMsg text-lg shadow-md rounded pt-12 bg-red-700 fixed z-10 text-white w-full text-center text-bold @if(session('auth')) block @else hidden @endif">
        Вы не авторизованы. Войдиде в аккаунт пожалуйста.
    </div>
    <div
        class="loginErrorMsg text-lg shadow-md rounded pt-12 bg-red-700 fixed z-10 text-white w-full text-center text-bold @error('password') block @else hidden @enderror">
        Ошибка авторизации
    </div>
    <div
        class="loginErrorMsg text-lg shadow-md rounded pt-12 bg-red-700 fixed z-10 text-white w-full text-center text-bold @error('email') block @else hidden @enderror">
        Ошибка авторизации
    </div>
    <div
        class="succesVerify text-lg shadow-md rounded pt-12 bg-green-500 fixed z-10 text-white w-full text-center text-bold @if(session('emailVerify')) block @else hidden @endif">
        Поздравляем. Верификация прошла успешно.
    </div>
    <div
        class="text-lg shadow-md rounded pt-12 bg-green-500 fixed z-10 text-white w-full text-center text-bold @if(session('updateData')) block @else hidden @endif">
        {{ session()->get('updateData') }}
    </div>
    <div
        class="emailNotVerufy text-lg shadow-md rounded pt-12 bg-red-700 fixed z-10 text-white w-full text-center text-bold @if(session('emailNotVerify')) block @else hidden @endif">
        Регистрация не завершена. Пожалуйста, подтвердите email адрес.
    </div>

    <div onclick="showProductFullImg(event)" id="productFullImgModal"
         class="overflow-y-auto w-full h-full z-10 absolute">
        <img id="productFullImg" class=" absolute rounded-t cursor-pointer" src="http://placehold.it/830x730" alt="">
    </div>

    <div class="bg-blue-600 h-12 fixed top-0 right-0 left-0 z-30">
        <div class="container h-full flex justify-between">

            <div id="menuToggle" class="z-30 opacity-75 hover:opacity-100 cursor-pointer" onclick="menuShow()">
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
                    <a href="{{ route('wishList') }}" class="h-full inline-block relative">
                        <img class="h-full opacity-75 hover:opacity-100"
                             src="{{ asset('images/ico/header/wish_list.png') }}" alt="">
                        <span id="wishlistInfoNum" class="@if($wishListInfo > 0) block @else hidden @endif infoNum absolute z-10 ">{{ $wishListInfo }}</span>
                        <span id="wishlistInfoBgrnd" class="@if($wishListInfo > 0) block @else hidden @endif info absolute bg-white text-white">6</span>
                    </a>
                </div>

                <div id="cartId" class="basket h-full inline-block ml-4" onclick="cartShow()">
                    <div class="h-full inline-block relative">
                        <img class="h-full opacity-75 hover:opacity-100 cursor-pointer"
                             src="{{ asset('images/ico/header/shopping-bag.png') }}" alt="">
                        <span id="cartInfoNum"
                              class="infoNum cursor-pointer absolute z-10 @if($cartInfo->count() < 1)hidden @else block @endif">{{ $cartInfo->count() }}</span>
                        <span id="cartInfoBgrnd"
                              class="info cursor-pointer absolute bg-white text-white @if($cartInfo->count() < 1)hidden @else block @endif">6</span>
                    </div>
                </div>
                <div id="cabinetId" class="cabinet relative h-full inline-block ml-4" onclick="cabinetMenuShow()">
                    <img class="h-full opacity-75 hover:opacity-100 cursor-pointer"
                         src="{{ asset('images/ico/header/login.png') }}" alt="">
                    @auth
                        <span
                            class="infoNum absolute z-10 ">{{substr(\Illuminate\Support\Facades\Auth::user()->name, 0, 1)}}</span>
                        <span class="info absolute bg-white text-white">6</span>
                    @endauth
                </div>
            </div>
        </div>
    </div>

</header>
