@extends('layouts.master')
@section('title', ':' . $product->name)
@section('content')


    <div class="container mt-16 ">
        @include('layouts.search')
        <div class="breadCrumbs mt-6">
            <a href="{{ route('home') }}">Главная</a>
            <span> / </span>
            <a href="{{ route('category', $product->category->slug) }}">{{ $product->category->name }}</a>
            <span> / </span>
            <span> {{ $product->name }} </span>

        </div>
        <h1 class="productName text-center text-xl mt-2  block sm:hidden">{{ $product->name }}</h1>

        <div class="productContent block sm:flex">
            <div class="productImg mt-4 w-full sm:w-2/5 md:w-1/3">
                <div class="productSlickCarousel">
                    @if(count($product->images) > 0)
                    @foreach($product->images as $image)
                            <a class="fancybox-img" href="{{ asset($image->path) }}" rel="group1">
                    <img  class="test rounded-t cursor-pointer"
                         src="{{ asset($image->path) }}" alt="">
                            </a>
                    @endforeach
                    @else
                    <img onclick="showProductFullImg(event)" class="rounded-t cursor-pointer"
                         src="{{ asset('/images/default.png') }}" alt="">
                    @endif
                </div>

                <div class="thumb-slider">
                    @if(count($product->images) > 0)
                        @foreach($product->images as $image)
                            <img  class="rounded-t cursor-pointer"
                                 src="{{ asset($image->path) }}" alt="">
                        @endforeach
                    @else
                        <img onclick="showProductFullImg(event)" class="rounded-t cursor-pointer"
                             src="{{ asset('/images/default.png') }}" alt="">
                    @endif
                </div>

            </div>
            <div class="productDescription w-5/12 px-3 hidden sm:block">
                <h1 class="productName text-center text-2xl">{{ $product->name }}</h1>
                <div class="mt-6 text-md md:text-xl flex justify-between">
                    <p>Характеристики</p>
                    <a href="#productReviews" class=" text-blue-700 hover:text-blue-600 hover:underline"> Отзывы ({{ count($product->reviews) }})</a>
                </div>
                <div class="artNo flex mt-4">
                    <div class="w-3/5 md:w-2/5 lg:w-1/3">
                        Артикул
                    </div>
                    <div class="pl-1 w-2/3">
                        {{ $product->art_no }}
                    </div>
                </div>

                @if($product->age)
                    <div class="manufacturer flex mt-2">
                        <div class="w-3/5 md:w-2/5 lg:w-1/3">
                            Возраст
                        </div>
                        <div class="pl-1 w-2/3">
                            {{ $product->age->age     }}
                        </div>
                    </div>
                @endif

                @if($product->manufacturer)
                    <div class="manufacturer flex mt-2">
                        <div class="w-3/5 md:w-2/5 lg:w-1/3">
                            Производитель
                        </div>
                        <div class="pl-1 w-2/3">
                            {{ $product->manufacturer->country }}
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
                            {{ $product->material->name }}
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
                            @if($product->discount > 0)
                                <div class="text-xl text-right font-bold">{{$product->discount_price}} ₸</div> @endif
                        </div>
                    </div>

                    @if($product->discount > 0)
                    <div class="flex mt-4">
                        <span class="w-1/2 text-lg  self-end">Скидка</span>
                        <div class="priceBlock w-1/2">
                            <div
                                class="text-lg font-bold text-right">{{$product->discount}}
                                %
                            </div>
                        </div>
                    </div>

                    <div class="flex mt-3">
                        <span class="w-1/2 text-lg  self-end">Вы экономите</span>
                        <div class="priceBlock w-1/2">
                            <div
                                class="text-lg font-bold text-right">{{$product->price - $product->discount_price}}
                                ₸
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="flex mt-3">
                        <span class="w-1/2 text-lg  self-end">Бонусы</span>
                        <div class="priceBlock w-1/2 font-bold">
                            @if($product->discount == 0)
                                <div class="text-lg text-right">+ {{round($product->price * $discountRatio)}} ₸</div>
                            @else
                                <div class="text-lg text-right">+ {{round($product->discount_price * $discountRatio)}} ₸</div>
                            @endif
                        </div>
                    </div>

                    @if($product->count > 0 && !$product->coming_soon)
                        <a id="addButtonToBasket" href="{{ route('addToBasket') }}" onclick="addToCart(event)"
                           data-csrf="{{ csrf_token() }}" data-id="{{ $product->id }}"
                           class="@if($product->getIfInTheBasket->isNotEmpty()) hidden @else block @endif text-lg sm:text-xs md:text-base w-full block text-center bg-orange-500 hover:bg-orange-600 p-2 mt-4 rounded outline-none">
                            В КОРЗИНУ
                        </a>
                        <a id="removeButtonFromCart" href="{{ route('addToBasket') }}" onclick="addToCart(event)"
                           data-csrf="{{ csrf_token() }}" data-id="{{ $product->id }}"
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
                    @if($product->getIfInTheWishlist->isNotEmpty())
                        <a href="#" onclick="wishlistProductPage(event)"
                           data-id="{{ $product->id }}"
                           class="text-lg sm:text-xs md:text-base w-full block text-center bg-indigo-500 hover:bg-indigo-600 p-2 mt-2 mr-auto ml-auto rounded outline-none addCartButton">
                            В ИЗБРАННОМ
                        </a>
                    @else

                        <a href="#" onclick="wishlistProductPage(event)"
                           data-id="{{ $product->id }}"
                           class="text-lg sm:text-xs md:text-base w-full block text-center bg-indigo-500 hover:bg-indigo-600 p-2 mt-2 mr-auto ml-auto rounded outline-none">
                            В ИЗБРАННОЕ
                        </a>
                    @endif
                </div>
            </div>
            <div class="productDescription w-full sm:w-5/12 px-3 block sm:hidden">
                <div class="mt-6 text-xl sm:text-md md:text-xl flex justify-between">
                    <p>Характеристики</p>
                    <a href="#productReviews" class=" text-blue-700 hover:text-blue-600 hover:underline"> Отзывы ({{ count($product->reviews) }})</a>
                </div>
                <div class="artNo flex mt-4">
                    <div class="w-1/2 sm:w-3/5 md:w-2/5 lg:w-1/3">
                        Артикул
                    </div>
                    <div class="pl-1 w-2/3">
                        {{ $product->art_no }}
                    </div>
                </div>

                @if($product->age)
                    <div class="manufacturer flex mt-2">
                        <div class="w-1/2 sm:w-3/5 md:w-2/5 lg:w-1/3">
                            Возраст
                        </div>
                        <div class="pl-1 w-2/3">
                            {{ $product->age->age }}
                        </div>
                    </div>
                @endif

                @if($product->manufacturer)
                    <div class="manufacturer flex mt-2">
                        <div class="w-1/2 sm:w-3/5 md:w-2/5 lg:w-1/3">
                            Производитель
                        </div>
                        <div class="pl-1 w-2/3">
                            {{ $product->manufacturer->country }}
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
                            {{ $product->material->name }}
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
                <strong>Описание</strong>
            </div>
            <div class="text-base md:text-xl">
                {!! $product->description !!}
            </div>
        </div>

        <div id="productReviews" class="reviews px-3 w-full sm:w-3/4">
            <div class="text-xl mt-6 flex justify-between">
                <span>Отзывы ({{ count($product->reviews) }})</span>
                <a onclick="showReviewForm(event)" class="ml-4 text-blue-700 hover:text-blue-600 hover:underline"
                   href="#">Оставить отзыв</a>
            </div>
            <form id="reviewForm" action="{{ route('createComment') }}" class="@if (count($errors) == 0)hidden @endif"
                  method="POST">
                @csrf
                <p class="mt-4">Имя</p>
                <input type="text" name="name"
                       class="w-full border @error('name') border-red-700 @enderror outline-none text-lg"
                       placeholder="Ваше имя">
                @error('name')
                <p class="text-red-700 text-center -mb-4">{{ $message }}</p>
                @enderror
                <input type="text" name="productId" value="{{ $product->id }}" class="hidden">

                <textarea class="w-full border @error('review') border-red-700 @enderror outline-none text-lg mt-4"
                          name="review" id="" rows="10"></textarea>
                @error('review')
                <p class="text-red-700 text-center -mb-4">{{ $message }}</p>
                @enderror
                <input type="submit" value="ОТПРАВИТЬ"
                       class="p-2 cursor-pointer rounded bg-blue-600 hover:bg-blue-500 text-white">
            </form>

            @foreach($product->reviews as $review)
                <div class="text-sm sm:text-xl mt-6">
                    <div class="mt-2">
                        <span class="font-bold">{{ $review->name }}</span>
                        <span
                            class="opacity-75 ml-4">{{  date('d-m-Y', strtotime(stristr($review->created_at, ' ', true)))  }}</span>
                    </div>
                    <div>
                        <p>
                            {{ $review->review }}
                        </p>
                    </div>
                </div>
                @isset($review->admin_review)

                    <div class="text-sm sm:text-xl bg-blue-200 rounded">
                        <div class="flex ">
                            <img class="w-10 sm:w-20 h-10 sm:h-20" src="{{ asset('images/ico/review/lapki.png') }}"
                                 alt="">
                            <div>
                                <div class="mt-2">
                                    <span class="font-bold italic">Mimishka.kz</span>
                                    <span
                                        class="opacity-75 ml-4">{{  date('d-m-Y', strtotime(stristr($review->updated_at, ' ', true)))  }}</span>
                                </div>
                                <div class="italic">
                                    <p>
                                        {{ $review->admin_review }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset

            @endforeach

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
