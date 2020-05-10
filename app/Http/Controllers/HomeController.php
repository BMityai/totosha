<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Category;
use App\Reposotories\MoiMalyshEloquentRepository\MoiMalyshEloquentRepository;
use App\Services\HomeControllerService;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * @var HomeControllerService
     */
    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new HomeControllerService(new MoiMalyshEloquentRepository());
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $newProducts = $this->service->getActiveNewProducts();
        return view('home', ['newProducts' => $newProducts]);
    }

    public function getCategoryProducts(Request $request, $slug)
    {
        $requestQueryString = $request->getQueryString();
        $products = $this->service->getProductsByCategorySlug($slug, $request->toArray(), $requestQueryString);
        $category = $this->service->getCategoryBySlug($slug);

        return view('category', ['products' => $products, 'category' => $category]);
    }

    public function getProductPage($category, $product)
    {
        $product = $this->service->getActiveProductBySlug($product);
        return view('product', ['product' => $product]);
    }
}
