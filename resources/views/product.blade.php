@extends('layouts.master')
@section('title', ':' . $product->name)
@section('content')


    <div class="container mt-16 ">
        <search-component></search-component>
        <div class="breadCrumbs mt-6">
            <a href="{{ route('home') }}">Главная</a>
            <span> / </span>
            <a href="{{ route('category', $product->category->slug) }}">{{ $product->category->name }}</a>
            <span> / </span>
            <span> {{ $product->name }} </span>

        </div>
        <h1 class="productName text-center text-xl mt-2  block sm:hidden">{{ $product->name }}</h1>

        <div class="productContent block    sm:flex">
            <div class="productImg mt-4 w-full sm:w-2/5 md:w-1/3">
                <div class="productSlickCarousel">
                    <img onclick="showProductFullImg(event)" class="rounded-t cursor-pointer" src="http://placehold.it/800x700" alt="">
                    <img onclick="showProductFullImg(event)" class="rounded-t cursor-pointer" src="http://placehold.it/800x700" alt="">
                    <img onclick="showProductFullImg(event)" class="rounded-t cursor-pointer" src="http://placehold.it/800x700" alt="">
                    <img onclick="showProductFullImg(event)" class="rounded-t cursor-pointer" src="http://placehold.it/800x700" alt="">
                    <img onclick="showProductFullImg(event)" class="rounded-t cursor-pointer" src="http://placehold.it/800x700" alt="">
                </div>

            </div>
            <div class="productDescription w-5/12 px-3 hidden sm:block">
                <h1 class="productName text-center text-2xl">{{ $product->name }}</h1>
                <div class="mt-6 text-md md:text-xl flex justify-between">
                    <p>Характеристики</p>
                    <a href="#productReviews" class=" text-blue-700 hover:text-blue-600 hover:underline"> Отзывы (2)</a>
                </div>
                <div class="artNo flex mt-4">
                    <div class="w-3/5 md:w-2/5 lg:w-1/3">
                        Артикул
                    </div>
                    <div class="pl-1 w-2/3">
                        6547654
                        {{ $product->art_no }}
                    </div>
                </div>

                @if($product->age)
                <div class="manufacturer flex mt-2">
                    <div class="w-3/5 md:w-2/5 lg:w-1/3">
                        Возраст
                    </div>
                    <div class="pl-1 w-2/3">
                        {{ $product->age }}
                    </div>
                </div>
                @endif

                @if($product->manufacturer)
                <div class="manufacturer flex mt-2">
                    <div class="w-3/5 md:w-2/5 lg:w-1/3">
                        Производитель
                    </div>
                    <div class="pl-1 w-2/3">
                        {{ $product->manufacturer }}
                    </div>
                </div>
                @endif

                @if($product->height && $product->weight && $product->depth)
                <div class="dimension flex mt-2">
                    <div class="w-3/5 md:w-2/5 lg:w-1/3">
                        Габариты
                    </div>
                    <div class="pl-1 w-2/3">
                        {{ $product->height }}mm x {{ $product->width }}mm x {{ $product->depth }}mm
                    </div>
                </div>
                @endif

                @if($product->material)
                <div class="material flex mt-2">
                    <div class="w-3/5 md:w-2/5 lg:w-1/3">
                        Материал
                    </div>
                    <div class="pl-1 w-2/3">
                        {{ $product->material }}
                    </div>
                </div>
                @endif

                @if($product->note)
                <div class="note flex mt-2">
                    <div class="w-3/5 md:w-2/5 lg:w-1/3">
                        * Примечание
                    </div>
                    <div class="pl-1 w-2/3">
                        {{ $product->note }}
                    </div>
                </div>
                @endif


            </div>
            <div class="priceInfo w-full sm:w-1/4 rounded p-2">
                <div class="priceInfoContent p-2">
                    <div class="flex leading-none">
                        <span class="w-1/2 text-xl  self-end">Цена</span>
                        <div class="priceBlock w-1/2">
                            <div
                                class="@if($product->discount == 0)text-xl font-bold @else text-lg line-through @endif text-right">{{$product->price}}
                                ₸
                            </div>
                            @if($product->discount > 0)<div class="text-xl text-right font-bold">{{$product->discount_price}} ₸</div> @endif
                        </div>
                    </div>

                    <div class="flex mt-4">
                        <span class="w-1/2 text-lg  self-end">Скидка</span>
                        <div class="priceBlock w-1/2">
                            <div class="text-lg @if($product->discount > 0) font-bold @endif text-right">{{$product->discount}} %</div>
                        </div>
                    </div>

                    <div class="flex mt-3">
                        <span class="w-1/2 text-lg  self-end">Вы экономите</span>
                        <div class="priceBlock w-1/2">
                            <div class="text-lg @if($product->discount > 0) font-bold @endif text-right">{{$product->price - $product->discount_price}} ₸</div>
                        </div>
                    </div>

                    <div class="flex mt-3">
                        <span class="w-1/2 text-lg  self-end">Бонусы</span>
                        <div class="priceBlock w-1/2 font-bold">
                            @if($product->discount == 0)
                                <div class="text-lg text-right">+ {{round($product->price * 0.03)}} ₸</div>
                            @else
                                <div class="text-lg text-right">+ {{round($product->discount_price * 0.03)}} ₸</div>
                            @endif
                        </div>
                    </div>

                    @if($product->count > 0 && !$product->coming_soon)
                        <a id="addButtonToBasket" href="{{ route('addToBasket') }}" onclick="addToCart(event)" data-csrf="{{ csrf_token() }}" data-id="{{ $product->id }}"
                           class="@if($product->getIfInTheBasket->isNotEmpty()) hidden @else block @endif text-lg sm:text-xs md:text-base w-full block text-center bg-orange-500 hover:bg-orange-600 p-2 mt-4 rounded outline-none">
                            В КОРЗИНУ
                        </a>
                        <a id="removeButtonFromCart" href="{{ route('addToBasket') }}" onclick="addToCart(event)" data-csrf="{{ csrf_token() }}" data-id="{{ $product->id }}"
                           class="@if($product->getIfInTheBasket->isNotEmpty()) block @else hidden @endif addCartButton text-lg sm:text-xs md:text-base w-full block text-center bg-orange-500 hover:bg-orange-600 p-2 mt-4 rounded outline-none">
                            В КОРЗИНЕ
                        </a>
                    @endif
                    @if($product->count == 0 && !$product->coming_soon)
                        <a
                            class="text-lg sm:text-xs md:text-base w-full block text-center bg-gray-500 p-2 mt-4 mr-auto ml-auto rounded outline-none">
                            НЕТ В НАЛИЧИИ
                        </a>
                    @endif
                    @if($product->count == 0 && $product->coming_soon)
                        <a
                            class="text-lg sm:text-xs md:text-base w-full block text-center bg-red-500 py-2 mt-4 mr-auto ml-auto rounded outline-none">
                            СКОРО В ПРОДАЖЕ
                        </a>
                    @endif

                    <a href="#" onclick="wishlistProductPage(event)"
                       class="text-lg sm:text-xs md:text-base w-full block text-center bg-indigo-500 hover:bg-indigo-600 p-2 mt-2 mr-auto ml-auto rounded outline-none">
                        В ИЗБРАННОЕ
                    </a>
                </div>
            </div>
            <div class="productDescription w-full sm:w-5/12 px-3 block sm:hidden">
                <div class="mt-6 text-xl sm:text-md md:text-xl flex justify-between">
                    <p>Характеристики</p>
                    <a href="#productReviews" class=" text-blue-700 hover:text-blue-600 hover:underline"> Отзывы (2)</a>
                </div>
                <div class="artNo flex mt-4">
                    <div class="w-1/2 sm:w-3/5 md:w-2/5 lg:w-1/3">
                        Артикул
                    </div>
                    <div class="pl-1 w-2/3">
                        6547654
                        {{ $product->art_no }}
                    </div>
                </div>

                @if($product->age)
                    <div class="manufacturer flex mt-2">
                        <div class="w-1/2 sm:w-3/5 md:w-2/5 lg:w-1/3">
                            Возраст
                        </div>
                        <div class="pl-1 w-2/3">
                            {{ $product->age }}
                        </div>
                    </div>
                @endif

                @if($product->manufacturer)
                    <div class="manufacturer flex mt-2">
                        <div class="w-1/2 sm:w-3/5 md:w-2/5 lg:w-1/3">
                            Производитель
                        </div>
                        <div class="pl-1 w-2/3">
                            {{ $product->manufacturer }}
                        </div>
                    </div>
                @endif

                @if($product->height && $product->weight && $product->depth)
                    <div class="dimension flex mt-2">
                        <div class="w-1/2 sm:w-3/5 md:w-2/5 lg:w-1/3">
                            Габариты
                        </div>
                        <div class="pl-1 w-2/3">
                            {{ $product->height }}mm x {{ $product->width }}mm x {{ $product->depth }}mm
                        </div>
                    </div>
                @endif

                @if($product->material)
                    <div class="material flex mt-2">
                        <div class="w-1/2 sm:w-3/5 md:w-2/5 lg:w-1/3">
                            Материал
                        </div>
                        <div class="pl-1 w-2/3">
                            {{ $product->material }}
                        </div>
                    </div>
                @endif

                @if($product->note)
                    <div class="note flex mt-2">
                        <div class="w-1/2 sm:w-3/5 md:w-2/5 lg:w-1/3">
                            * Примечание
                        </div>
                        <div class="text-sm sm:text-base pl-1 w-2/3">
                            {{ $product->note }}
                        </div>
                    </div>
                @endif


            </div>

        </div>

        <div class="mt-2 description w-full sm:w-3/4 text-xl px-3 sm:px-0">
            <div>
                Описание
            </div>
            <div class="text-base md:text-xl">
                {{$product->description}}
            </div>
        </div>

        <div id="productReviews" class="reviews px-3 w-full sm:w-3/4">
            <div class="text-xl mt-6 flex justify-between">
                <span>Отзывы (4)</span>
                <a onclick="showReviewForm(event)" class="ml-4 text-blue-700 hover:text-blue-600 hover:underline" href="#">Оставить отзыв</a>
            </div>
            <form id="reviewForm" action="" class="hidden">
                <textarea class="w-full border outline-none text-lg"  name="" id="" rows="10"></textarea>
                <input type="submit" value="ОТПРАВИТЬ" class="p-2 cursor-pointer rounded bg-blue-600 hover:bg-blue-500 text-white">
            </form>
            <div class="text-sm sm:text-xl">
                <div class="mt-2">
                    <span class="font-bold">TestName</span>
                    <span class="opacity-75 ml-4">12.12.2020 г. 13:34</span>
                </div>
                <div>
                    <p>
                        test review  test review test review test review test review test review test review test review test review test review test review test review test review test review test
                    </p>
                </div>
            </div>
            <div class="text-sm sm:text-xl">
                <div class="flex ">
                    <img class="w-10 sm:w-20 h-10 sm:h-20" src="{{ asset('images/ico/review/lapki.png') }}" alt="">

                    <div>
                        <div class="mt-2">
                            <span class="font-bold italic">Mimishka.kz</span>
                            <span class="opacity-75 ml-4">12.12.2020 г. 13:34</span>
                        </div>
                        <div class="italic">
                            <p>
                                test review  test review test review test review test review test review test review test review test review test review test review test review test review test review test
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="recommended mt-8">
            <h2 class="text-xl">Товары из этой категории</h2>
            <div class="slickCarousel ml-1 mr-1 text-center">

                @foreach($product->category->products as $product)
                    @include('layouts.card', $product)
                @endforeach

            </div>
        </div>
    </div>

@endsection
