<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if(Auth::check() && !$request->user()->hasVerifiedEmail()){
            session()->flash('emailNotVerify', true);
            return redirect()->route('verification.notice');
        };

        if(Auth::check() && $request->user()->hasVerifiedEmail() && $request->route()->getName() == 'verification.verify'){
            $request->session()->flash('emailVerify', true);
        };
        return $response;
    }
}
