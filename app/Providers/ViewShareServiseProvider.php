<?php

namespace App\Providers;

use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use function foo\func;

class ViewShareServiseProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->GetCategories();
        $this->GetRecommendProducts();
        $this->getCartInfo();
        $this->getStoreInfoContent();
    }

    private function GetCategories()
    {
        View::composer(
            [
                'layouts.header',
                'category',
                'searchResult',
                'comingSoon',
                'sales',
                'storeInfo',
//                'aboutUs',
//                'paymentAndDelivery',
//                'purchaseReturns',
//                'howToMakeAnOrder',
//                'loyaltyProgram',
//                'contacts',
//                'wholesales',
            ],
            function ($view) {
                $mainDbRepository = new MainEloquentRepository();
                $view->with('categories', $mainDbRepository->getAllActiveCategories());
            }
        );
    }

    private function GetRecommendProducts()
    {
        View::composer(
            ['home'],
            function ($view) {
                $mainDbRepository = new MainEloquentRepository();
                $view->with('recommendedProducts', $mainDbRepository->getActiveRecommendedProducts());
            }
        );
    }

    private function getCartInfo()
    {
        View::composer(
            ['layouts.header'],
            function ($view) {
                $mainDbRepository = new MainEloquentRepository();
                $view->with('cartInfo', $mainDbRepository->getCartInfo());
                $view->with('basket', $mainDbRepository->getCartInfo());
                $view->with('wishListInfo', count($mainDbRepository->getWishList()));
            }
        );
    }

    private function getStoreInfoContent()
    {
        View::composer(
            ['layouts.header'],
            function ($view) {
                $mainDbRepository = new MainEloquentRepository();
                $view->with('storeInfo', $mainDbRepository->getStoreInfo());
            }
        );
    }
}
