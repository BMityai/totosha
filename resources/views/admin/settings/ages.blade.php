@extends('admin.layouts.master')
@section('title', ': Возраст')

@section('content')

    <div class="flex items-center justify-center">
        <div class="container mt-16 lg:mt-24 p-2">
            <div>
                <a href="{{ route('admin.settings.getAddAgeForm') }}" class="bg-blue-700 p-3 rounded hover:bg-blue-600">+ добавить</a>
            </div>
            <table class="w-11/12 sm:w-full m-auto text-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                <thead class="text-white">
                <tr class="bg-teal-700 flex flex-col flex-no wrap hidden sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                    <th class="p-3 text-left">Параметр</th>
                    <th class="p-3 text-center">Действие</th>
                </tr>
                </thead>
                <tbody class="flex-1 sm:flex-none">

                @foreach($ages as $age)
                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Параметр: </span>{{ $age->age }}</td>
                         <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="{{ route('admin.settings.age', $age->id) }}">Редактировать</a>
                        </td>
                    </tr>
                @endforeach

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
