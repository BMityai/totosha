<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PreorderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"               => "required|string|min:2",
            'phone'              => 'string|max:18|min:18',
            "customerEmail"      => "email",
            "productName"        => "required|string|min:2|max:100",
            "productLink"        => "string|min:2, max:255",
            "productDescription" => "string|min:2, max:500",
        ];
    }

    public function messages()
    {
        return [
            'required'  => 'Обязательное для заполнения поле',
            'string'    => 'Неправильный формат',
            'email'     => 'Введите корректный mail',
            'phone.max' => 'Неверный номер телефона',
            'phone.min' => 'Неверный номер телефона',
            'name.min'  => 'Имя должно содержать не менее :min букв',
            'name.max'  => 'Имя должно содержать не более :max букв',
            'min'       => 'Минимальное количество символов :min',
            'max'       => 'Максимальное количество символов :max'
        ];
    }
}
