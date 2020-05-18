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
        
//        session([
//            'wishList' => [$request->get('productId')]
//                ]);
        $wishlist = session()->get('wishList');
        dd($wishlist);
        array_push($wishlist, $request->get('productId'));
        session([
            'wishList' => $wishlist
                ]);
//        dd(session()->get('wishList'));
    }
}
