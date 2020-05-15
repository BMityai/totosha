<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'email/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        Validator::extend(
            'correctBirthDate',
            function ($birthDate, $value, $parameters) {
                $dateParams           = explode("/", $value);
                $nowDate              = date('d M Y');
                $birthDateConcatenate = $dateParams[1] . '/' . $dateParams[0] . '/' . $dateParams[2];
                $birthDate            = date('d M Y', strtotime($birthDateConcatenate));

                if ((int)$dateParams[0] > 31 || (int)$dateParams[1] > 12) {
                    return false;
                }

                if ((int)$dateParams[0] <= 0 || (int)$dateParams[1] <= 0) {
                    return false;
                }

                if ((int)$dateParams[2] <= 1930) {
                    return false;
                }

                if (strtotime($birthDate) >= strtotime($nowDate)) {
                    return false;
                }
                return true;
            }
        );


        $messages = [
            'required'           => 'Обязательное поле для заполнения',
            'name.string'        => 'Поле имя должно содержать только буквы',
            'correct_birth_date' => 'Неверная дата рождения',
            'email'              => 'Введите корректный email',
            'confirmed'          => 'Пароли не совпадают',
            'email.unique'       => 'Пользователь с таким email зарегистрирован',
            'phone.unique'       => 'Пользователь с таким номером зарегистрирован',
            'phone.max'          => 'Неверный номер телефона',
            'phone.min'          => 'Неверный номер телефона',
            'name.min'           => 'Имя должно содержать не менее :min букв',
            'name.max'           => 'Имя должно содержать не более :max букв',
            'password.min'       => 'Минимальное количество символов :min'
        ];
        return Validator::make(
            $data,
            [
                'name'      => ['required', 'string', 'max:20', 'min:2'],
                'birthDate' => ['required', 'string', 'max:10', 'correctBirthDate'],
                'phone'     => ['required', 'string', 'max:18', 'min:18', 'unique:users'],
                'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password'  => ['required', 'string', 'min:8', 'confirmed'],
            ],
            $messages
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $birthDate = Helpers::getCleanBirthDate($data['birthDate']);
        return User::create(
            [
                'name'       => $data['name'],
                'phone'      => $data['phone'],
                'email'      => $data['email'],
                'birth_date' => $birthDate,
                'password'   => Hash::make($data['password']),
            ]
        );
    }
}
