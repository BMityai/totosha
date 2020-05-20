@extends('layouts.master')

@section('title', ': История заказов')

@section('content')
    <div class="container mt-16">
        <div class="cartIco w-1/3 mx-auto">
            <img src="{{ asset('images/customer_cabinet/orders_history.png') }}" alt="">
        </div>
        <div class="breadCrumbs mt-6">
            <a href="{{ route('home') }}">Главная</a>
            <span> / </span>
            История заказов
        </div>

        <div class="text-sm sm:text-base flex justify-between mt-4 p-4">

            <div class="w-1/4 text-center font-semibold">Номер заказа</div>
            <div class="w-1/4 text-center font-semibold">Дата</div>
            <div class="w-1/4 text-center font-semibold">Сумма</div>
            <div class="w-1/4 text-center font-semibold">Статус</div>


        </div>

        <div class="accordion mt-4">
            @foreach($orders as $order)
                <div class="tab">
                    <input type="checkbox" id="tab{{$order->id}}" name="tab-group">
                    <label for="tab{{$order->id}}" class="tab-title text-sm sm:text-base hover:bg-gray-300">
                        <div class="flex justify-between">
                            <div class="orderNum w-1/4 text-center">
                                # {{ $order->number }}
                            </div>
                            <div class="orderDate w-1/4 text-center">
                                {{ date('d-m-Y', strtotime(stristr($order->created_at, ' ', true))) }}
                            </div>
                            <div class="orderSum w-1/4 text-center">
                                {{ $order->total_sum }} ₸
                            </div>
                            <div class="orderSum w-1/4 text-center">
                                {{ $order->status->name }}
                            </div>
                        </div>
                    </label>
                    <section class="tab-content bg-blue-100 text-sm sm:text-base">
                        <div class="flex justify-between">
                            <div class="w-1/2 mr-6">
                                <p class="font-semibold text-center">Адрес доставки</p>
                                <div class="flex justify-between mt-2">
                                    <div>Область</div>
                                    <div class="italic">{{ $order->region->region }}</div>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <div>Район</div>
                                    <div class="italic">@if(strlen($order->district) > 0) {{$order->district}} @else - @endif</div>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <div>Город</div>
                                    <div class="italic">@if(strlen($order->city) > 0) {{$order->city}} @else - @endif </div>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <div>Улица</div>
                                    <div class="italic">{{ $order->street }}</div>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <div>Дом</div>
                                    <div class="italic">{{ $order->building }}</div>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <div>Квартира</div>
                                    <div class="italic">{{ $order->apartment }}</div>
                                </div>
                            </div>

                            <div class="w-1/2 ml-6">
                                <p class="font-semibold text-center">Дополнительная информация</p>
                                <div class="flex justify-between mt-2">
                                    <div>Тип доставки</div>
                                    <div class="italic">{{ $order->deliveryType->name }}</div>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <div>Форма оплаты</div>
                                    <div class="italic">{{ $order->paymentForm->name }}</div>
                                </div>

                                <p class="font-semibold text-center mt-4">Бонусы</p>
                                <div class="flex justify-between mt-2">
                                    <div>Потрачено</div>
                                    <div class="italic">{{ $order->spent_bonus }}</div>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <div>Начислено</div>
                                    <div class="italic">{{ $order->received_bonus }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2">
                            <p class="font-semibold text-center mt-4">Товары в заказе</p>
                            <div class="flex mt-2 font-semibold italic">
                                <div class="w-1/4 text-center">
                                    Позиция
                                </div>

                                <div  class="w-1/5 text-center">
                                   Цена
                                </div>

                                <div class="w-1/6 text-center">
                                    Скидка
                                </div>

                                <div class="w-1/6 text-center">
                                    Количество
                                </div>

                                <div class="w-1/5 text-center">
                                   Сумма
                                </div>
                            </div>
                            @foreach($order->products as $product)
                            @include('layouts.orderHistoryProduct', $product)
                            @endforeach

                        </div>

                    </section>
                </div>
            @endforeach
        </div>
    </div>
@endsection
