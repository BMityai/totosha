<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserDataRequest extends FormRequest
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
        $rules = [
            'name'     => ['required', 'string', 'max:20', 'min:2'],
            'phone'    => ['required', 'string', 'max:18', 'min:18', 'unique:users'],
            'email'    => 'required|email|max:255|unique:users,email'
        ];

        if($this->route()->named('updateUserData')){
            $rules['email'] .= ',' . Auth::user()->id;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required'           => 'Обязательное поле для заполнения',
            'name.string'        => 'Поле имя должно содержать только буквы',
            'email'              => 'Введите корректный email',
            'email.unique'       => 'Пользователь с таким email зарегистрирован',
            'phone.unique'       => 'Пользователь с таким номером зарегистрирован',
            'phone.max'          => 'Неверный номер телефона',
            'phone.min'          => 'Неверный номер телефона',
            'name.min'           => 'Имя должно содержать не менее :min букв',
            'name.max'           => 'Имя должно содержать не более :max букв',
        ];
    }
}
