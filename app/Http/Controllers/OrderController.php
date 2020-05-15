<?php

namespace App\Http\Controllers;

use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use App\Services\OrderControllerService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @var OrderControllerService
     */
    private $service;



    public function __construct()
    {
        $this->service = new OrderControllerService(new MainEloquentRepository());
    }

    public function createOrder(Request $request)
    {
        $orderNumber = $this->service->createOrder($request->all());
        return view('successOrder', ['orderNumber' => $orderNumber]);
    }
}
