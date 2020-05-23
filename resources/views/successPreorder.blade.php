@extends('layouts.master')
@section('title', ': Предзаказ')

@section('content')
    <div class="container mt-16">
        <div class="w-1/3 mx-auto">
            <img src="{{ asset('images/preorder/preorder.png') }}" alt="">
        </div>
        <div class="successText text-center mt-1 text-xl sm:text-2xl">
            <h1>
                Спасибо за обращение, Ваша заявка принята!
            </h1>
            <p class="mt-1">Благодаря Вам Мы становимся лучше!</p>
        </div>

    </div>
@endsection
