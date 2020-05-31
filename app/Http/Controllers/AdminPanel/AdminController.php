<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use App\Services\AdminControllerService;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @var AdminControllerService
     */
    private $service;

    public function __construct()
    {
        $this->service = new AdminControllerService(new MainEloquentRepository());
    }

    public function index()
    {
        return view('admin.home');
    }

    public function getOrders(Request $request)
    {
        $orders = $this->service->getAllOrders($request->all());
        $statuses = $this->service->getAllStatuses();
        return view('admin.orders', ['orders' => $orders, 'statuses' => $statuses]);
    }

    public function getOrder($orderId)
    {
        $regions = $this->service->getRegions();
        $statuses = $this->service->getStatuses();
        $order = $this->service->getOrderById($orderId);
        return view('admin.order', ['order' => $order, 'regions'=>$regions, 'statuses' => $statuses]);
    }

    public function getProducts(Request $request)
    {
        $requestQueryString = $request->getQueryString();
        $categories = $this->service->getAllActiveCategories();
        $products = $this->service->getAllProducts($request->all(), $requestQueryString);
        return view('admin.products', ['products' => $products, 'categories' => $categories]);
    }

    public function editOrder(Request $request, $orderId)
    {
        $this->service->updateOrder($orderId, $request->all());
        return redirect()->back();
    }
}
