@extends('admin.layouts.master')
@section('title', ': Пользователь ' . $customer->name)

@section('content')

        <form action="{{ route('admin.updateCustomer', $customer->id) }}" method="POST" enctype="multipart/form-data"
              class="container text-white mt-24 sm:mt-16 m-auto lg:mt-32 mb-32">
            @csrf

            <div class="flex justify-between mt-2 p-2 flex-wrap md:flex-no-wrap">
                <h1 class="text-xl">Карточка клиента #{{ $customer->id }}</h1>
                <h1 class="text-xl">  Бонусов на счету: {{ $customer->bonus }}</h1>
            </div>
            <div>
                <div class="flex w-full flex-wrap md:flex-no-wrap">
                    <div class="w-full p-2">
                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Имя</span>
                            <div class="w-2/3">
                                <input type="text" name="name" value="{{ !empty(old('name')) ? old('name') : $customer->name }}"
                                   class="p-1 w-full bg-transparent border @error('name') border-red-700 @else border-white text-white @enderror rounded">
                                @error('name')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Телефон</span>
                            <div class="w-2/3">
                                <input type="tel" name="phone" value="{{ !empty(old('phone')) ? old('name') : $customer->phone }}"
                                   id="phone"
                                   class="p-1 w-full bg-transparent border @error('phone') border-red-700 @else border-white text-white @enderror rounded">
                                @error('phone')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Email</span>
                            <div class="w-2/3">
                                <input type="text" name="email" value="{{ !empty(old('email')) ? old('email') : $customer->email }}"
                                       class="p-1 w-full bg-transparent border @error('email') border-red-700 @else border-white text-white @enderror rounded">
                                @error('email')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Дата рождения</span>
                            <div class="w-2/3">
                                <input type="tel" name="birth_date" value="{{ !empty(old('birth_date')) ? old('birth_date') : $customer->birth_date }}"
                                       id="birthDate" class="p-1 w-full bg-transparent border @error('birth_date') border-red-700 @else border-white text-white @enderror rounded">
                                @error('birth_date')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Бонусы</span>
                            <div class="w-2/3">
                                <input type="tel" name="bonus" value="{{ !empty(old('bonus')) ? old('bonus') : $customer->bonus }}"
                                       id="bonus" class="p-1 w-full bg-transparent border @error('bonus') border-red-700 @else border-white text-white @enderror rounded">
                                @error('bonus')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Активный</span>
                            <div class="w-2/3">
                                <select type="text" name="is_active"
                                        class="p-2 w-full bg-transparent border @error('is_active') border-red-700 @else border-white text-white @enderror rounded">
                                    <option value selected disabled> Выбрать </option>
                                    <option value="1"
                                            @if($customer->is_active === 1)
                                            selected
                                            @endif
                                            @if(old('is_active') === '1')
                                            selected
                                        @endif
                                    >Да</option>
                                    <option value="0"
                                            @if($customer->is_active === 0)
                                            selected
                                            @endif
                                            @if(old('is_active') === '0')
                                            selected
                                        @endif
                                    >Нет</option>
                                </select>
                                @error('is_active')
                                <p class="text-center text-red-700 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Дата регистрации</span>
                            <div class="w-2/3">
                                <input type="text" value="{{ $customer->created_at }}"disabled
                                       class="p-1 w-full bg-transparent border border-gray-700 text-gray-700 rounded">
                            </div>
                        </div>

                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Дата верификации</span>
                            <div class="w-2/3">
                                <input type="text" value="{{ $customer->email_verified_at }}"disabled
                                       class="p-1 w-full bg-transparent border border-gray-700 text-gray-700 rounded">
                            </div>
                        </div>

                        <div class="flex mt-2">
                            <span class="w-1/3 text-sm self-center">Покупок совершено</span>
                            <div class="w-2/3">
                                <input type="text" value="{{ count($customer->orders) }}"disabled
                                       class="p-1 w-1/2 bg-transparent border border-gray-700 text-gray-700 rounded">
                                <a class="w-1/2 bg-transparent hover:bg-blue-500 text-white font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" href="{{ route('admin.customerOrders', $customer->id) }}">Показать</a>

                            </div>
                        </div>


                    </div>
                </div>



                <div class="flex justify-between flex-wrap sm:flex-no-wrap">

                    <a href="{{ route('admin.categories') }}"
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
