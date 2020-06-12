@extends('admin.layouts.master')
@section('title', ': Добавить товар')

@section('content')



        <form action="{{ route('admin.addProduct') }}" method="POST" enctype="multipart/form-data"
              class="container text-white mt-24 sm:mt-16 m-auto lg:mt-32 mb-32">
            @csrf

            <div class="flex justify-between mt-2 p-2 flex-wrap md:flex-no-wrap">
                <h1 class="text-xl">Добавить товар</h1>
            </div>
            <div>
                <div class="flex w-full flex-wrap md:flex-no-wrap">
                    <div class="w-full md:w-1/2 p-2">
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Наименование</span>
                            <input type="text" name="name"
                                   class="p-1 w-2/3 bg-transparent border border-white rounded">
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Категория</span>
                            <select type="text" name="category"
                                    class="text-white p-2 w-2/3 bg-transparent border border-white rounded">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Производитель</span>
                            <select type="text" name="manufacturer"
                                    class="text-white p-2 w-2/3 bg-transparent border border-white rounded">
                                @foreach($manufacturers as $manufacturer)
                                    <option value="{{ $manufacturer->id }}">{{ $manufacturer->country }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Возраст</span>
                            <select type="text" name="age"
                                    class="text-white p-2 w-2/3 bg-transparent border border-white rounded">
                                @foreach($ages as $age)
                                    <option value="{{ $age->id }}">{{ $age->age }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Высота</span>
                            <input type="text" name="height"
                                   class="text-white p-1 w-2/3 bg-transparent border border-white rounded">
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Ширина</span>
                            <input type="text" name="width"
                                   class="text-white p-1 w-2/3 bg-transparent border border-white rounded">
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Глубина</span>
                            <input type="text" name="depth"
                                   class="text-white p-1 w-2/3 bg-transparent border border-white rounded">
                        </div>

                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Вес</span>
                            <input type="text" name="weight"
                                   class="text-white p-1 w-2/3 bg-transparent border border-white rounded">
                        </div>
                        <div class="flex mt-2">

                            <div class="file-loading w-2/3">
                                <input id="kv-explorer" name="img[]" type="file" multiple>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 p-2">
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Материал</span>
                            <select type="text" name="material"
                                    class="text-white p-2 w-2/3 bg-transparent border border-white rounded">
                                @foreach($materials as $material)
                                    <option value="{{ $material->id }}">{{ $material->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="deliveryRegionAdmin" class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Себестоимость</span>
                            <input type="tel" name="costPrice"
                                   class="text-gray-700 p-1 w-2/3 bg-transparent border border-white rounded">
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Цена</span>
                            <input type="tel" name="price"
                                   class="p-1 w-2/3 bg-transparent border border-white rounded">
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Скидка</span>
                            <input type="tel" name="discount"
                                   class="p-1 w-2/3 bg-transparent border border-white rounded">
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Цена со скидкой</span>
                            <input type="tel" name="priceWithDiscount"
                                   class="p-1 w-2/3 bg-transparent border border-white rounded">
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Количество</span>
                            <input type="tel" name="count"
                                   class="p-1 w-2/3 bg-transparent border border-white rounded">
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Рекомендуемый</span>
                            <select type="text" name="recommended"
                                    class="p-2 w-2/3 bg-transparent border border-white rounded">
                                <option value="1">Да</option>
                                <option value="0">Нет</option>
                            </select>
                        </div>

                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Новинка</span>
                            <select type="text" name="new"
                                    class="p-2 w-2/3 bg-transparent border border-white rounded">
                                <option value="1">Да</option>
                                <option value="0">Нет</option>
                            </select>
                        </div>

                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Скоро в продаже</span>
                            <select type="text" name="comingSoon"
                                    class="p-2 w-2/3 bg-transparent border border-white rounded">
                                <option value="1">Да</option>
                                <option value="0">Нет</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="p-2">
                    <p>Примечание</p>
                    <textarea name="note"
                              class="w-full bg-transparent text-white h-32 border border-white rounded"></textarea>
                </div>

                <div class="p-2">
                    <p>Описание</p>
                    <div id="managerCommentBlock" class="border rounded border-white p-2"
                         onclick="editReview()"></div>

                    <textarea id="mytextarea" name="description"
                              class="hidden editor w-full bg-transparent h-32 border border-white rounded"></textarea>
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
