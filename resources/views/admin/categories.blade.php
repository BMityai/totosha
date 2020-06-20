@extends('admin.layouts.master')
@section('title', ': Все категории')

@section('content')

    <div class="flex items-center justify-center">
        <div class="container mt-16 lg:mt-24 p-2">
            <div>
                <a href="{{ route('admin.getAddCategoryForm') }}" class="bg-blue-700 p-3 rounded hover:bg-blue-600">+ добавить</a>
            </div>
            <table class="w-11/12 sm:w-full m-auto text-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                <thead class="text-white">
                <tr class="bg-teal-700 flex flex-col flex-no wrap hidden sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                    <th class="p-3 text-left">Название</th>
                    <th class="p-3 text-left">Количество товара</th>
                    <th class="p-3 text-left">Активность</th>
                    <th class="p-3 text-left" width="110px">Действие</th>
                </tr>
                </thead>
                <tbody class="flex-1 sm:flex-none">

                @foreach($categories as $category)

                    <tr class="flex sm:hover:bg-teal-700 flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">

                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Название: </span>{{ $category->name }}</td>
                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Кол. товара: </span>{{ count($category->products) }}</td>
                        <td class="p-1 sm:p-3 flex sm:table-cell"><span
                                class="w-1/3 sm:hidden">Активн.: </span> @if($category->is_active == 1) Активен @else Отключен @endif </td>
                        <td class="p-1 sm:p-3 text-center rounded sm:rounded-none bg-blue-700 sm:bg-transparent hover:font-medium cursor-pointer">
                            <a href="{{ route('admin.editCategoryForm', $category->id) }}">Открыть</a>
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
{{--    {{ $categories->links() }}--}}


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
