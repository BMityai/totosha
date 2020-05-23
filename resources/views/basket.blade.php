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


                <div class="flex my-4 text-base  justify-between">
                    <span>Итого</span>
                    <div class="priceValue">
                        <span id="mainCartTotalPrice" class="mr-8">{{ $totalPrice }} ₸</span>
                    </div>
                </div>

                <div class="flex my-4 text-base   justify-between">
                    <span>Доставка</span>
                    <span id="deliveryPrice" class="mr-8">0</span>
                </div>

                @auth
                    <div class="flex my-4 text-base   justify-between">
                        <span>Потратить бонусы</span>
                        <input id="spentBonus" onchange="totalPriceCalculate()"
                               name="spentBonus" type="tel"
                               value="{{ old('spentBonus') }}"
                               class="@error('spentBonus') border border-2 border-red-700 @enderror w-20 rounded border text-right mr-8"
                               placeholder="0 ₸">
                    </div>
                    @error('spentBonus')
                    <p class="-mt-3 text-center text-red-700 text-sm">{{ $message }}</p>
                    @enderror
                @endauth

                <div class="flex my-4 text-lg font-semibold justify-between">
                    <span> Итого к оплате</span>
                    <span id="mainCartAmountPrice" class="mr-8">{{ $totalPrice }}  ₸</span>
                </div>

                @auth
                    <div class="flex my-4 text-base   justify-between">
                        <span>Бонусы</span>
                        <span id="received_bonus" data-bonus="{{ $bonusСoefficient }}" class="mr-8">+ {{ round($totalPrice * $bonusСoefficient / 100) }}  ₸</span>
                    </div>
                @endauth

            </div>

            <div class="orderContent  rounded bg-blue-200 p-2 ">
                <h1 class="font-semibold text-lg text-center mt-4"> Оформление заказа </h1>
                <form action="{{ route('createOrder') }}" method="POST">
                    @csrf
                    <input id="spent_bonus_form" type="tel" class="hidden" name="spentBonus">
                    <div class="contactData block sm:flex justify-between">
                        <div class="customerName w-full sm:w-1/3">
                            <span>Имя</span>
                            <input
                                type="text"
                                class="block border @error('name') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                                name="name" value="{{ old('name') }}"
                                placeholder="Имя"/>

                            @error('name')
                            <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="customerPhone pt-2 sm:pt-0 sm:mx-1 w-full sm:w-1/3">
                            <span class="mt-4">Телефон</span>
                            <input
                                id="phone"
                                type="tel"
                                class="block border @error('phone') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                                name="phone" value="{{ old('phone') }}"
                                placeholder="Номер телефона"/>

                            @error('phone')
                            <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="customerEmail pt-2 sm:pt-0 w-full sm:w-1/3">
                            <span class="mt-4">email</span>
                            <input
                                type="email"
                                class="block border @error('customerEmail') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                                name="customerEmail" value="{{ old('customerEmail') }}"
                                placeholder="Email"/>

                            @error('customerEmail')
                            <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <p class="mt-4 text-center font-semibold">Адрес доставки</p>
                    <div class="deliveryLocation block sm:flex justify-between">
                        <div id="deliveryRegion"
                             class="deliveryRegion @if (old('region') > 3) sm:w-1/3 @else w-full @endif">
                            <span class="mt-4">Область</span>
                            <select onchange="checkLocation(event)" name="region"
                                    class="w-full border-gray-300 p-2 text-xl  rounded @error('region') border border-2 border-red-400 @enderror">
                                <option hidden selected value>Выберите область</option>

                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}"
                                            @if($region->is_active == false)
                                            disabled
                                            @endif
                                            @if(old('region') == $region->id)
                                            selected
                                        @endif
                                    >{{ $region->region }}</option>
                                @endforeach
                            </select>

                            @error('region')
                            <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                            @enderror
                        </div>

                        <div id="location" class="@if (old('region') > 3) sm:flex @else hidden @endif sm:w-2/3">
                            <div class="deliveryDistrict sm:w-1/2 sm:mx-1">
                                <span class="mt-4">Район</span>
                                <input id="customerDistrict"
                                       type="text"
                                       class="block border @error('district') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                                       name="district" value="{{ old('district') }}"
                                       placeholder="Район"/>

                                @error('district')
                                <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="deliveryCity sm:w-1/2">
                                <span class="mt-4">Город/село</span>
                                <input id="customerCity"
                                       type="text"
                                       class="block border @error('city') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                                       name="city" value="{{ old('city') }}"
                                       placeholder="Район"/>

                                @error('city')
                                <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <p class="mt-4 ">Улица (мкр)</p>
                    <input
                        type="text"
                        class="block border @error('street') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                        name="street" value="{{ old('street') }}"
                        placeholder="Улица"/>

                    @error('street')
                    <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                    @enderror

                    <div class="flex justify-between">
                        <div class="w-1/2 pr-1">
                            <p class="mt-4">Дом (здание)</p>
                            <input
                                type="text"
                                class="block border @error('building') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                                name="building" value="{{ old('building') }}"
                                placeholder="Номер дома"/>

                            @error('building')
                            <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-1/2 pl-1">
                            <p class="mt-4 ">Квартира (офис)</p>
                            <input
                                type="text"
                                class="block border @error('apartment') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                                name="apartment" value="{{ old('apartment') }}"
                                placeholder="Номер квартиры"/>

                            @error('apartment')
                            <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="paymentAndDeliveryInfo  sm:flex justify-between">
                        <div class="paymentContent w-full sm:pr-1 sm:w-1/2">
                            <p class="mt-4">Форма оплаты</p>
                            <select name="paymentType"
                                    class="@error('paymentType') border-red-400 @else border-gray-300 @enderror border w-full p-1 text-xl rounded">
                                <option value="" hidden selected value>Выберите способ</option>
                                @foreach($paymentTypes as $paymentType)
                                    <option value="{{ $paymentType->id }}"
                                            @if($paymentType->is_active == false)
                                            disabled
                                            @endif
                                            @if(old('paymentType') == $paymentType->id)
                                            selected
                                        @endif

                                    > {{ $paymentType->name }} </option>
                                @endforeach
                            </select>
                            @error('paymentType')
                            <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                            @enderror
                        </div>
                        <div id="deliveryTypeContent" class="deliveryTypeContent w-full sm:pl-1 sm:w-1/2">
                            <p class="mt-4">Тип доставки</p>
                            <select id="deliveryType" onchange="getDeliveryPrice()" name="deliveryType"
                                    class="@error('deliveryType') border-red-400 @else border-gray-300 @enderror border w-full p-1 text-xl rounded">
                                <option value="" class="hidden" disabled selected>Выберите тип</option>
                                @foreach($deliveryTypes as $deliveryType)
                                    <option value="{{ $deliveryType->id }}"
                                        @if($deliveryType->is_active == false || $deliveryType->id != old('deliveryType'))
                                        disabled
                                        @endif
                                        @if($deliveryType->id == old('deliveryType'))
                                            selected
                                            @endif
                                    > {{ $deliveryType->name }} </option>
                                @endforeach
                            </select>
                            @error('deliveryType')
                            <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                            @enderror

                            <p id="deliveryPriceInfo" class="hidden text-red-700 text-base text-center"></p>
                        </div>
                    </div>
                    <a id="getDeliveryPriceUrl" class="hidden" href="{{ route('getDeliveryPrice') }}"></a>
                    <p class="mt-4 ">Комментарий</p>
                    <textarea
                        class="h-32 block border @error('apartment') border-red-400 @else border-gray-300 @enderror w-full p-1 text-xl rounded"
                        name="comment" value="{{ old('comment') }}"
                        placeholder="Коментарий к заказу" style="resize:none"></textarea>
                    @error('comment')
                    <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                    @enderror

                    <button
                        type="submit"
                        class="w-full text-center py-3 mt-4 rounded bg-blue-600 text-white hover:bg-blue-500 focus:outline-none my-1"
                    >ПОДТВЕРДИТЬ ЗАКАЗ
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
