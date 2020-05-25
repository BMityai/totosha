@extends('layouts.master')
@section('title', ': скоро в продаже')
@section('content')
    <div class="container mt-16 ">
        <div class="w-1/3 mx-auto">
            <img src="{{ asset('images/review/review.png') }}" alt="">
        </div>
        <div class="breadCrumbs mt-6">
            <a href="{{ route('home') }}">Главная</a>
            <span> / </span>
            Отзывы
        </div>
        <div id="productReviews" class="reviews px-3 w-full">
            <div class="text-xl mt-6 flex justify-between">
                <span>Отзывы ({{ count($reviews) }})</span>
                <a onclick="showReviewForm(event)" class="ml-4 text-blue-700 hover:text-blue-600 hover:underline"
                   href="#">Оставить отзыв</a>
            </div>
            <form id="reviewForm" action="{{ route('createComment') }}" class="@if (count($errors) == 0)hidden @endif"
                  method="POST">
                @csrf
                <p class="mt-4">Имя</p>
                <input type="text" name="name"
                       class="w-full border @error('name') border-red-700 @enderror outline-none text-lg"
                       placeholder="Ваше имя">
                @error('name')
                <p class="text-red-700 text-center -mb-4">{{ $message }}</p>
                @enderror

                <textarea class="w-full border @error('review') border-red-700 @enderror outline-none text-lg mt-4"
                          name="review" id="" rows="10"></textarea>
                @error('review')
                <p class="text-red-700 text-center -mb-4">{{ $message }}</p>
                @enderror
                <input type="submit" value="ОТПРАВИТЬ"
                       class="p-2 cursor-pointer rounded bg-blue-600 hover:bg-blue-500 text-white">
            </form>

            @foreach($reviews as $review)
                <div class="text-sm sm:text-xl mt-6">
                    <div class="mt-2">
                        <span class="font-bold">{{ $review->name }}</span>
                        <span
                            class="opacity-75 ml-4">{{  date('d-m-Y', strtotime(stristr($review->created_at, ' ', true)))  }}</span>
                    </div>
                    <div>
                        <p>
                            {{ $review->review }}
                        </p>
                    </div>
                </div>
                @isset($review->admin_review)

                    <div class="text-sm sm:text-xl bg-blue-200 rounded">
                        <div class="flex ">
                            <img class="w-10 sm:w-20 h-10 sm:h-20" src="{{ asset('images/ico/review/lapki.png') }}"
                                 alt="">
                            <div>
                                <div class="mt-2">
                                    <span class="font-bold italic">Mimishka.kz</span>
                                    <span
                                        class="opacity-75 ml-4">{{  date('d-m-Y', strtotime(stristr($review->updated_at, ' ', true)))  }}</span>
                                </div>
                                <div class="italic">
                                    <p>
                                        {{ $review->admin_review }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset

            @endforeach

        </div>
    </div>
@endsection
