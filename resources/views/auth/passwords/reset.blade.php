@extends('layouts.master')

@section('content')
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Reset Password') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('password.update') }}">--}}
{{--                        @csrf--}}

{{--                        <input type="hidden" name="token" value="{{ $token }}">--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>--}}

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
{{--                                    {{ __('Reset Password') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="container mt-16">
    <div class="bg-grey-lighter h-full flex flex-col">
        <div class="container max-w-xl mx-auto flex-1 flex flex-col items-center justify-center px-2">
            <div class="bg-white px-6 py-8 rounded text-black w-full">
                <h1 class="mb-8 text-3xl text-center">Изменение пароля</h1>
                <form  action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">


                    <p class="mt-4">email</p>
                    <input
                        type="email"
                        class="block border @error('email') border-red-400 @else border-blue-400 @enderror w-full p-1 text-xl rounded"
                        name="email" value="{{ $email ?? old('email') }}"
                        placeholder="Email"/>

                    @error('email')
                    <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                    @enderror

                    <p class="pt-4">Пароль</p>
                    <input
                        type="password"
                        class="block border @error('password') border-red-400 @else border-blue-400 @enderror w-full p-1 text-xl rounded"
                        name="password"
                        placeholder="*********"/>

                    @error('password')
                    <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                    @enderror

                    <p class="mt-4">Повторите пароль</p>
                    <input
                        type="password"
                        class="block border @error('password') border-red-400 @else border-blue-400 @enderror w-full p-1 text-xl rounded mb-4"
                        name="password_confirmation"
                        placeholder="*********"/>

                    <button
                        type="submit"
                        class="w-full text-center py-3 rounded bg-blue-600 text-white hover:bg-blue-500 focus:outline-none my-1"
                    >СОХРАНИТЬ
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
