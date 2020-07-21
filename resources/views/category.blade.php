@extends('layouts.master')
@section('title', ':' . $category->name)
@section('content')
    <div class="container mt-16 ">
        @include('layouts.search')
        <form id="filterForm" method="GET" action="{{ route('category', $category->slug) }}"
              class="mt-4 block md:hidden">
            <div class="flex justify-around rounded-lg bg-blue-600 h-12 items-center">
                <div id="sideSort" class="sideSort w-1/4 sm:w-auto">
                    <select onchange="filteredProducts()" name="sort"
                            class="@error('sort') border border-2 border-red-700 @enderror h-8 rounded w-full sm:w-auto">
                        <option value="" selected disabled>Сортировать</option>
                        <option value="priceUp"
                                @if(request()->sort == 'priceUp')
                                selected
                                @endif>
                            По цене &#8593
                        </option>
                        <option value="priceDown"
                                @if(request()->sort == 'priceDown')
                                selected
                                @endif>
                            По цене &#8595</option>
                        <option value="new"
                                @if(request()->sort == 'new')
                                selected
                                @endif
                        >По новизне</option>
                    </select>
                </div>
                <div id="sideProduct" class="sideProduct w-1/4 sm:w-auto">
                    <div class="available w-full sm:w-auto ">
                        <select onchange="filteredProducts()" name="stockFilter"
                                class="h-8 rounded w-full sm:w-auto @error('stockFilter') border border-2 border-red-700 @enderror">
                            <option value="" disabled selected>Товар</option>
                            <option value="inStock"
                                    @if(request()->stockFilter == 'inStock')
                                    selected
                                    @endif
                            >В наличии</option>
                            <option value="comingSoon"
                                    @if(request()->stockFilter == 'comingSoon')
                                    selected
                                    @endif
                            >Скоро в продаже</option>
                        </select>
                    </div>
                </div>

                <input onclick="showPriceFilter()" type="button" id="showFilter" value="Фильтр по цене"
                       class="showFilter w-1/4 sm:w-auto block sm:hidden w-24 h-8 rounded bg-orange-400 hover:bg-orange-500">


                <div id="sidePrice"
                     class="sidePrice w-2/3 sm:w-5/12 items-center invisible absolute sm:visible sm:relative">
                    <div class="priceRange flex">
                        <div class="priceFrom w-1/2 text-white">c <input type="number" name="priceFrom"
                                                                         class="w-4/5 text-black text-center h-8 rounded outline-none
                                                                         @error('priceFrom') border border-2 border-red-700 @enderror"
                                                                         value="{{ old('priceFrom') ?? request()->priceFrom }}"
                                                                         placeholder="цена"></div>
                        <div class="priceTo w-1/2 text-white"> по <input type="number" name="priceTo"
                                                                         class="w-4/5 h-8 rounded text-black text-center outline-none
                                                                         @error('priceTo') border border-2 border-red-700 @enderror"
                                                                         value="{{ old('priceTo') ?? request()->priceTo }}"
                                                                         placeholder="цена"></div>
                    </div>
                </div>
                <input type="submit" value="Применить" id="filterSubmitButton"
                       class="filterSubmitButton invisible absolute sm:visible sm:relative w-24 h-8 rounded bg-orange-400 hover:bg-orange-500">
            </div>
        </form>
        <div class="resetFilter text-right mt-4 flex justify-between">

            <div class="breadCrumbs">
                <a href="{{ route('home') }}">Главная</a>
                <span> / </span>
                <span href="{{ route('category', $category->slug) }}">{{ $category->name }}</span>
            </div>
            <a class="block md:hidden" href="">Сбросить фильтр</a>

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
                <h1 class="mt-4 font-bold">Сортировать</h1>
                <form id="sideFilterForm" method="GET" action="{{ route('category', $category->slug) }}"
                      class="w-full">
                    <div class="mt-1">
                        <select onchange="sideFilteredProducts()" name="sort"
                                class="@error('sort') border border-2 border-red-700 @enderror h-8 rounded w-10/12">
                            <option value="" selected disabled>Выбрать</option>
                            <option value="priceUp"
                                    @if(request()->sort == 'priceUp')
                                    selected
                                @endif
                            >
                                По цене &#8593
                            </option>
                            <option value="priceDown"
                                    @if(request()->sort == 'priceDown')
                                    selected
                                @endif
                            >
                                По цене &#8595
                            </option>
                            <option value="new"
                                    @if(request()->sort == 'new')
                                    selected
                                @endif
                            >
                                По новизне
                            </option>
                        </select>
                        @error('sort')
                        <p class="w-10/12 text-red-700 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <h1 class="mt-4 font-bold">Фильтровать</h1>
                    <div class="mt-1">
                        <select onchange="sideFilteredProducts()" name="stockFilter"
                                class="@error('stockFilter') border border-2 border-red-700 @enderror h-8 rounded w-10/12">
                            <option value="" disabled selected>Товар</option>
                            <option value="inStock"
                                    @if(request()->stockFilter == 'inStock')
                                    selected
                                @endif
                            >
                                В наличии
                            </option>
                            <option value="comingSoon"
                                    @if(request()->stockFilter == 'comingSoon')
                                    selected
                                @endif
                            >
                                Скоро в продаже
                            </option>
                        </select>
                        @error('stockFilter')
                        <p class="w-10/12 text-red-700 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <h1 class="mt-4 font-bold">По цене</h1>
                    <div class="w-10/12 text-white mt-1">
                        <input type="tel" name="priceFrom" value="{{ old('priceFrom') ?? request()->priceFrom }}"
                               class="@error('priceFrom') border border-2 border-red-700 @enderror text-black text-center h-8 rounded outline-none w-full"
                               placeholder="с">
                        @error('priceFrom')
                        <p class="w-10/12 text-red-700 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-10/12 text-white mt-1">
                        <input type="tel" name="priceTo" value="{{ old('priceTo') ?? request()->priceTo }}"
                               class="@error('priceTo') border border-2 border-red-700 @enderror h-8 rounded text-black text-center outline-none w-full"
                               placeholder="по">
                        @error('priceTo')
                        <p class="w-10/12 text-red-700 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="submit" value="Применить"
                           class="w-10/12 h-8 rounded bg-orange-400 hover:bg-orange-500 mt-4">
                    <p class="mt-2 text-center w-10/12 hover:bg-gray-300 rounded">
                        <a href="{{ route('category', $category->slug) }}">Сбросить фильтр</a>
                    </p>
                </form>

            </div>

            <div class="productsContent flex justify-between flex-wrap mt-4">

                @if($products)
                    @foreach($products as $product)
                        @include('layouts.card', $product)
                    @endforeach
                @endif
                @if(empty($product))
                    <p>Товаров, соответствующих вашему запросу, не обнаружено</p>
                @endif

                <div class="filling-empty-space-childs"></div>
                <div class="filling-empty-space-childs"></div>
                <div class="filling-empty-space-childs"></div>
            </div>
        </div>
        @if($products){{ $products->links('layouts.pagination') }}@endif
    </div>
@endsection
