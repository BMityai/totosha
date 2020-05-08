{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Register') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('register') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}
@extends('layouts.master')
@section('title', 'регистрация')
@section('content')

    <div class="container mt-16">
        <div class="bg-grey-lighter min-h-screen flex flex-col">
            <div class="container max-w-xl mx-auto flex-1 flex flex-col items-center justify-center px-2">
                <div class="bg-white px-6 py-8 rounded border-blue-200 border text-black w-full">
                    <h1 class="mb-8 text-3xl text-center">Регистрация</h1>
                    <form  action="{{ route('register') }}" method="POST">
                        @csrf
                        <span>Имя</span>
                        <input
                            type="text"
                            class="block border border-blue-400 w-full p-1 text-xl rounded mb-4"
                            name="name" value="{{ old('name') }}"
                            placeholder="Имя"/>

                        <span>Дата рождения</span>
                        <input
                            id="birthDate"
                            type="tel"
                            class="block border border-blue-400 w-full p-1 text-xl rounded mb-4"
                            name="birthDate" value="{{ old('birthDate') }}"
                            placeholder="Дата рождения"/>

                        <span>Телефон</span>
                        <input
                            id="phone"
                            type="tel"
                            class="block border border-blue-400 w-full p-1 text-xl rounded mb-4"
                            name="phone" value="{{ old('phone') }}"
                            placeholder="Номер телефона"/>

                        <span>email</span>
                        <input
                            type="email"
                            class="block border border-blue-400 w-full p-1 text-xl rounded mb-4"
                            name="email" value="{{ old('email') }}"
                            placeholder="Email"/>

                        <span>Пароль</span>
                        <input
                            type="password"
                            class="block border border-blue-400 w-full p-1 text-xl rounded mb-4"
                            name="password"
                            placeholder="*********"/>

                        <span>Повторите пароль</span>
                        <input
                            type="password"
                            class="block border border-blue-400 w-full p-1 text-xl rounded mb-4"
                            name="password_confirmation"
                            placeholder="*********"/>

                        <button
                            type="submit"
                            class="w-full text-center py-3 rounded bg-blue-600 text-white hover:bg-blue-500 focus:outline-none my-1"
                        >СОЗДАТЬ АККАУНТ
                        </button>
                    </form>

                    <div class="text-center text-sm text-grey-dark mt-4">
                        Регистрируясь, вы соглашаетесь с
                        <a class="no-underline border-b border-grey-dark text-grey-dark" href="#">
                            Условиями обслуживания
                        </a> и
                        <a class="no-underline border-b border-grey-dark text-grey-dark" href="#">
                            Политикой конфиденциальности.
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach

@endsection
