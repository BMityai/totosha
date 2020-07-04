@extends('layouts.master')
@section('title', 'регистрация')
@section('content')

    <div class="container mt-16">
        <div class="bg-grey-lighter h-full flex flex-col">
            <div class="container max-w-xl mx-auto flex-1 flex flex-col items-center justify-center px-2">
                <div class="bg-white px-6 py-8 rounded text-black w-full">
                    <h1 class="mb-8 text-3xl text-center">Регистрация</h1>
                    <form  action="{{ route('register') }}" method="POST">
                        @csrf
                        <span>Имя</span>
                        <input
                            type="text"
                            class="block border @error('name') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                            name="name" value="{{ old('name') }}"
                            placeholder="Имя"/>

                        @error('name')
                        <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                        @enderror

                        <p class="mt-4">Дата рождения</p>
                        <input
                            id="birthDate"
                            type="tel"
                            class="block border @error('birthDate') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                            name="birthDate" value="{{ old('birthDate') }}"
                            placeholder="Дата рождения"/>

                        @error('birthDate')
                        <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                        @enderror

                        <p class="mt-4">Телефон</p>
                        <input
                            id="phone"
                            type="tel"
                            class="block border @error('phone') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                            name="phone" value="{{ old('phone') }}"
                            placeholder="Номер телефона"/>

                        @error('phone')
                        <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                        @enderror

                        <p class="mt-4">email</p>
                        <input
                            type="email"
                            class="block border @error('mail') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                            name="email" value="{{ old('mail') }}"
                            placeholder="Email"/>

                        @error('mail')
                        <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                        @enderror

                        <p class="pt-4">Пароль</p>
                        <input
                            type="password"
                            class="block border @error('password') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                            name="password"
                            placeholder="*********"/>

                        @error('password')
                        <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                        @enderror

                        <p class="mt-4">Повторите пароль</p>
                        <input
                            type="password"
                            class="block border @error('password') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded mb-4"
                            name="password_confirmation"
                            placeholder="*********"/>

                        <button
                            type="submit"
                            class="w-full text-center py-3 rounded bg-blue-600 text-white hover:bg-blue-500 focus:outline-none my-1"
                        >СОЗДАТЬ АККАУНТ
                        </button>
                    </form>

                    <div class="text-center text-sm text-grey-dark mt-4">
                        Регистрируясь, вы соглашаетесь с
                        <a class="no-underline border-b border-grey-dark text-grey-dark" href="#">
                            Условиями обслуживания
                        </a> и
                        <a class="no-underline border-b border-grey-dark text-grey-dark" href="#">
                            Политикой конфиденциальности.
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
