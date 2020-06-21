@extends('admin.layouts.master')
@section('title', ': Изменить категорию')

@section('content')

        <form action="{{ route('admin.editCategory', $category->id ) }}" method="POST" enctype="multipart/form-data"
              class="container text-white mt-24 sm:mt-16 m-auto lg:mt-32 mb-32">
            @csrf

            <div class="flex justify-between mt-2 p-2 flex-wrap md:flex-no-wrap">
                <h1 class="text-xl">Редактировать категорию</h1>
            </div>
            <div>
                <div class="flex w-full flex-wrap md:flex-no-wrap">
                    <div class="w-full p-2">
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Название</span>
                            <div class="w-2/3">
                                <input type="text" name="name" value="{{ !empty(old('name')) ? old('name') : $category->name }}"
                                   class="p-1 w-full bg-transparent border @error('name') border-red-700 @else border-white text-white @enderror rounded">
                                @error('name')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Отображать</span>
                            <div class="w-2/3">
                                <select type="text" name="is_active"
                                        class="p-2 w-full bg-transparent border @error('is_active') border-red-700 @else border-white text-white @enderror rounded">
                                    <option value selected disabled> Выбрать </option>
                                    <option value="1"
                                            @if($category->is_active === 1)
                                            selected
                                            @endif
                                            @if(old('is_active') === '1')
                                            selected
                                        @endif
                                    >Да</option>
                                    <option value="0"
                                            @if($category->is_active === 0)
                                            selected
                                            @endif
                                            @if(old('is_active') === '0')
                                            selected
                                        @endif
                                    >Нет</option>
                                </select>
                                @error('is_active')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class=" mt-2">
                            <input id="kv-explorer" name="img" type="file">
                            @error('img')
                            <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap">
                        <div class="w-1/5 p-2 relative">
                            <img class="rounded-t cursor-pointer"
                                 src="{{ asset($category->image) }}" alt="">
                        </div>
                </div>

                <div class="p-2">
                    <p>Описание</p>
                    <div id="managerCommentBlock" class="border rounded @error('description') border-red-700 text-red-700 @else border-white text-white @enderror p-2"
                         onclick="editReview()">{!! !empty(old('description')) ? old('description') : $category->description !!} </div>
                    @error('description')
                    <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                    @enderror

                    <textarea id="mytextarea" name="description"
                              class="hidden editor w-full bg-transparent border border-white rounded">{{ !empty(old('description')) ? old('description') : $category->description }}</textarea>
                </div>


                <div class="flex justify-between flex-wrap sm:flex-no-wrap">

                    <a href="{{ route('admin.categories') }}"
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
