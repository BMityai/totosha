@extends('layouts.master')
@section('title', ': Бонусы')

@section('content')
    <div class="container mt-16">
        <div class="cartIco w-1/3 mx-auto">
            <img src="{{ asset('images/customer_cabinet/bonus_history.png') }}" alt="">
        </div>

        <div class="breadCrumbs mt-6">
            <a href="{{ route('home') }}">Главная</a>
            <span> / </span>
            Бонусный счет
        </div>

        <div class="text-sm sm:text-base flex justify-between mt-4 p-4">
            <div class="w-1/4 text-center font-semibold">Дата</div>
            <div class="w-1/4 text-center font-semibold">Списано</div>
            <div class="w-1/4 text-center font-semibold">Начислено</div>
            <div class="w-1/4 text-center font-semibold">Сумма операции</div>
        </div>
        <hr>
        @foreach($orders as $order)
            <div class="flex mt-4 mt-2">
                <div class=" w-1/4 text-center self-center">
                    {{ date('d-m-Y', strtotime(stristr($order->created_at, ' ', true))) }}
                </div>

                <div class="w-1/4 text-center self-center">
                    {{ $order->spent_bonus }}
                </div>

                <div class="w-1/4 text-center self-center">
                    {{ $order->received_bonus ?? 0 }}
                </div>

                <div class="w-1/4 text-center self-center">
                    {{ $order->total_sum }} ₸
                </div>
            </div>
        @endforeach

    </div>
    {{ $orders->links() }}



@endsection
