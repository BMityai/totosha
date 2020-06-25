@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Привет!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
Для подтверждения email адреса нажмите на кнопку:

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
Подтвердить
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
Если Вы не регистрировались на сайте MIMISHKA.KZ, просим оставить это письмо без внимания

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('С уважением'),<br>
{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "В случае возникновения проблем с нажатием на вышеуказанную кнопку, скопируйте эту ссылку \n".
    "и вставьте в адресную строку Вашего браузера:" . "\n",
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
