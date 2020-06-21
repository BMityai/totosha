@extends('admin.layouts.master')

@section('title', ': Пользователи')

@section('content')

    <div class="flex items-center justify-center">
        <div class="container mt-16 lg:mt-24 p-2">
            <div>
                <a href="{{ route('admin.products') }}" onclick="getProductsFilterForm(event)"
                   class="bg-blue-700 p-3 rounded hover:bg-blue-600">Фильтр</a>
            </div>


            <form id="productsFilterForm" action="{{ route('admin.customers') }}"
                  class="@if(stripos(request()->getRequestUri(), 'name')) block @else hidden @endif">
                <table class="w-full m-auto text-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                    <thead class="text-white">
                    <tr class="bg-teal-700 flex flex-col flex-no wrap sm:table-row sm:mb-2 sm:mb-0">
                        <th class="p-3 text-left w-full sm:w-1/5">
                            <input name="name" value="{{ request()->name }}"
                                   class="w-full  appearance-none rounded bg-white border-white text-gray-700 mr-3 p-1 leading-tight focus:outline-none"
                                   type="text" placeholder="Имя" aria-label="Name">
                        </th>

                        <th class="p-3 text-left w-full sm:w-1/5">
                            <input name="phone" value="{{ request()->phone }}"
                                   id="phone"
                                   class="w-full  appearance-none rounded bg-white border-white text-gray-700 mr-3 p-1 leading-tight focus:outline-none"
                                   type="tel" placeholder="Телефон" aria-label="Phone">
                        </th>

                        <th class="p-3 text-left w-full sm:w-1/5">
                            <input name="email" value="{{ request()->email }}"
                                   class="w-full  appearance-none rounded bg-white border-white text-gray-700 mr-3 p-1 leading-tight focus:outline-none"
                                   type="email" placeholder="Email" aria-label="Email">
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
                                >Активен
                                </option>
                                <option value="0"
                                        @if(request()->isActive === '0')
                                        selected
                                    @endif
                                >Отключен
                                </option>

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
                    <a href="{{ route('admin.customers') }}"
                       class="w-1/2 bg-red-500 text-white text-center rounded p-2 hover:bg-gray-300 hover:text-red-500">
                        Сбросить
                    </a>
                </div>
            </form>



            <table class="w-11/12 sm:w-full m-auto text-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                <thead class="text-white">
                <tr class="bg-teal-700 flex flex-col flex-no wrap hidden sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                    <th class="p-3 text-left">Имя</th>
                    <th class="p-3 text-left">Телефон</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Бонусы</th>
                    <th class="p-3 text-left">Верифицирован</th>
                    <th class="p-3 text-left">Активность</th>
                    <th class="p-3 text-left" width="110px">Действие</th>
                </tr>
                </thead>
                <tbody class="flex-1 sm:flex-none">

                @foreach($customers as $customer)

                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Имя: </span>{{ $customer->name }}</td>
                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Телефон: </span>{{ $customer->phone }}</td>
                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Email: </span>{{ $customer->email }}</td>
                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Бонусы: </span>{{ $customer->bonus }}</td>
                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Вериф.: </span> @if(!is_null($customer->email_verified_at)) Да @else
                                Нет @endif </td>
                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Активн.: </span> @if($customer->is_active == 1) Активен @else
                                Отключен @endif </td>
                        <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="{{ route('admin.customer', $customer->id) }}">Открыть</a>
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    {{ $customers->links() }}


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
