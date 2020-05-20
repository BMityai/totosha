<?php

namespace App\Http\Controllers\CustomerCabinet;

use App\Http\Controllers\Controller;
use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use App\Services\CabinetControllerService;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
    /**
     * @var CabinetControllerService
     */
    private $service;

    public function __construct()
    {
        $this->service = new CabinetControllerService(new MainEloquentRepository());
    }

    public function getOrders()
    {
        $orders = $this->service->getCustomerOrders();
        return view('CustomerCabinet.ordersHistory', ['orders' => $orders]);
    }
}
