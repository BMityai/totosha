@extends('layouts.master')
@section('title', $category->name)
@section('content')
    <div class="container mt-16 ">
        <search-component></search-component>
        <form action="" class="mt-4">
            <div class="flex justify-around rounded-lg bg-blue-600 h-12 items-center">
                <div class="sideSort">
                    <select name="sort" id="" class="h-8 rounded">
                        <option value="" selected disabled>Сортировать</option>
                        <option value="priceUp">Цена &#8593</option>
                        <option value="priceDown">Цена &#8595</option>
                        <option value="new">Новинки</option>
                    </select>
                </div>
                <div class="sideProduct">
                    <div class="available">
                        <select name="" id="" class="h-8 rounded">
                            <option value="" disabled selected>Товар</option>
                            <option value="">В наличии</option>
                            <option value="">Скоро в продаже</option>
                        </select>
                    </div>
                </div>

                <div class="sidePrice flex">
                    <h2 class="self-center text-white">Цена:  &#8195</h2>
                     <div class="priceRange flex">
                         <div class="priceFrom w-1/2 text-white">c <input type="number" class="w-4/5 text-black text-center h-8 rounded bg-gray-400 outline-none"></div>
                         <div class="priceTo w-1/2 text-white"> по <input type="number" class="w-4/5 h-8 rounded text-black text-center bg-gray-400 outline-none"></div>
                     </div>
                </div>
                <input type="submit" value="Применить" class="w-24 h-8 rounded bg-orange-400 hover:bg-orange-500">
            </div>
        </form>



        <div class="productsContent flex justify-between flex-wrap" >

            @include('layouts.card')
            @include('layouts.card')
            @include('layouts.card')
            @include('layouts.card')

            <div class="filling-empty-space-childs"></div>
            <div class="filling-empty-space-childs"></div>
            <div class="filling-empty-space-childs"></div>
            <div class="filling-empty-space-childs"></div>
        </div>
    </div>
@endsection
