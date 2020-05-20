@extends('layouts.master')
@section('title', ': WishList')

@section('content')
    <div class="container mt-16 ">
        <div class="cartIco w-full mx-auto">
            <img src="{{ asset('images/wishlist/wishlist.png') }}" alt="">
        </div>

        <div class="breadCrumbs">
            <a href="{{ route('home') }}">Главная</a>
            <span> / </span>
            <span> WishList </span>
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

                <p id="emptyWishlist" class="@if(count($wishListProducts) > 0) hidden @else block @endif text-center">
                    Ваш Wishlist пуст...
                </p>

                @if($wishListProducts)
                    @foreach($wishListProducts as $wishlist)
                        @include('layouts.card', ['product' => $wishlist->product])
                    @endforeach
                @endif


                <div class="filling-empty-space-childs"></div>
                <div class="filling-empty-space-childs"></div>
                <div class="filling-empty-space-childs"></div>
            </div>
        </div>
    </div>
@endsection()
