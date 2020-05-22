@extends('layouts.master')
@section('title', ': Сменить пароль')

@section('content')


<div class="container mt-16">
    <div class="bg-grey-lighter h-full flex flex-col">
        <div class="container max-w-xl mx-auto flex-1 flex flex-col items-center justify-center px-2">
            <div class="bg-white px-6 py-8 rounded text-black w-full">
                <h1 class="mb-8 text-3xl text-center">Изменить пароль</h1>
                <form action="{{ route('changePasswordForm') }}" method="POST">
                    @csrf

                    <p class="pt-4">Старый пароль</p>
                    <input
                        type="password"
                        class="block border @error('oldPassword') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                        name="oldPassword"
                        placeholder="*********"/>

                    @error('oldPassword')
                    <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                    @enderror


                    <p class="pt-4">Новый пароль</p>
                    <input
                        type="password"
                        class="block border @error('newPassword') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                        name="newPassword"
                        placeholder="*********"/>

                    @error('newPassword')
                    <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                    @enderror

                    <p class="mt-4">Повторите пароль</p>
                    <input
                        type="password"
                        class="block border @error('newPassword') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded mb-4"
                        name="newPassword_confirmation"
                        placeholder="*********"/>


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
