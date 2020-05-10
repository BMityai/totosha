<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * @var string
     */
    private $uri;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo(){
        return $this->uri;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->uri =  url()->previous();
        $this->middleware('emailVerify')->only('login');
        $this->middleware('guest')->except('logout');
    }
}
