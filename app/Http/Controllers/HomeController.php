<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
use App\Http\Requests\PreorderRequest;
use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use App\Services\HomeControllerService;
use http\Env\Request;
use Illuminate\Contracts\Support\Renderable;

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
        $this->service = new HomeControllerService(new MainEloquentRepository());
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

    public function getCategoryProducts(FilterRequest $request, $slug)
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

    public function getPreorderForm()
    {
        return view('preorderForm');
    }

    public function createPreorder(PreorderRequest $request)
    {
        $this->service->savePreorder($request->all());
        return view('successPreorder');
    }
}
