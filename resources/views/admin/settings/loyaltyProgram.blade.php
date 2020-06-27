@extends('admin.layouts.master')
@section('title', ': Бонусная прграмма')

@section('content')

    <form action="{{ route('admin.settings.updateLoyaltyProgram') }}" method="POST" enctype="multipart/form-data"
          class="container text-white mt-24 sm:mt-16 m-auto lg:mt-32 mb-32">
        @csrf

        <div class="flex justify-between mt-2 p-2 flex-wrap md:flex-no-wrap">
            <h1 class="text-xl">Настройка контента "Бонусная программа"</h1>
        </div>
        <div>
            <div class="p-2">
                <p>Content</p>
                <div id="managerCommentBlock"
                     class="aboutUsContent border rounded @error('content') border-red-700 text-red-700 @else border-white text-white @enderror p-2"
                     onclick="editReview()">{!! !empty(old('content')) ? old('content') : $loyaltyProgramBlock->content !!} </div>
                @error('content')
                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                @enderror

                <textarea id="mytextarea" name="content"
                          class="hidden editor w-full bg-transparent border border-white rounded">{{ !empty(old('description')) ? old('description') : $loyaltyProgramBlock->content }}</textarea>
            </div>


            <div class="flex justify-between flex-wrap sm:flex-no-wrap">

                <a href="{{ route('admin.settings.content') }}"
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
