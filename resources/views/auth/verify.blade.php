@extends('layouts.master')

@section('content')
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Verify Your Email Address') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('resent'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ __('A fresh verification link has been sent to your mail address.') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {{ __('Before proceeding, please check your mail for a verification link.') }}--}}
{{--                    {{ __('If you did not receive the mail') }},--}}
{{--                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">--}}
{{--                        @csrf--}}
{{--                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

    <div class="container mt-16 text-lg">
        <div class="titleVerify text-justify top-auto w-3/4 mx-auto">
            <h1 class="text-xl text-center">Подтвердите свой email адрес</h1>
            <p class="mt-4">&#8195;Для завершения регистрации, а также в целях обеспечения безопасности Вашего аккаунта, Вам необходимо пройти процесс верификации email адреса.</p>
            <p class="mt-4">&#8195;Что бы подтвердить свою почту, на Ваш email отправлено письмо с уникальной ссылкой, осталось пройти по указанной ссылке и продолжить покупки.</p>
            <p class="mt-4">&#8195;Если письмо не пришло, нажмите на кнопку "ОТПРАВИТЬ ЕЩЕ РАЗ". </p>
            <form class="text-center mt-4" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class=" text-white bg-blue-600 hover:bg-blue-500 rounded p-2">ОТПРАВИТЬ ЕЩЕ РАЗ</button>
            </form>
        </div>
    </div>

@endsection
