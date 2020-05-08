@extends('layouts.master')
@section('title', $category->name)
@section('content')
    <div class="container mt-16 ">
        <search-component></search-component>
        <form action="" class="mt-4">
            <div class="flex justify-around rounded-lg bg-blue-600 h-12 items-center">
                <div id="sideSort" class="sideSort w-1/4 sm:w-auto">
                    <select name="sort" class="h-8 rounded w-full sm:w-auto">
                        <option value="" selected disabled>Сортировать</option>
                        <option value="priceUp">Цена &#8593</option>
                        <option value="priceDown">Цена &#8595</option>
                        <option value="new">Новинки</option>
                    </select>
                </div>
                <div id="sideProduct" class="sideProduct w-1/4 sm:w-auto">
                    <div class="available w-full sm:w-auto">
                        <select name="" id="" class="h-8 rounded w-full sm:w-auto">
                            <option value="" disabled selected>Товар</option>
                            <option value="">В наличии</option>
                            <option value="">Скоро в продаже</option>
                        </select>
                    </div>
                </div>

                <input onclick="showPriceFilter()" type="button" id="showFilter" value="Фильтр по цене" class="showFilter w-1/4 sm:w-auto block sm:hidden w-24 h-8 rounded bg-orange-400 hover:bg-orange-500">


                <div id="sidePrice" class="sidePrice w-2/3 sm:w-5/12 items-center invisible absolute sm:visible sm:relative">
                     <div class="priceRange flex">
                         <div class="priceFrom w-1/2 text-white">c <input type="number" class="w-4/5 text-black text-center h-8 rounded outline-none" placeholder="цена"></div>
                         <div class="priceTo w-1/2 text-white"> по <input type="number" class="w-4/5 h-8 rounded text-black text-center outline-none" placeholder="цена"></div>
                     </div>
                </div>
                <input type="submit" value="Применить" id="filterSubmitButton" class="filterSubmitButton invisible absolute sm:visible sm:relative w-24 h-8 rounded bg-orange-400 hover:bg-orange-500">
            </div>
        </form>
        <div class="resetFilter text-right mt-4 flex justify-between">

            <div class="breadCrumbs">
                <a href="{{ route('home') }}">Главная</a>
                <span> / </span>
                <span href="{{ route('category', $category->slug) }}">{{ $category->name }}</span>
            </div>
            <a href="">Сбросить фильтр</a>

        </div>




        <div class="productsContent flex justify-between flex-wrap mt-4" >
            @foreach($category->products as $product)
                @include('layouts.card', $product)
            @endforeach


            <div class="filling-empty-space-childs"></div>
            <div class="filling-empty-space-childs"></div>
            <div class="filling-empty-space-childs"></div>
            <div class="filling-empty-space-childs"></div>
        </div>
    </div>
@endsection
