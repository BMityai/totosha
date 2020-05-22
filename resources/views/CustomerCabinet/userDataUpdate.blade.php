@extends('layouts.master')
@section('title', ': Обновить анкетные данные')

@section('content')

    <div class="container mt-16">
        <div class="bg-grey-lighter h-full flex flex-col">
            <div class="container max-w-xl mx-auto flex-1 flex flex-col items-center justify-center px-2">
                <div class="bg-white px-6 py-8 rounded text-black w-full">
                    <h1 class="mb-8 text-3xl text-center">Изменить данные</h1>
                    <form  action="{{ route('updateUserData') }}" method="POST">
                        @csrf
                        <span>Имя</span>
                        <input
                            type="text"
                            class="block border @error('name') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                            name="name" value="{{ old('name') ?? auth()->user()->name }}"
                            placeholder="Имя"/>

                        @error('name')
                        <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                        @enderror

                        <p class="mt-4">Дата рождения</p>
                        <input
                            class="block border border-gray-300 w-full p-1 text-xl rounded"
                            value="{{ auth()->user()->birth_date }}"
                            placeholder="Дата рождения"
                            disabled/>

                        <p class="mt-4">Телефон</p>
                        <input
                            id="phone"
                            type="tel"
                            class="block border @error('phone') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                            name="phone" value="{{ old('phone') ?? auth()->user()->phone }}"
                            placeholder="Номер телефона"/>

                        @error('phone')
                        <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                        @enderror

                        <p class="mt-4">email</p>
                        <input
                            type="email"
                            class="block border @error('email') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                            name="email" value="{{ old('email') ?? auth()->user()->email }}"
                            placeholder="Email"/>

                        @error('email')
                        <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                        @enderror


                        <button
                            type="submit"
                            class="w-full text-center py-3 mt-4 rounded bg-blue-600 text-white hover:bg-blue-500 focus:outline-none my-1"
                        >ИЗМЕНИТЬ
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
