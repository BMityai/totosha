@extends('layouts.master')
@section('title', ': Главная страница')
@section('content')

    <div class="container h-12 mt-16">
        <search-component></search-component>
    </div>

    <div class="container mt-3">
        <div class="banner">
            <img class="rounded-lg" src="{{ asset('images/home/HB.png') }}" alt="">
        </div>
    </div>
    <div class="container mt-6">
        <div class="infoList flex justify-between flex-wrap sm:flex-no-wrap">
            <div class="delivery pr-1 sm:p-0 sm:mr-1 w-1/2 sm:w-auto">
                <a href="#">
                    <img class="rounded-lg" src="{{ asset('images/home/delivery.png') }}" alt="">
                </a>
            </div>
            <div class="comingSoon pl-1 sm:p-0 sm:ml-1  sm:mr-1 w-1/2 sm:w-auto">
                <a href="#">
                    <img class="rounded-lg" src="{{ asset('images/home/coming_soon.png') }}" alt="">
                </a>
            </div>
            <div class="saleProducts pr-1 sm:p-0 mt-2 sm:m-0 sm:ml-1 sm:mr-1 w-1/2 sm:w-auto">
                <a href="#">
                    <img class="rounded-lg" src="{{ asset('images/home/sale.png') }}" alt="">
                </a>
            </div>
            <div class="bonus pl-1 sm:p-0 mt-2 sm:m-0 sm:ml-1 w-1/2 sm:w-auto">
                <a href="#">
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

            <a class="" href="">
                <img class="largeImg" src="{{ asset('images/categories/toys_800x700.png') }}" alt="">
                <img class="mobileImg" src="{{ asset('images/categories/toys_800x250.png') }}" alt="">
            </a>

            <a class="" href="">
                <img class="largeImg" src="{{ asset('images/categories/safety_800x700.png') }}" alt="">
                <img class="mobileImg" src="{{ asset('images/categories/safety_800x250.png') }}" alt="">
            </a>

            <a class="" href="">
                <img class="largeImg" src="{{ asset('images/categories/tableware_800x700.png') }}" alt="">
                <img class="mobileImg" src="{{ asset('images/categories/tableware_800x250.png') }}" alt="">
            </a>

            <a class="" href="">
                <img class="largeImg" src="{{ asset('images/categories/storage_800x700.png') }}" alt="">
                <img class="mobileImg" src="{{ asset('images/categories/storage_800x250.png') }}" alt="">
            </a>

            <a class="" href="">
                <img class="largeImg" src="{{ asset('images/categories/hygiene_800x700.png') }}" alt="">
                <img class="mobileImg" src="{{ asset('images/categories/hygiene_800x250.png') }}" alt="">
            </a>

            <a class="" href="">
                <img class="largeImg" src="{{ asset('images/categories/underwear_800x700.png') }}" alt="">
                <img class="mobileImg" src="{{ asset('images/categories/underwear_800x250.png') }}" alt="">
            </a>
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
            <a href="">
            <img class="rounded-lg" src="{{ asset('images/home/request.png') }}" alt="">
            </a>
        </div>
    </div>


@endsection
