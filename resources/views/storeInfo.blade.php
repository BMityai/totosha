@extends('layouts.master')
@section('title', ': ' . $storeInfo->title)

@section('content')
    <div class="container mt-16 ">
        <div class="cartIco w-2/3 mx-auto">
            <img src="{{ asset('images/logos/info_logo.png') }}" alt="">
        </div>

        <div class="breadCrumbs">
            <a href="{{ route('home') }}">Главная</a>
            <span> / </span>
            <span> {{ $storeInfo->title }} </span>
        </div>

        <div class="categoryInner flex">
            <div class="sideFilterContent mt-6 text-lg">
                <div class="sideCategories">
                    <h1 class="font-bold w-10/12">Категории</h1>
                    @foreach($categories as $cat)
                        <p class="mt-1 hover:bg-gray-300 w-10/12 rounded"><a
                                href="{{ asset(route('category', $cat->slug)) }}">{{ $cat->name }}</a></p>
                    @endforeach
                </div>
            </div>

            <div class="productsContent flex-wrap mt-4 text-xl">

                {!! $storeInfo->content !!}
            </div>
        </div>
    </div>
@endsection()
