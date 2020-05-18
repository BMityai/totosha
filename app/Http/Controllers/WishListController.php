<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishListController extends Controller
{
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
