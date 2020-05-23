@extends('layouts.master')
@section('title', ': Результаты поиска')

@section('content')
<div class="container mt-16 ">
    <div class="cartIco w-full mx-auto">
        @include('layouts.search')
    </div>

    <div class="breadCrumbs mt-16">
        <a href="{{ route('home') }}">Главная</a>
        <span> / </span>
        <span> Поиск </span>
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

        <div class="productsContent flex justify-between flex-wrap mt-4">

            <p id="emptyWishlist" class="@if(count($results) > 0) hidden @else block @endif text-center">
                Товаров соответствующих Вашему запросу не найдено...
            </p>

            @if($results)
            @foreach($results as $result)
                @include('layouts.card', ['product' => $result])
            @endforeach
            @endif


            <div class="filling-empty-space-childs"></div>
            <div class="filling-empty-space-childs"></div>
            <div class="filling-empty-space-childs"></div>
        </div>
    </div>
</div>
@endsection()
