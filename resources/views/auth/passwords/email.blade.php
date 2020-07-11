@extends('layouts.master')

@section('content')
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Reset Password') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    <form method="POST" action="{{ route('password.mail') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="mail" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="mail" type="mail" class="form-control @error('email') is-invalid @enderror" name="mail" value="{{ old('email') }}" required autocomplete="mail" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Send Password Reset Link') }}--}}
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
                <h1 class="mb-8 text-3xl text-center">Восстановление пароля</h1>
                @if (session('status'))
                    <div class="text-center text-green-700" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form  action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <p class="mt-4">email</p>
                    <input
                        type="email"
                        class="block border @error('email') border-red-400 @else border-blue-400 @enderror w-full p-1 text-xl rounded"
                        name="email" value="{{ old('email') }}"
                        placeholder="Email"/>

                    @error('email')
                    <p class="text-red-600 text-center -mb-4">{{ $message }}</p>
                    @enderror

                    <button
                        type="submit"
                        class="mt-4 w-full text-center py-3 rounded bg-blue-600 text-white hover:bg-blue-500 focus:outline-none my-1"
                    >СБРОСИТЬ
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
