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
                            <div class="w-2/3">
                                <input type="text" name="name" value="{{ old('name') }}"
                                   class="p-1 w-full bg-transparent border @error('name') border-red-700 @else border-white text-white @enderror rounded">
                                @error('name')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Категория</span>
                            <div class="w-2/3">
                                <select type="text" name="category"
                                        class="w-full text-white p-2 w-2/3 bg-transparent border @error('category') border-red-700 @else border-white text-white @enderror border-white rounded">
                                    <option value disabled selected> Выбрать категорию </option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                        @if(old('category') == $category->id)
                                            selected
                                        @endif
                                        >{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Производитель</span>
                            <div class="w-2/3">
                                <select type="text" name="manufacturer"
                                        class="w-full text-white p-2 w-2/3 bg-transparent border @error('manufacturer') border-red-700 @else border-white text-white @enderror rounded">
                                    <option value disabled selected>Выбрать производителя</option>
                                    @foreach($manufacturers as $manufacturer)
                                        <option value="{{ $manufacturer->id }}"
                                            @if(old('manufacturer') == $manufacturer->id)
                                                selected
                                            @endif
                                        >{{ $manufacturer->country }}</option>
                                    @endforeach
                                </select>
                                @error('manufacturer')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Возраст</span>
                            <div class="w-2/3">
                                <select type="text" name="age"
                                        class="p-2 w-full bg-transparent border @error('age') border-red-700 @else border-white text-white @enderror rounded">
                                <option value disabled selected>Выбрать возраст</option>
                                @foreach($ages as $age)
                                        <option value="{{ $age->id }}"
                                            @if(old('age') == $age->id)
                                                selected
                                            @endif
                                        >{{ $age->age }}</option>
                                    @endforeach
                                </select>
                                @error('manufacturer')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Высота, mm</span>
                            <div class="w-2/3">
                                <input type="text" name="height" value="{{ old('height') }}"
                                   class="p-1 w-full bg-transparent border @error('height') border-red-700 @else border-white text-white @enderror rounded">
                                @error('height')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Ширина, mm</span>
                            <div class="w-2/3">
                                <input type="text" name="width" value="{{ old('width') }}"
                                   class="p-1 w-full bg-transparent border @error('width') border-red-700 @else border-white text-white @enderror rounded">
                                @error('width')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Глубина, mm</span>
                            <div class="w-2/3">
                                <input type="text" name="depth" value="{{ old('depth') }}"
                                   class="p-1 w-full bg-transparent border @error('depth') border-red-700 @else border-white text-white @enderror rounded">
                                @error('depth')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Вес, гр</span>
                            <div class="w-2/3">
                                <input type="text" name="weight" value="{{ old('weight') }}"
                                   class="p-1 w-full bg-transparent border @error('weight') border-red-700 @else border-white text-white @enderror rounded">
                                @error('weight')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class=" mt-2">
                            <input id="kv-explorer" name="img[]" type="file" multiple>
                            @error('img')
                            <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 p-2">
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Материал</span>
                            <div class="w-2/3">
                                <select type="text" name="material"
                                        class="p-2 w-full bg-transparent border @error('material') border-red-700 @else border-white text-white @enderror rounded">
                                    <option value disabled selected>Выбрать материал</option>
                                    @foreach($materials as $material)
                                        <option value="{{ $material->id }}"
                                            @if(old('material') == $material->id)
                                                selected
                                            @endif
                                        >{{ $material->name }}</option>
                                    @endforeach
                                </select>
                                @error('material')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div id="deliveryRegionAdmin" class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Себестоимость</span>
                            <div class="w-2/3">
                                <input type="tel" name="costPrice" value="{{ old('costPrice') }}"
                                   class="p-1 w-full bg-transparent border @error('costPrice') border-red-700 @else text-white border-white @enderror rounded">
                                @error('costPrice')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Цена</span>
                            <div class="w-2/3">
                                <input type="tel" name="price" id="price" value="{{ old('price') }}"
                                   class="p-1 w-full bg-transparent border @error('price') border-red-700 @else border-white text-white @enderror rounded">
                                @error('price')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Скидка, %</span>
                            <div class="w-2/3">
                                <input type="tel" name="discount" oninput="calculanteWithDiscountPrice(event)" value="{{ old('discount') }}"
                                   class="p-1 w-full bg-transparent border @error('discount') border-red-700 @else border-white text-white @enderror rounded">
                                @error('discount')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Цена со скидкой</span>
                            <div class="w-2/3">
                                <input type="tel" disabled id="priceWithDiscount" name="discountPrice" value="{{ old('discountPrice') }}"
                                   class="p-1 w-full bg-transparent border border-2 @error('priceWithDiscount') border-red-700 text-red-700 @else border-gray-700 text-gray-700 @enderror  rounded">
                                @error('priceWithDiscount')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Количество</span>
                            <div class="w-2/3">
                                <input type="tel" name="count" value="{{ old('count') }}"
                                   class="p-1 w-full bg-transparent border @error('count') border-red-700 @else border-white text-white @enderror rounded">
                                @error('count')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Рекомендуемый</span>
                            <div class="w-2/3">
                                <select type="text" name="recommended"
                                    class="p-2 w-full bg-transparent border @error('recommended') border-red-700 @else border-white text-white @enderror rounded">
                                <option value selected disabled> Выбрать </option>
                                <option value="1"
                                @if(old('recommended') == 1)
                                    selected
                                @endif
                                >Да</option>
                                <option value="0"
                                @if(old('recommended') == 0)
                                    selected
                                @endif
                                >Нет</option>
                                </select>
                                @error('recommended')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Новинка</span>
                            <div class="w-2/3">
                                <select type="text" name="new"
                                    class="p-2 w-full bg-transparent border @error('new') border-red-700 @else border-white text-white @enderror rounded">
                                    <option value selected disabled> Выбрать </option>
                                    <option value="1"
                                            @if(old('new') == 1)
                                            selected
                                        @endif
                                    >Да</option>
                                    <option value="0"
                                            @if(old('new') == 0)
                                            selected
                                        @endif
                                    >Нет</option>
                                </select>
                                @error('new')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Скоро в продаже</span>
                            <div class="w-2/3">
                                <select type="text" name="comingSoon"
                                        class="p-2 w-full bg-transparent border @error('comingSoon') border-red-700 @else border-white text-white @enderror rounded">
                                    <option value selected disabled> Выбрать </option>
                                    <option value="1"
                                            @if(old('comingSoon') == 1)
                                            selected
                                        @endif
                                    >Да</option>
                                    <option value="0"
                                            @if(old('comingSoon') == 0)
                                            selected
                                        @endif
                                    >Нет</option>
                                </select>
                                @error('comingSoon')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                <div class="p-2">
                    <p>Примечание</p>
                    <textarea name="note"
                              class="w-full bg-transparent text-white h-24 border @error('note') border-red-700 text-red-700 @else border-white text-white @enderror rounded"></textarea>
                    @error('note')
                    <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="p-2">
                    <p>Описание</p>
                    <div id="managerCommentBlock" class="border rounded @error('description') border-red-700 text-red-700 @else border-white text-white @enderror p-2"
                         onclick="editReview()"></div>
                    @error('description')
                    <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                    @enderror

                    <textarea id="mytextarea" name="description"
                              class="hidden editor w-full bg-transparent border border-white rounded"></textarea>
                </div>


                <div class="flex justify-between flex-wrap sm:flex-no-wrap">

                    <a href="{{ route('admin.products') }}"
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
