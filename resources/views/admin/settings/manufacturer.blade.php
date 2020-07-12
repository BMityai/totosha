@extends('admin.layouts.master')
@section('title', ': ' . $manufacturer->country)

@section('content')


    <form action="{{ route('admin.settings.updateManufacturer', $manufacturer->id) }}" method="POST" enctype="multipart/form-data"
          class="container text-white mt-24 sm:mt-16 m-auto lg:mt-32 mb-32">
        @csrf

        <div class="flex justify-between mt-2 p-2 flex-wrap md:flex-no-wrap">
            <h1 class="text-xl">Страна роизводитель "{{ $manufacturer->country }}"</h1>
        </div>
        <div>
            <div class="p-2">

                <div class="flex mt-2">
                    <span class="w-1/3 text-sm self-center"> Страна </span>
                    <div class="w-2/3">
                        <input type="text" name="country"
                               value="{{ !empty(old('country')) ? old('country') : $manufacturer->country }}"
                               class="p-1 w-full bg-transparent border @error('country') border-red-700 @else border-white text-white @enderror rounded">
                        @error('price')
                        <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="flex justify-between flex-wrap sm:flex-no-wrap">

                <a href="{{ route('admin.settings.manufacturers') }}"
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
