@extends('admin.layouts.master')
@section('title', ': Настройки')

@section('content')

    <div class="flex items-center justify-center">
        <div class="container mt-16 lg:mt-24 p-2">
            <table class="w-11/12 sm:w-full m-auto text-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                <thead class="text-white">
                <tr class="bg-teal-700 flex flex-col flex-no wrap hidden sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                    <th class="p-3 text-left">Параметр</th>
                    <th class="p-3 text-center">Действие</th>
                </tr>
                </thead>
                <tbody class="flex-1 sm:flex-none">
                <!--Banner top-->
                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Параметр: </span>Banner top</td>
                         <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="{{ route('admin.settings.banner', 'top') }}">Редактировать</a>
                        </td>
                    </tr>

                <!--Banner bottom-->
                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Параметр: </span>Banner bottom</td>
                         <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="{{ route('admin.settings.banner', 'bottom') }}">Редактировать</a>
                        </td>
                    </tr>

                <!--About us-->
                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Параметр: </span>О нас</td>
                         <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="{{ route('admin.settings.aboutUs') }}">Редактировать</a>
                        </td>
                    </tr>

                <!--Payment and delivery-->
                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Параметр: </span>Оплата и доставка</td>
                         <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="{{ route('admin.settings.deliveryAndPayment') }}">Редактировать</a>
                        </td>
                    </tr>

                <!--Purchase returns-->
                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Параметр: </span>Возврат товара</td>
                         <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="{{ route('admin.settings.purchaseReturns') }}">Редактировать</a>
                        </td>
                    </tr>

                <!--how to place an order-->
                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Параметр: </span>Как оформить заказ?</td>
                         <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="{{ route('admin.settings.banner', 'bottom') }}">Редактировать</a>
                        </td>
                    </tr>

                <!--Loyalty-->
                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Параметр: </span>Бонусная программа</td>
                         <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="{{ route('admin.settings.banner', 'bottom') }}">Редактировать</a>
                        </td>
                    </tr>

                <!--Contacts-->
                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Параметр: </span>Контакты</td>
                         <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="{{ route('admin.settings.banner', 'bottom') }}">Редактировать</a>
                        </td>
                    </tr>

                <!--Wholesale-->
                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Параметр: </span>Оптовые продажи</td>
                         <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="{{ route('admin.settings.banner', 'bottom') }}">Редактировать</a>
                        </td>
                    </tr>




                </tbody>
            </table>
        </div>
    </div>


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
