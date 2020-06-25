@extends('admin.layouts.master')
@section('title', ': Banner ' . $banner->position)

@section('content')

    <form action="{{ route('admin.settings.updateBanner', $banner->position) }}" method="POST" enctype="multipart/form-data"
          class="container text-white mt-24 sm:mt-16 m-auto lg:mt-32 mb-32">
        @csrf

        <div class="flex justify-between mt-2 p-2 flex-wrap md:flex-no-wrap">
            <h1 class="text-xl">Banner {{ $banner->position }}</h1>
        </div>
        <div>
            <div class="flex w-full flex-wrap md:flex-no-wrap">
                <div class="w-full p-2">
                    <div class="flex mt-2">
                        <span class="w-1/3 text-sm self-center">Title</span>
                        <div class="w-2/3">
                            <input type="text" name="title"
                                   value="{{ !empty(old('title')) ? old('title') : $banner->title }}"
                                   class="p-1 w-full bg-transparent border @error('title') border-red-700 @else border-white text-white @enderror rounded">
                            @error('title')
                            <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex mt-2">
                        <span class="w-1/3 text-sm">Main img</span>
                        <div class="w-2/3">
                            <input name="img" type="file" class="text-xs">
                            @error('img')
                            <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                            @enderror
                            <div class="flex flex-wrap">
                                <div class="w-1/2 relative">
                                    <img class="rounded-t cursor-pointer"
                                         src="{{ asset($banner->main_image) }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 text-sm">Content img</span>
                            <div class="w-2/3">
                            <input name="content_image" type="file" class="text-xs">
                            @error('content_img')
                            <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                            @enderror
                            <div class="flex flex-wrap">
                                <div class="w-1/2 relative">
                                    <img class="rounded-t cursor-pointer"
                                         src="{{ asset($banner->content_image) }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="p-2">
                <p>Content</p>
                <div id="managerCommentBlock"
                     class="border rounded @error('content') border-red-700 text-red-700 @else border-white text-white @enderror p-2"
                     onclick="editReview()">{!! !empty(old('content')) ? old('content') : $banner->content !!} </div>
                @error('content')
                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                @enderror

                <textarea id="mytextarea" name="content"
                          class="hidden editor w-full bg-transparent border border-white rounded">{{ !empty(old('description')) ? old('description') : $banner->content }}</textarea>
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
