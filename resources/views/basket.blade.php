@extends('layouts.master')
@section('title', ': Корзина')
@section('content')

    <div class="container mt-16">
        <div class="cartIco w-1/2 mx-auto">
            <img src="{{ asset('images/cart/cart.png') }}" alt="">
        </div>
        <div class="cartInner block ">
            <div class="cartProductsContent mr-4">
                <div class=" my-4 text-base font-semibold hidden sm:flex">
                    <div class="flex w-1/2">
                        <div class="cartProductImg  w-1/5 text-center">
                        </div>
                        <div class="cartProductName w-4/5 p-1 self-center text-center">
                            Позиция
                        </div>
                    </div>
                    <div class="flex w-1/2">
                        <div class="cartPerProductPrice w-1/3 p-1 self-center text-center">
                            Цена
                        </div>
                        <div class="cartPerProductCount w-1/3 p-1 self-center text-center">
                            Кол-во
                        </div>
                        <div class="cartPerProductTotalPrice w-1/3 p-1 self-center text-center">
                            Сумма
                        </div>
                        <div class="cartPerProductDelete w-8 self-center "></div>
                    </div>
                </div>
                <hr>

                @foreach($basket as $basketProduct)
                    @include('layouts.mainCartItem', $basketProduct)
                @endforeach


{{--                <div class="flex my-4 text-base  justify-between">--}}
{{--                    <span>Итого</span>--}}
{{--                    <div class="priceValue">--}}
{{--                        <span id="mainCartTotalPrice" class="mr-8">{{ $totalPrice }} ₸</span>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="flex my-4 text-base   justify-between">--}}
{{--                    <span>Доставка</span>--}}
{{--                    <span id="deliveryPrice" class="mr-8">0</span>--}}
{{--                </div>--}}

{{--                @auth--}}
{{--                    <div class="flex my-4 text-base   justify-between">--}}
{{--                        <span>Потратить бонусы</span>--}}
{{--                        <input id="spentBonus" oninput="getTotalPrice(event)"--}}
{{--                               name="spentBonus" type="tel"--}}
{{--                               value="{{ old('spentBonus') }}"--}}
{{--                               class="@error('spentBonus') border border-2 border-red-700 @enderror w-20 rounded border text-right mr-8"--}}
{{--                               placeholder="0 ₸">--}}
{{--                    </div>--}}
{{--                    @error('spentBonus')--}}
{{--                    <p class="-mt-3 text-center text-red-700 text-sm">{{ $message }}</p>--}}
{{--                    @enderror--}}
{{--                @endauth--}}

                <div class="flex my-4 text-lg font-semibold justify-between">
                    <span> Итого </span>

                    <span id="mainCartTotalPrice" data-totalPrice="{{ $totalPrice }}" class="mr-8">{{ $totalPrice }}  ₸</span>
                </div>

            </div>
            <a class="w-full block text-center py-3 mt-4 rounded bg-blue-600 text-white hover:bg-blue-500 focus:outline-none my-1"
               href="{{ route('checkout') }}"
            >ОФОРМИТЬ ЗАКАЗ
            </a>
        </div>
    </div>
@endsection
