<?php

namespace App\Http\Controllers;

use App\Reposotories\MoiMalyshEloquentRepository\MoiMalyshEloquentRepository;
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
        $this->service = new BasketControllerService(new MoiMalyshEloquentRepository());
    }

    public function addOrDelete(Request $request)
    {
        $productCount = $this->service->addOrDeleteProducts((int)$request->productId);
        return $productCount;
    }
}
