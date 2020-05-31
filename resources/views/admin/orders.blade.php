@extends('admin.layouts.master')

@section('title', ': Заказы')

@section('content')

    <div class="flex items-center justify-center">
        <div class="container mt-16 sm:mt-24">
            <div>
                <a href="" onclick="getOrdersFilterForm(event)" class="bg-blue-700 p-3 rounded hover:bg-blue-600">Фильтр</a>
            </div>
            <form id="ordersFilterForm" action="{{ route('admin.orders') }}" class="@if(stripos(request()->getRequestUri(), 'number')) block @else hidden @endif p-3">
                <table class="w-full m-auto text-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                    <thead class="text-white">
                    <tr class="bg-teal-700 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                        <th class="p-3 text-left w-full sm:w-1/4">
                            <input name="orderNumber" value="{{ old('orderNumber') ?? request()->orderNumber }}"
                                   class="w-full  appearance-none rounded bg-white border-white text-gray-700 mr-3 p-1 leading-tight focus:outline-none"
                                   type="text" placeholder="Номер" aria-label="Full name">
                        </th>

                        <th class="p-3 text-left w-full sm:w-1/5">
                            <input
                                id="fromDate"
                                type="tel"
                                class="w-full  appearance-none rounded bg-white border-white text-gray-700 mr-3 p-1 leading-tight focus:outline-none"
                                name="fromDate" value="{{ old('fromDate') ?? request()->fromDate }}"
                                placeholder="с"/>
                        </th>

                        <th class="p-3 text-left w-full sm:w-1/5">
                            <input
                                id="toDate"
                                type="tel"
                                class="w-full  appearance-none rounded bg-white border-white text-gray-700 mr-3 p-1 leading-tight focus:outline-none"
                                name="toDate" value="{{ old('toDate') ?? request()->toDate }}"
                                placeholder="по"/>
                        </th>

                        <th class="p-3 text-left w-full w-1/4 sm:w-1/5">
                            <select name="status"
                                    class="w-full  appearance-none rounded bg-white border-white text-gray-700 mr-3 p-1 leading-tight focus:outline-none">
                                <option disabled hidden selected>Статус</option>
                                @foreach($statuses as $status)

                                <option value="{{ $status->id }}"
                                @if($status->id == request()->status)
                                    selected
                                @endif
                                >{{ $status->name}}</option>
                                @endforeach
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
                    <a href="{{ route('admin.orders') }}" class="w-1/2 bg-red-500 text-white text-center rounded p-2 hover:bg-gray-300 hover:text-red-500">
                        Сбросить
                    </a>
                </div>
            </form>
            <table class="w-11/12 sm:w-full m-auto text-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                <thead class="text-white">
                <tr class="bg-teal-700 flex flex-col flex-no wrap hidden sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                    <th class="p-3 text-left">Номер</th>
                    <th class="p-3 text-left">Сумма</th>
                    <th class="p-3 text-left">Дата</th>
                    <th class="p-3 text-left">Статус</th>
                    <th class="p-3 text-left" width="110px">Действие</th>
                </tr>
                </thead>
                <tbody class="flex-1 sm:flex-none">

                @foreach($orders as $order)

                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/4 sm:hidden">Номер: </span>{{ $order->number }}</td>
                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/4 sm:hidden">Сумма: </span>{{ $order->total_sum }}<span
                                class="text-sm"> ₸</span></td>
                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/4 sm:hidden">Дата: </span>{{ $order->created_at }}</td>
                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/4 sm:hidden">Статус: </span>{{ $order->status->name }}</td>

                        <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="{{ route('admin.order', $order->id) }}">Подробнее</a>
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    {{ $orders->links() }}


    <style>
        html,
        body {
            height: 100%;
        }

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
