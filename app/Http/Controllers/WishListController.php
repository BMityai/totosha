<?php

namespace App\Http\Controllers;

use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use App\Services\WishListService;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    /**
     * @var WishListService
     */
    private $service;

    public function __construct()
    {
        $this->service = new WishListService(new MainEloquentRepository());
    }

    public function addOrDelete(Request $request)
    {
        $this->service->addOrDeleteWishListProduct($request->get('productId'));
    }

    public function get()
    {
        $wishListProducts = $this->service->getWishList();
        $categories       = $this->service->getCategories();
        return view('wishlist', ['wishListProducts' => $wishListProducts, 'categories' => $categories]);
    }
}
