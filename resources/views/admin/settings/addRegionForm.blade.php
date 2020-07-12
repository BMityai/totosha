@extends('admin.layouts.master')
@section('title', ': ' . 'Добавить регион')

@section('content')


    <form action="{{ route('admin.settings.addRegion') }}" method="POST" enctype="multipart/form-data"
          class="container text-white mt-24 sm:mt-16 m-auto lg:mt-32 mb-32">
        @csrf

        <div class="flex justify-between mt-2 p-2 flex-wrap md:flex-no-wrap">
            <h1 class="text-xl">Добавить регион</h1>
        </div>
        <div>
            <div class="p-2">

                <div class="flex mt-2">
                    <span class="w-1/3 text-sm self-center"> Регион </span>
                    <div class="w-2/3">
                        <input type="text" name="name"
                               value="{{ old('name') }}"
                               class="p-1 w-full bg-transparent border @error('name') border-red-700 @else border-white text-white @enderror rounded">
                        @error('price')
                        <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex mt-2">
                    <span class="w-1/3 text-sm self-center">Is active</span>
                    <div class="w-2/3">
                        <select type="text" name="is_active"
                                class="p-2 w-full bg-transparent border @error('is_active') border-red-700 @else border-white text-white @enderror rounded">
                            <option value selected disabled> Выбрать</option>
                            <option value="1"
                                    @if(old('is_active') === '1')
                                    selected
                                @endif
                            >Да
                            </option>
                            <option value="0"
                                    @if(old('is_active') === '0')
                                    selected
                                @endif
                            >Нет
                            </option>
                        </select>
                        @error('is_active')
                        <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="flex justify-between flex-wrap sm:flex-no-wrap">

                <a href="{{ route('admin.settings.regions') }}"
                   class="w-full sm:w-1/2 m-1 sm:m-0 sm:mr-1 py-2 text-center hover:bg-orange-700 bg-orange-500 rounded">
                    Назад
                </a>

                <button
                    class="w-full sm:w-1/2 m-1 sm:m-0 bg-green-500 hover:bg-green-700 text-white font-bold px-4 py-2 rounded">
                    Сохранить
                </button>
            </div>
        </div>
    </form>

    <style>
        option {
            background-color: #191919;
        }
    </style>
@endsection
