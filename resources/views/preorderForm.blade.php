@extends('layouts.master')
@section('title', ': Заявка на товар')

@section('content')

    <div class="container mt-16">
        <div class="bg-grey-lighter h-full flex flex-col">
            <div class="container max-w-xl mx-auto flex-1 flex flex-col items-center justify-center px-2">
                <div class="bg-white px-6 py-8 rounded text-black w-full">
                    <h1 class="mb-8 text-3xl text-center">Предзаказ</h1>
                    <form action="{{ route('createPreorder') }}" method="POST">
                        @csrf
                        <span>Имя</span>
                        <input
                            type="text"
                            class="block border @error('name') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                            name="name"
                            @auth
                            value="{{ old('name') ?? auth()->user()->name }}"
                            @else
                            value="{{ old('name') }}"
                            @endauth
                            placeholder="Имя"/>


                        @error('name')
                        <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                        @enderror

                        <p class="mt-4">Телефон</p>
                        <input
                            id="phone"
                            type="tel"
                            class="block border @error('phone') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                            name="phone" value="
                        @auth
                        {{ old('phone') ?? auth()->user()->phone }}
                        @else
                        {{ old('phone') }}
                        @endauth"
                            placeholder="Номер телефона"/>

                        @error('phone')
                        <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                        @enderror

                        <p class="mt-4">email</p>
                        <input
                            type="email"
                            class="block border @error('customerEmail') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                            name="customerEmail" value="
                            @auth
                        {{ old('customerEmail') ?? auth()->user()->email }}
                        @else
                        {{ old('customerEmail') }}
                        @endauth
                            "
                            placeholder="Email"/>

                        @error('customerEmail')
                        <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                        @enderror

                        <p class="mt-4">Наименование продукта</p>
                        <input
                            type="text"
                            class="block border @error('name') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                            name="productName" value="{{ old('productName') }}"
                            placeholder="Название товара"/>

                        @error('productName')
                        <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                        @enderror

                        <p class="mt-4">Ссылка на товар</p>
                        <input
                            type="text"
                            class="block border @error('productLink') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                            name="productLink" value="{{ old('productLink') }}"
                            placeholder="Ссылки на стронние источники"/>

                        @error('productLink')
                        <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                        @enderror

                        <p class="mt-4">Краткое описание</p>
                        <textarea
                            rows="10"
                            class="block border @error('name') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                            name="productDescription" value="{{ old('productName') }}"
                            placeholder="Описание товара"
                        ></textarea>

                        @error('productDescription')
                        <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                        @enderror

                        <button
                            type="submit"
                            class="w-full text-center py-3 mt-4 rounded bg-blue-600 text-white hover:bg-blue-500 focus:outline-none my-1"
                        >ОСТАВИТЬ ЗАЯВКУ
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
