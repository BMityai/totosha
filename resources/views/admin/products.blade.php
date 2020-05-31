@extends('admin.layouts.master')

@section('title', ': Продукция')

@section('content')

    <div class="flex items-center justify-center">
        <div class="container mt-16 lg:mt-24 p-2">
            <div>
            <a href="{{ route('admin.products') }}" onclick="getProductsFilterForm(event)" class="bg-blue-700 p-3 rounded hover:bg-blue-600">Фильтр</a>
            <a href="" class="bg-blue-700 p-3 rounded hover:bg-blue-600">+ добавить</a>
            </div>
            <form id="productsFilterForm" action="{{ route('admin.products') }}" class="@if(stripos(request()->getRequestUri(), 'name')) block @else hidden @endif">
                <table class="w-full m-auto text-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                    <thead class="text-white">
                    <tr class="bg-teal-700 flex flex-col flex-no wrap sm:table-row sm:mb-2 sm:mb-0">
                        <th class="p-3 text-left w-full sm:w-1/5">
                            <input name="name" value="{{ request()->name }}"
                                   class="w-full  appearance-none rounded bg-white border-white text-gray-700 mr-3 p-1 leading-tight focus:outline-none"
                                   type="text" placeholder="Название" aria-label="Name">
                        </th>
                        <th class="p-3 text-left w-full sm:w-1/5">
                            <select name="category"
                                   class="w-full  appearance-none rounded bg-white border-white text-gray-700 mr-3 p-1 leading-tight focus:outline-none"
                                    type="text" aria-label="Name">
                                <option disabled selected hidden class="text-gray-500">Категория</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                @if(request()->category == $category->id)
                                    selected
                                @endif
                                >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </th>

                        <th class="p-3 text-left w-full sm:w-1/5">
                            <input name="priceFrom" value="{{ request()->priceFrom }}"
                                   class="w-full  appearance-none rounded bg-white border-white text-gray-700 mr-3 p-1 leading-tight focus:outline-none"
                                   type="text" placeholder="по цене, с">
                        </th>
                        <th class="p-3 text-left w-full sm:w-1/5">
                            <input name="priceTo" value="{{ request()->priceTo }}"
                                   class="w-full  appearance-none rounded bg-white border-white text-gray-700 mr-3 p-1 leading-tight focus:outline-none"
                                   type="text" placeholder="по цене, по">
                        </th>

                        <th class=" p-3 text-left w-full sm:w-1/5">
                            <select name="isActive"
                                    class="w-full  appearance-none rounded bg-white border-white text-gray-700 mr-3 p-1 leading-tight focus:outline-none"
                                    type="text" aria-label="Name">
                                <option disabled selected value="" hidden>Активность</option>
                                <option value="1"
                                @if(request()->isActive == 1)
                                    selected
                                @endif
                                >Активен</option>
                                <option value="0"
                                    @if(request()->isActive === '0')
                                        selected
                                    @endif
                                >Отключен</option>

                            </select>
                        </th>

                    </tr>
                    </thead>
                </table>
                <div class="flex ">
                    <button
                        class="w-1/2 mr-2 bg-teal-700 hover:bg-gray-300 hover:text-teal-700 text-white font-semibold hover:text-white py-1 px-2 rounded">
                        Применить
                    </button>
                    <a href="{{ route('admin.products') }}" class="w-1/2 bg-red-500 text-white text-center rounded p-2 hover:bg-gray-300 hover:text-red-500">
                        Сбросить
                    </a>
                </div>
            </form>
            <table class="w-11/12 sm:w-full m-auto text-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                <thead class="text-white">
                <tr class="bg-teal-700 flex flex-col flex-no wrap hidden sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                    <th class="p-3 text-left">Название</th>
                    <th class="p-3 text-left">Категория</th>
                    <th class="p-3 text-left">Цена</th>
                    <th class="p-3 text-left">Скидка</th>

                    <th class="p-3 text-left">В наличии</th>
                    <th class="p-3 text-left">Активность</th>
                    <th class="p-3 text-left" width="110px">Действие</th>
                </tr>
                </thead>
                <tbody class="flex-1 sm:flex-none">

                @foreach($products as $product)

                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Название: </span>{{ $product->name }}</td>
                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Категория: </span>{{ $product->category->name }}</td>
                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Цена: </span>{{ $product->discount_price }}<span
                                class="text-sm"> ₸</span></td>
                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Скидка: </span>{{ $product->discount }}</td>
                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">В наличии: </span>{{ $product->count }}</td>
                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Активн.: </span> @if($product->is_active == 1) Активен @else Отключен @endif </td>
                        <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="">Открыть</a>
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    {{ $products->links() }}


    <style>
        @media (min-width: 640px) {
            table {
                display: inline-table !important;
            }

            thead tr:not(:first-child) {
                display: none;
            }
        }

        td:not(:last-child) {
            border-bottom: 0;
        }

        th:not(:last-child) {
            border-bottom: 2px solid rgba(0, 0, 0, .1);
        }
    </style>

@endsection
