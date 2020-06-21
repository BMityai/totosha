<?php

namespace App\Http\Middleware;

use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use Closure;

class CreateDoubleOrderOnUpdatePage
{

    public function __construct()
    {
        $this->dbRepository = new MainEloquentRepository();
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (count($this->dbRepository->getCartInfo()) == 0) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
