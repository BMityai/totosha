@extends('layouts.master')
@section('title', ': Главная страница')
@section('content')

    <div class="container h-12 mt-16">
        @include('layouts.search')
    </div>

    <div class="container mt-3">
        <div class="banner">
            <img class="rounded-lg" src="{{ asset('images/home/HB.png') }}" alt="">
        </div>
    </div>
    <div class="container mt-6">
        <div class="infoList flex justify-between flex-wrap sm:flex-no-wrap">
            <div class="delivery pr-1 sm:p-0 sm:mr-1 w-1/2 sm:w-auto">
                <a href="{{ route('getStoreInfo', 'payment_and_delivery') }}">
                    <img class="rounded-lg" src="{{ asset('images/home/delivery.png') }}" alt="">
                </a>
            </div>
            <div class="comingSoon pl-1 sm:p-0 sm:ml-1  sm:mr-1 w-1/2 sm:w-auto">
                <a href="{{ route('getComingSoonProducts') }}">
                    <img class="rounded-lg" src="{{ asset('images/home/coming_soon.png') }}" alt="">
                </a>
            </div>
            <div class="saleProducts pr-1 sm:p-0 mt-2 sm:m-0 sm:ml-1 sm:mr-1 w-1/2 sm:w-auto">
                <a href="{{ route('getSalesProducts') }}">
                    <img class="rounded-lg" src="{{ asset('images/home/sale.png') }}" alt="">
                </a>
            </div>
            <div class="bonus pl-1 sm:p-0 mt-2 sm:m-0 sm:ml-1 w-1/2 sm:w-auto">
                <a href="{{ route('getStoreInfo', 'loyalty_program') }}">
                    <img class="rounded-lg" src="{{ asset('images/home/register.png') }}" alt="">
                </a>
            </div>
        </div>
    </div>

    <div class="container mt-6">
        <h2 class="text-xl">Новое поступление</h2>
        <div class="slickCarousel ml-1 mr-1 text-center">

            @foreach($newProducts as $product)
            @include('layouts.card', $product)
            @endforeach

        </div>
    </div>

    <div class="container mt-6">
        <h2 class="text-xl">Категории</h2>
        <div class="categories flex flex-wrap justify-between">
            @foreach($categories as $category)
            <a class="" href="{{ route('category', $category->slug) }}">
                <img class="largeImg" src="{{ asset($category->image) }}" alt="">
                <img class="mobileImg" src="{{ asset($category->mobile_image) }}" alt="">
            </a>
            @endforeach
        </div>
    </div>

    <div class="container mt-6">
        <h2 class="text-xl">Рекомендуемые товары</h2>
        <div class="slickCarousel ml-1 mr-1 text-center">

            @foreach($recommendedProducts as $product)
                @include('layouts.card', $product)
            @endforeach

        </div>
    </div>

    <div class="container mt-10">
        <div class="banner">
            <a href="{{ route('getRequestForm') }}">
            <img class="rounded-lg" src="{{ asset('images/home/request.png') }}" alt="">
            </a>
        </div>
    </div>


@endsection
