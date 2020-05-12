<?php

namespace App\Http\Controllers;

use App\Reposotories\MoiMalyshEloquentRepository\MainEloquentRepository;
use App\Services\BasketControllerService;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    /**
     * @var BasketControllerService
     */
    private $service;

    public function __construct()
    {
        $this->service = new BasketControllerService(new MainEloquentRepository());
    }

    public function addOrDelete(Request $request)
    {
        $addInfo = $this->service->addOrDeleteProducts((int)$request->productId);
        if (is_object($addInfo)) {
            $data = [
                'id'    => $addInfo->product->id,
                'count' => $addInfo->product->count,
                'name'  => $addInfo->product->name,
                'price' => $addInfo->product->discount_price
            ];
            return response()->json($data);
        };
    }

    public function changeCount(Request $request)
    {
        $result = $this->service->changeProductCountInMiniBasket((int)$request->productId, (int)$request->count);
        return response()->json($result);
    }
}
