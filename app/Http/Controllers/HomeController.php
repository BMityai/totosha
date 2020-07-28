<?php

namespace App\Http\Controllers;

use App\Helpers\BonusCalcHelper;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\PreorderRequest;
use App\Http\Requests\ProductReviewRequest;
use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use App\Reposotories\TelegramApiRepository\TelegramApiRepository;
use App\Services\HomeControllerService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use PHPUnit\TextUI\Help;
use Symfony\Component\Console\Helper\Helper;

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
        $this->service = new HomeControllerService(new MainEloquentRepository(), new TelegramApiRepository());
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $categories = $this->service->getAllActiveCategories();
        $newProducts = $this->service->getActiveNewProducts();
        return view('home', ['newProducts' => $newProducts, 'categories' => $categories]);
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
        if (is_null($product)){
            abort('404');
        }
        $helper = new BonusCalcHelper();
        $discountRatio = $helper->getBonusCoefficient();
        dump($discountRatio);

        return view('product', ['product' => $product, 'discountRatio' => $discountRatio /100]);
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

    public function createComment(ProductReviewRequest $request)
    {
        session()->flash('review', true);
        $this->service->createReview($request->all());
        return redirect()->back();
    }

    public function getComingSoonProducts(FilterRequest $request)
    {
        $requestQueryString = $request->getQueryString();
        $products = $this->service->getActiveComingSoonProducts($request->toArray(), $requestQueryString);
        return view('comingSoon', ['products' => $products]);
    }

    public function getSalesProducts(FilterRequest $request)
    {
        $requestQueryString = $request->getQueryString();
        $products = $this->service->getActiveSalesProducts($request->toArray(), $requestQueryString);
        return view('sales', ['products' => $products]);
    }

    public function getReviews()
    {
        $reviews = $this->service->getReviews();
        return view('reviews', ['reviews' => $reviews]);
    }

    public function getStoreInfo($slug)
    {
        $storeInfo = $this->service->getStoreInfo($slug);
        return view('storeInfo', ['storeInfo' => $storeInfo]);
    }

    public function createAdminComment(Request $request, int $reviewId)
    {
        $this->service->saveAdminReview($reviewId, $request->all());
        return redirect()->back();
    }
}
