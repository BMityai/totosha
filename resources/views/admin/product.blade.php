@extends('admin.layouts.master')
@section('title', ': Изменить товар')

@section('content')

        <form action="{{ route('admin.editProduct', $product->id ) }}" method="POST" enctype="multipart/form-data"
              class="container text-white mt-24 sm:mt-16 m-auto lg:mt-32 mb-32">
            @csrf

            <div class="flex justify-between mt-2 p-2 flex-wrap md:flex-no-wrap">
                <h1 class="text-xl">Редактировать товар</h1>
            </div>
            <div>
                <div class="flex w-full flex-wrap md:flex-no-wrap">
                    <div class="w-full md:w-1/2 p-2">
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Наименование</span>
                            <div class="w-2/3">
                                <input type="text" name="name" value="{{ !empty(old('name')) ? old('name') : $product->name }}"
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
                                        @if($product->category->id == $category->id)
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
                                            @if($product->manufacturer->id == $manufacturer->id)
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
                                            @if($product->age->id == $age->id)
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
                                <input type="text" name="height" value="{{ !empty(old('height')) ? old('height') : $product->height }}"
                                   class="p-1 w-full bg-transparent border @error('height') border-red-700 @else border-white text-white @enderror rounded">
                                @error('height')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Ширина, mm</span>
                            <div class="w-2/3">
                                <input type="text" name="width" value="{{ !empty(old('width')) ? old('width') : $product->width }}"
                                   class="p-1 w-full bg-transparent border @error('width') border-red-700 @else border-white text-white @enderror rounded">
                                @error('width')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Глубина, mm</span>
                            <div class="w-2/3">
                                <input type="text" name="depth" value="{{ !empty(old('depth')) ? old('depth') : $product->depth }}"
                                   class="p-1 w-full bg-transparent border @error('depth') border-red-700 @else border-white text-white @enderror rounded">
                                @error('depth')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Вес, гр</span>
                            <div class="w-2/3">
                                <input type="text" name="weight" value="{{ !empty(old('weight')) ? old('weight') : $product->weight }}"
                                   class="p-1 w-full bg-transparent border @error('weight') border-red-700 @else border-white text-white @enderror rounded">
                                @error('weight')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Отображать</span>
                            <div class="w-2/3">
                                <select type="text" name="is_active"
                                        class="p-2 w-full bg-transparent border @error('recommended') border-red-700 @else border-white text-white @enderror rounded">
                                    <option value selected disabled> Выбрать </option>
                                    <option value="1"
                                            @if($product->is_active === 1)
                                            selected
                                            @endif
                                            @if(old('is_active') === '1')
                                            selected
                                        @endif
                                    >Да</option>
                                    <option value="0"
                                            @if($product->is_active === 0)
                                            selected
                                            @endif
                                            @if(old('is_active') === '0')
                                            selected
                                        @endif
                                    >Нет</option>
                                </select>
                                @error('recommended')
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
                                            @if($product->material->id == $material->id)
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
                                <input type="tel" name="costPrice" value="{{ !empty(old('costPrice')) ? old('costPrice') : $product->cost_price }}"
                                   class="p-1 w-full bg-transparent border @error('costPrice') border-red-700 @else text-white border-white @enderror rounded">
                                @error('costPrice')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Цена</span>
                            <div class="w-2/3">
                                <input type="tel" name="price" id="price" value="{{ !empty(old('price')) ? old('price') : $product->price }}"
                                   class="p-1 w-full bg-transparent border @error('price') border-red-700 @else border-white text-white @enderror rounded">
                                @error('price')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Скидка, %</span>
                            <div class="w-2/3">
                                <input type="tel" name="discount" oninput="calculanteWithDiscountPrice(event)" value="{{ !empty(old('discount')) ? old('discount') : $product->discount }}"
                                   class="p-1 w-full bg-transparent border @error('discount') border-red-700 @else border-white text-white @enderror rounded">
                                @error('discount')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Цена со скидкой</span>
                            <div class="w-2/3">
                                <input type="tel" disabled id="priceWithDiscount" name="discount_price" value="{{ !empty(old('discount_price')) ? old('discount_price') : $product->discount_price }}"
                                   class="p-1 w-full bg-transparent border border-2 @error('priceWithDiscount') border-red-700 text-red-700 @else border-gray-700 text-gray-700 @enderror  rounded">
                                @error('priceWithDiscount')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Количество</span>
                            <div class="w-2/3">
                                <input type="tel" name="count" value="{{ !empty(old('count')) ? old('count') : $product->count }}"
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
                                @if($product->recommended === 1)
                                    selected
                                @endif
                                @if(old('recommended') === '1')
                                    selected
                                @endif
                                >Да</option>
                                <option value="0"
                                @if($product->recommended === 0)
                                    selected
                                @endif
                                @if(old('recommended') === '0')
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
                                            @if($product->new === 1)
                                            selected
                                            @endif
                                            @if(old('new') === '1')
                                            selected
                                        @endif
                                    >Да</option>
                                    <option value="0"
                                            @if($product->new === 0)
                                            selected
                                            @endif
                                            @if(old('new') === '0')
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
                                            @if($product->coming_soon === 1)
                                            selected
                                            @endif
                                            @if(old('comingSoon') === '1')
                                            selected
                                        @endif
                                    >Да</option>
                                    <option value="0"
                                            @if($product->coming_soon === 0)
                                            selected
                                            @endif
                                            @if(old('comingSoon') === '0')
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

                <div class="flex flex-wrap">
                        @foreach($product->images as $image)
                        <div class="w-1/5 p-2 relative">

                            <img class="rounded-t cursor-pointer"
                                 src="{{ asset($image->path) }}" alt="">

                                <a class="absolute left-0 top-0 px-2 w-full" onclick="deleteImg(event)" href="{{ route('admin.deleteImg') }}">
                                    <div data-id="{{ $image->id }}"  class="bg-red-700 text-center">
                                        Удалить
                                    </div>
                                </a>
                                <a class="bottom-0"  onclick="changeMainImg(event)" href="{{ route('admin.changeMainImage') }}">
                                    <div data-id="{{ $image->id }}" id="productImg_{{$image->id}}" class="
                                    @if($image->on_main)
                                        bg-green-700
                                        disabled
                                    @else
                                        bg-indigo-700
                                    @endif
                                    text-center">
                                        @if($image->on_main)
                                            На главной
                                        @else
                                            На главную
                                        @endif
                                    </div>
                                </a>
                        </div>

                    @endforeach

                </div>


                <div class="p-2">
                    <p>Примечание</p>
                    <textarea name="note"
                              class="w-full bg-transparent text-white h-24 border @error('note') border-red-700 text-red-700 @else border-white text-white @enderror rounded">{{ !empty(old('note')) ? old('note') : $product->note }}</textarea>
                    @error('note')
                    <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="p-2">
                    <p>Описание</p>
                    <div id="managerCommentBlock" class="border rounded @error('description') border-red-700 text-red-700 @else border-white text-white @enderror p-2"
                         onclick="editReview()">{!! !empty(old('description')) ? old('description') : $product->description !!} </div>
                    @error('description')
                    <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                    @enderror

                    <textarea id="mytextarea" name="description"
                              class="hidden editor w-full bg-transparent border border-white rounded">{{ !empty(old('description')) ? old('description') : $product->description }}</textarea>
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
