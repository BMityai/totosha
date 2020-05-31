@extends('admin.layouts.master')

@section('title', ': Заказы')

@section('content')

    <form action="{{ route('admin.editOrder', $order->id) }}" method="POST" class="container text-white mt-24 sm:mt-16 lg:mt-32 m-auto mb-32">
        @csrf
        <div class="flex justify-between mt-2 p-2">
            <h1 class="text-xl">Заказ №{{ $order->number }}</h1>

            <select id="orderStatus" type="text" name="orderStatus" class="bg-red-700 p-1 w-2/3 bg-transparent border border-white rounded">
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}"
                            @if($status->id == $order->order_status_id)
                            selected
                        @endif
                    >{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <div class="flex w-full">
                <div class="w-1/2 p-2">
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Имя</span>
                        <input type="text" name="customerName" value="{{ $order->name }}"
                               class="p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Телефон</span>
                        <input type="text" name="customerPhone" value="{{ $order->phone }}"
                               class="p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Email</span>
                        <input type="text" name="customerEmail" value="{{ $order->email }}"
                               class="p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Оплата</span>
                        <input type="text" disabled value="{{ $order->paymentForm->name }}"
                               class="text-gray-700 p-1 w-2/3 bg-transparent border border-gray-700 rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Оплачен</span>
                        <input type="text" disabled value="@if($order->is_paid == 0) Нет @else Да @endif"
                               class="text-gray-700 p-1 w-2/3 bg-transparent border border-gray-700 rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Бонусы +</span>
                        <input type="text" disabled value="{{ $order->received_bonus }}"
                               class="text-gray-700 p-1 w-2/3 bg-transparent border border-gray-700 rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Бонусы -</span>
                        <input type="text" disabled value="{{ $order->spent_bonus }}"
                               class="text-gray-700 p-1 w-2/3 bg-transparent border border-gray-700 rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">ID клиента</span>
                        <input type="text" disabled value="{{ $order->user_id }}"
                               class="text-gray-700 p-1 w-2/3 bg-transparent border border-gray-700 rounded">
                    </div>

                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Доставка</span>
                        <input type="text" disabled value="{{ $order->deliveryType->name }}"
                               class="text-gray-700 p-1 w-2/3 bg-transparent border border-gray-700 rounded">
                    </div>

                </div>
                <div class="w-1/2 p-2">

                    <div id="deliveryRegionAdmin" class="flex mt-2">
                        <span class="w-1/3 self-center">Область</span>
                        <select type="text" name="deliveryRegion" class="p-2 w-2/3 bg-transparent border border-white rounded">
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}"
                                        @if($region->id == $order->region_id)
                                        selected
                                    @endif
                                >{{ $region->region }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Район</span>
                        <input type="text" name="deliveryDistrict" value="{{ $order->district }}"
                               class="p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Город</span>
                        <input type="text" name="deliveryCity" value="{{ $order->city }}"
                               class="p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Улица</span>
                        <input type="text" name="deliveryStreet"  value="{{ $order->street }}"
                               class="p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Дом</span>
                        <input type="text" name="deliveryBuilding"  value="{{ $order->building }}"
                               class="p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Квартира</span>
                        <input type="text" name="deliveryApartment"  value="{{ $order->apartment }}"
                               class="p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Доставка</span>
                        <input type="text" disabled value="{{ $order->delivery_price }}"
                               class="text-gray-700 p-1 w-2/3 bg-transparent border border-gray-700 rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Сумма</span>
                        <input type="text" disabled value="{{ $order->total_sum }}"
                               class="text-gray-700 p-1 w-2/3 bg-transparent border border-gray-700 rounded">
                    </div>
                    <div class="flex mt-2 font-bold">
                        <span class="w-1/3 self-center">Итого</span>
                        <input type="text" disabled value="{{ $order->delivery_price + $order->total_sum }}"
                               class="text-gray-700 p-1 w-2/3 bg-transparent border border-gray-700 rounded">
                    </div>

                </div>
            </div>

            <div class="p-2">
                <p>Комментарий покупателя</p>
                <textarea disabled id="" class="w-full bg-transparent text-white h-32 border border-gray-700 rounded">{{ $order->comment }}</textarea>
            </div>

            <div class="p-2">
                <p>Комментарий менеджера</p>
                <textarea name="adminComment" class="w-full bg-transparent text-white h-32 border border-white rounded">{{ $order->admin_comment }}</textarea>
            </div>


            <h1 class="text-xl text-center mt-4">Товары в заказе</h1>

            <div class=" my-4 text-base font-semibold hidden sm:flex">
                <div class="flex w-1/2">
                    <div class="cartProductImg  w-1/5 text-center">
                        <a href="">
                            <img src="" alt="">
                        </a>
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
                </div>
            </div>
            @foreach($order->products as $product)
                @include('admin.layouts.orderProduct', $product)
            @endforeach
            <div class="flex justify-between">
                <a href="{{ url()->previous() }}" class="w-1/2 mr-1 py-2 text-center hover:bg-orange-700 bg-orange-500 rounded">
                    Назад
                </a>
                <button class="w-1/2 ml-1 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Сохранить
                </button>
            </div>


        </div>


    </form>

    <style>
        #deliveryRegionAdmin option {
            background-color: #191919;
        }

        #orderStatus option {
            background-color: #191919;
        }

    </style>

@endsection
