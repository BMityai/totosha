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

                <!--Content-->
                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Параметр: </span>Контент</td>
                         <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="{{ route('admin.settings.content') }}">Открыть</a>
                        </td>
                    </tr>

                <!--Banners-->
                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Параметр: </span>Баннеры</td>
                         <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="">Открыть</a>
                        </td>
                    </tr>

                <!--Delivery-->
                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Параметр: </span>Доставка</td>
                         <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="">Редактировать</a>
                        </td>
                    </tr>

                <!--Manufacturers-->
                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Параметр: </span>Производители</td>
                         <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="">Редактировать</a>
                        </td>
                    </tr>

                <!--Materials-->
                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Параметр: </span>Материал</td>
                         <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="">Редактировать</a>
                        </td>
                    </tr>
                <!--Regions-->
                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Параметр: </span>Регионы</td>
                         <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="">Редактировать</a>
                        </td>
                    </tr>

                <!--Ages-->
                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Параметр: </span>Возраст</td>
                         <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="">Редактировать</a>
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
