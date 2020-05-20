<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['verify' => true]);

Route::get('/cabinet/orders', 'CustomerCabinet\CabinetController@getOrders')->name('ordersHistory');


Route::get('wishlist', 'WishListController@get')->name('wishList');

Route::get('basket', 'BasketController@getBasket')->name('basket');

Route::get('/login', 'HomeController@index')->name('login')->middleware('showLoginForm');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => '{category}'], function (){
    Route::get('/', 'HomeController@getCategoryProducts')->name('category');
    Route::get('/{product}', 'HomeController@getProductPage')->name('product');
});

Route::post('/add_to_basket', 'BasketController@addOrDelete')->name('addToBasket');
Route::post('/change_count', 'BasketController@changeCount')->name('changeCount');

Route::post('/get_delivery_price', 'BasketController@getDeliveryPrice')->name('getDeliveryPrice');

Route::post('/create_order', 'OrderController@createOrder')->name('createOrder');
Route::post('/add_to_wishlist', 'WishListController@addOrDelete')->name('addToWishList');

