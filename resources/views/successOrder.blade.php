@extends('layouts.master')
@section('title', ': Благодарим за покупку')

@section('content')
    <div class="container mt-16">
        <div class="w-1/3 mx-auto">
            <img src="{{ asset('images/cart/success_order.png') }}" alt="">
        </div>
        <div class="successText text-center text-2xl">
            <h1>
                Благодарим за покупку, Ваш заказ принят!
            </h1>
            <p>Номер заказа: <span class="font-semibold">{{ $orderNumber }}</span></p>
            <p>Наш оператор свяжется с Вами в ближайщее время</p>
        </div>

    </div>
@endsection
