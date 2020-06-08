@extends('admin.layouts.master')
@section('title', ': Добавить товар')

@section('content')
    <form action="" method="POST"
          class="container text-white mt-24 sm:mt-16 lg:mt-32 m-auto mb-32">
        @csrf
        <div class="flex justify-between mt-2 p-2 flex-wrap md:flex-no-wrap">
            <h1 class="text-xl">Добавить товар</h1>
        </div>
        <div>
            <div class="flex w-full flex-wrap md:flex-no-wrap">
                <div class="w-full md:w-1/2 p-2">
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Наименование</span>
                        <input type="text" name="name"
                               class="p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Категория</span>
                        <select type="text" name="category"
                                class="text-white p-2 w-2/3 bg-transparent border border-white rounded">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Производитель</span>
                        <select type="text" name="manufacturer"
                               class="text-white p-2 w-2/3 bg-transparent border border-white rounded">
                            @foreach($manufacturers as $manufacturer)
                                <option value="{{ $manufacturer->id }}">{{ $manufacturer->country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Возраст</span>
                        <select type="text" name="age"
                               class="text-white p-2 w-2/3 bg-transparent border border-white rounded">
                            @foreach($ages as $age)
                                <option value="{{ $age->id }}">{{ $age->age }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Высота</span>
                        <input type="text" name="height"
                               class="text-white p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Ширина</span>
                        <input type="text" name="width"
                               class="text-white p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Глубина</span>
                        <input type="text" name="depth"
                               class="text-white p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>

                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Вес</span>
                        <input type="text" name="weight"
                               class="text-white p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>

                </div>
                <div class="w-full md:w-1/2 p-2">

                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Материал</span>
                        <select type="text" name="material"
                                class="text-white p-2 w-2/3 bg-transparent border border-white rounded">
                            @foreach($materials as $material)
                                <option value="{{ $material->id }}">{{ $material->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="deliveryRegionAdmin" class="flex mt-2">
                        <span class="w-1/3 self-center">Материал</span>
                        <input type="text" name="weight"
                               class="text-gray-700 p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Район</span>
                        <input type="text" name="deliveryDistrict"
                               class="p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Город</span>
                        <input type="text" name="deliveryCity"
                               class="p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Улица</span>
                        <input type="text" name="deliveryStreet"
                               class="p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Дом</span>
                        <input type="text" name="deliveryBuilding"
                               class="p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Квартира</span>
                        <input type="text" name="deliveryApartment"
                               class="p-1 w-2/3 bg-transparent border border-white rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Доставка</span>
                        <input type="text" disabled
                               class="text-gray-700 p-1 w-2/3 bg-transparent border border-gray-700 rounded">
                    </div>
                    <div class="flex mt-2">
                        <span class="w-1/3 self-center">Сумма</span>
                        <input type="text" disabled
                               class="text-gray-700 p-1 w-2/3 bg-transparent border border-gray-700 rounded">
                    </div>
                    <div class="flex mt-2 font-bold">
                        <span class="w-1/3 self-center">Итого</span>
                        <input type="text" disabled
                               class="text-gray-700 p-1 w-2/3 bg-transparent border border-gray-700 rounded">
                    </div>

                </div>
            </div>

            <div class="p-2">
                <p>Комментарий покупателя</p>
                <textarea disabled id=""
                          class="w-full bg-transparent text-white h-32 border border-gray-700 rounded"></textarea>
            </div>

            <div class="p-2">
                <p>Комментарий менеджера</p>
                <div id="managerCommentBlock" class="border rounded border-white p-2"
                     onclick="editReview()"></div>

                <textarea id="mytextarea" name="adminComment"
                          class="hidden editor w-full bg-transparent h-32 border border-white rounded"></textarea>
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

            <div class="flex justify-between flex-wrap sm:flex-no-wrap">

                <a href="{{ route('admin.orders') }}"
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
