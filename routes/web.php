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
        Route::post('/add_category', 'AdminPanel\AdminController@addCategory')->name('admin.addCategory');
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
        Route::group(
            ['prefix' => '/settings'],
            function () {
                Route::get('', 'AdminPanel\AdminController@showSettings')->name(
                    'admin.settings'
                );

                //delivery
                Route::get('/delivery', 'AdminPanel\AdminController@getDeliveryTypes')->name(
                    'admin.settings.deliveryTypes'
                );

                Route::get('/delivery/{slug}', 'AdminPanel\AdminController@getDeliveryType')->name(
                    'admin.settings.deliveryType'
                );

                Route::post('/delivery/{slug}', 'AdminPanel\AdminController@updateDeliveryType')->name(
                    'admin.settings.updateDeliveryType'
                );


                //manufacturer
                Route::get('/manufacturers', 'AdminPanel\AdminController@getManufacturers')->name(
                    'admin.settings.manufacturers'
                );

                Route::get('/manufacturer/{id}', 'AdminPanel\AdminController@getManufacturer')->name(
                    'admin.settings.manufacturer'
                );

                Route::post('/manufacturer/{id}', 'AdminPanel\AdminController@updateManufacturer')->name(
                    'admin.settings.updateManufacturer'
                );

                Route::get('/add_manufacturer', 'AdminPanel\AdminController@getAddManufacturerForm')->name(
                    'admin.settings.getAddManufacturerForm'
                );

                Route::post('/add_manufacturer', 'AdminPanel\AdminController@addManufacturer')->name(
                    'admin.settings.addManufacturer'
                );

                //material
                Route::get('/materials', 'AdminPanel\AdminController@getMaterials')->name(
                    'admin.settings.materials'
                );

                Route::get('/material/{id}', 'AdminPanel\AdminController@getMaterial')->name(
                    'admin.settings.material'
                );

                Route::post('/material/{id}', 'AdminPanel\AdminController@updateMaterial')->name(
                    'admin.settings.updateMaterial'
                );

                Route::get('/add_material', 'AdminPanel\AdminController@getMaterialForm')->name(
                    'admin.settings.getAddMaterialForm'
                );

                Route::post('/add_material', 'AdminPanel\AdminController@addMaterial')->name(
                    'admin.settings.addMaterial'
                );

                //region
                Route::get('/regions', 'AdminPanel\AdminController@getRegions')->name(
                    'admin.settings.regions'
                );

                Route::get('/region/{id}', 'AdminPanel\AdminController@getRegion')->name(
                    'admin.settings.region'
                );

                Route::post('/region/{id}', 'AdminPanel\AdminController@updateRegion')->name(
                    'admin.settings.updateRegion'
                );

                Route::get('/add_region', 'AdminPanel\AdminController@getRegionForm')->name(
                    'admin.settings.getAddRegionForm'
                );

                Route::post('/add_region', 'AdminPanel\AdminController@addRegion')->name(
                    'admin.settings.addRegion'
                );


                //age
                Route::get('/ages', 'AdminPanel\AdminController@getAges')->name(
                    'admin.settings.ages'
                );

                Route::get('/age/{id}', 'AdminPanel\AdminController@getAge')->name(
                    'admin.settings.age'
                );

                Route::post('/age/{id}', 'AdminPanel\AdminController@updateAge')->name(
                    'admin.settings.updateAge'
                );

                Route::get('/add_age', 'AdminPanel\AdminController@getAgeForm')->name(
                    'admin.settings.getAddAgeForm'
                );

                Route::post('/add_age', 'AdminPanel\AdminController@addAge')->name(
                    'admin.settings.addAge'
                );


                //content
                Route::group(
                    ['prefix' => '/content'],
                    function () {
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
                    }
                );
            }
        );
    }
);


Route::get('/preorder_form', 'HomeController@getPreorderForm')->name('getRequestForm');
Route::post('/create_preorder', 'HomeController@createPreorder')->name('createPreorder');
Route::post('/create_comment', 'HomeController@createComment')->name('createComment');
Route::post('/create_admin_comment/{reviewId}', 'HomeController@createAdminComment')->name('adminComment')->middleware('isAdmin');
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

Route::get('/info/{slug}', 'HomeController@getStoreInfo')->name('getStoreInfo');

Route::get('/cart', 'BasketController@getBasket')->name('basket');

Route::get('/checkout', 'BasketController@getCheckout')->name('checkout');

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

Route::post('/create_order', 'OrderController@createOrder')->middleware(['checkOnCreateDoubleOrder', 'inStock'])->name(
    'createOrder'
);

Route::post('/add_to_wishlist', 'WishListController@addOrDelete')->name('addToWishList');

