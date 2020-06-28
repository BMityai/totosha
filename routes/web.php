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

Route::group(
    ['prefix' => '/admin', 'middleware' => ['auth', 'isAdmin']],
    function () {
        // home
        Route::get('/', 'AdminPanel\AdminController@index')->name('admin.home');

        // orders
        Route::get('/orders', 'AdminPanel\AdminController@getOrders')->name('admin.orders');
        Route::get('/order/{orderId}', 'AdminPanel\AdminController@getOrder')->name('admin.order');
        Route::post('/order/edit/{orderId}', 'AdminPanel\AdminController@editOrder')->name('admin.editOrder');

        //products
        Route::get('/products', 'AdminPanel\AdminController@getProducts')->name('admin.products');
        Route::get('/add_product', 'AdminPanel\AdminController@getAddProductForm')->name(
            'admin.getAddProductForm'
        );
        Route::post('/add_product', 'AdminPanel\AdminController@addProduct')->name('admin.addProduct');
        Route::get('/edit_product/{productId}', 'AdminPanel\AdminController@getProductEditForm')->name(
            'admin.editProductForm'
        );
        Route::post('/edit_product/{productId}', 'AdminPanel\AdminController@updateProduct')->name(
            'admin.editProduct'
        );
        Route::post('/delete_img', 'AdminPanel\AdminController@deleteProductImage')->name('admin.deleteImg');
        Route::post('/change_product_main_image', 'AdminPanel\AdminController@changeMainImage')->name(
            'admin.changeMainImage'
        );

        //categories
        Route::get('/categories', 'AdminPanel\AdminController@getCategories')->name('admin.categories');
        Route::get('/add_category', 'AdminPanel\AdminController@getAddCategoryForm')->name(
            'admin.getAddCategoryForm'
        );
        Route::post('/add_category', 'AdminPanel\AdminController@addCategory')->name('admin.addProduct');
        Route::get('/category/{categoryId}', 'AdminPanel\AdminController@getCategoryEditForm')->name(
            'admin.editCategoryForm'
        );
        Route::post('/category/{categoryId}', 'AdminPanel\AdminController@updateCategory')->name(
            'admin.editCategory'
        );

        //customers
        Route::get('/customers', 'AdminPanel\AdminController@getCustomers')->name(
            'admin.customers'
        );
        Route::get('/customer/{id}', 'AdminPanel\AdminController@getCustomer')->name(
            'admin.customer'
        );
        Route::post('/customer/{id}', 'AdminPanel\AdminController@updateCustomer')->name(
            'admin.updateCustomer'
        );
        Route::get('/customer_orders/{customerId}', 'AdminPanel\AdminController@getCustomerOrders')->name(
            'admin.customerOrders'
        );

        //settings
        Route::group(['prefix' => '/settings'], function (){
            Route::get('', 'AdminPanel\AdminController@showSettings')->name(
                'admin.settings'
            );

            //delivery
            Route::get('/delivery', 'AdminPanel\AdminController@getDeliveryForm')->name(
                'admin.settings.delivery'
            );

            //content
            Route::group(['prefix' => '/content'], function (){
                Route::get('', 'AdminPanel\AdminController@showSettingsContent')->name(
                    'admin.settings.content'
                );

                //banners
                Route::get('/banner/{position}', 'AdminPanel\AdminController@getBanner')->name(
                    'admin.settings.banner'
                );
                Route::post('/banner/{position}', 'AdminPanel\AdminController@updateBanner')->name(
                    'admin.settings.updateBanner'
                );

                //store info content
                Route::get('/{slug}', 'AdminPanel\AdminController@getStoreInfoForm')->name(
                    'admin.settings.storeInfo'
                );
                Route::post('/{slug}', 'AdminPanel\AdminController@updateStoreInfo')->name(
                    'admin.settings.updateStoreInfo'
                );

//                //about us
//                Route::get('/about_us', 'AdminPanel\AdminController@getAboutUsForm')->name(
//                    'admin.settings.aboutUs'
//                );
//                Route::post('/about_us', 'AdminPanel\AdminController@updateAboutUsContent')->name(
//                    'admin.settings.updateAboutUsContent'
//                );
//
//                //payment and delivery
//                Route::get('/payment_and_delivery', 'AdminPanel\AdminController@getPaymentAndDeliveryForm')->name(
//                    'admin.settings.deliveryAndPayment'
//                );
//                Route::post('/payment_and_delivery', 'AdminPanel\AdminController@updatePaymentAndDeliveryContent')->name(
//                    'admin.settings.updatePaymentAndDeliveryContent'
//                );
//
//                //purchase returns
//                Route::get('/purchase_returns', 'AdminPanel\AdminController@getPurchaseReturnsForm')->name(
//                    'admin.settings.purchaseReturns'
//                );
//                Route::post('/purchase_returns', 'AdminPanel\AdminController@updatePurchaseReturnsContent')->name(
//                    'admin.settings.updatePurchaseReturns'
//                );
//
//                //howToMakeAnOrder
//                Route::get('/how_to_make_an_order', 'AdminPanel\AdminController@getHowToMakeAnOrderForm')->name(
//                    'admin.settings.howToMakeAnOrder'
//                );
//                Route::post('/how_to_make_an_order', 'AdminPanel\AdminController@updateHowToMakeAnOrderContent')->name(
//                    'admin.settings.updateHowToMakeAnOrder'
//                );
//
//                //loyalty program
//                Route::get('/loyalty_program', 'AdminPanel\AdminController@getLoyaltyProgramForm')->name(
//                    'admin.settings.loyaltyProgram'
//                );
//                Route::post('/loyalty_program', 'AdminPanel\AdminController@updateLoyaltyProgramContent')->name(
//                    'admin.settings.updateLoyaltyProgram'
//                );
//
//                //contacts
//                Route::get('/contacts', 'AdminPanel\AdminController@getContactsForm')->name(
//                    'admin.settings.contacts'
//                );
//                Route::post('/contacts', 'AdminPanel\AdminController@updateContactsContent')->name(
//                    'admin.settings.updateContacts'
//                );
//
//                //wholesales
//                Route::get('/wholesales', 'AdminPanel\AdminController@getWholesalesForm')->name(
//                    'admin.settings.wholesales'
//                );
//                Route::post('/wholesales', 'AdminPanel\AdminController@updateWholesalesContent')->name(
//                    'admin.settings.updateWholesales'
//                );

            });

        });
    }
);


Route::get('/preorder_form', 'HomeController@getPreorderForm')->name('getRequestForm');
Route::post('/create_preorder', 'HomeController@createPreorder')->name('createPreorder');
Route::post('/create_comment', 'HomeController@createComment')->name('createComment');
Route::get('/coming_soon', 'HomeController@getComingSoonProducts')->name('getComingSoonProducts');
Route::get('/sales', 'HomeController@getSalesProducts')->name('getSalesProducts');
Route::get('/reviews', 'HomeController@getReviews')->name('getReviews');

Route::group(
    ['prefix' => '/cabinet', 'middleware' => 'auth'],
    function () {
        Route::get('/orders', 'CustomerCabinet\CabinetController@getOrders')->name('ordersHistory');
        Route::get('/form_for_update', 'CustomerCabinet\CabinetController@getFormForUpdateUserData')->name(
            'getFormForUpdateUserData'
        );
        Route::post('/update_data', 'CustomerCabinet\CabinetController@updateUserData')->name('updateUserData');
        Route::get('/change_password', 'CustomerCabinet\CabinetController@getFormForChangePassword')->name(
            'changePasswordForm'
        );
        Route::post('/change_password', 'CustomerCabinet\CabinetController@changeUserPassword')->name('changePassword');
        Route::get('/bonus', 'CustomerCabinet\CabinetController@getBonus')->name('bonusHistory');
    }
);

Route::post('/search', 'SearchController@search')->name('search');

Route::get('wishlist', 'WishListController@get')->name('wishList');

Route::get('/{slug}', 'HomeController@getStoreInfo')->name('getStoreInfo');

//Route::get('about_us', 'HomeController@getAboutUs')->name('aboutUs');
//
//Route::get('payment_and_delivery', 'HomeController@getPaymentAndDelivery')->name('paymentAndDelivery');
//
//Route::get('purchase_returns', 'HomeController@getPurchaseReturns')->name('purchaseReturns');
//
//Route::get('how_to_make_an_order', 'HomeController@getHowToMakeAnOrder')->name('howToMakeAnOrder');
//
//Route::get('loyalty_program', 'HomeController@getLoyaltyProgram')->name('loyaltyProgram');
//
//Route::get('contacts', 'HomeController@getContacts')->name('contacts');
//
//Route::get('wholesales', 'HomeController@getWholesales')->name('wholesales');

Route::get('basket', 'BasketController@getBasket')->name('basket');

Route::get('/login', 'HomeController@index')->name('login')->middleware('showLoginForm');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'HomeController@index')->name('home');

Route::group(
    ['prefix' => '{category}'],
    function () {
        Route::get('/', 'HomeController@getCategoryProducts')->name('category');

        Route::get('/{product}', 'HomeController@getProductPage')->name('product');
    }
);

Route::post('/add_to_basket', 'BasketController@addOrDelete')->name('addToBasket');

Route::post('/change_count', 'BasketController@changeCount')->name('changeCount');

Route::post('/get_delivery_price', 'BasketController@getDeliveryPrice')->name('getDeliveryPrice');

Route::post('/create_order', 'OrderController@createOrder')->middleware(['checkOnCreateDoubleOrder', 'inStock'])->name('createOrder');

Route::post('/add_to_wishlist', 'WishListController@addOrDelete')->name('addToWishList');

