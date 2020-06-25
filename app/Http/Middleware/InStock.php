<?php

namespace App\Http\Middleware;

use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use Closure;

class InStock
{

    public function __construct(MainEloquentRepository $mainEloquentRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $basketProducts = $this->dbRepository->getCartInfo();
        foreach ($basketProducts as $basketProduct){
            $productInStock = $this->dbRepository->getProductById($basketProduct->product_id);
            if ($productInStock->count < $basketProduct->count){
                $this->dbRepository->deleteBasketProduct($basketProduct);
                return abort(500);
            }
        }
        return $next($request);
    }
}
