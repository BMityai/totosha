<?php

namespace App\Providers;

use App\Reposotories\MoiMalyshEloquentRepository\MoiMalyshEloquentRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
    }

    private function GetCategories()
    {
        View::composer(['layouts.header', 'category'], function ($view)
        {
            $moiMalyshDbRepository = new MoiMalyshEloquentRepository();
            $view->with('categories', $moiMalyshDbRepository->getAllActiveCategories());
        });
    }

    private function GetRecommendProducts()
    {
        View::composer(['home'], function ($view)
        {
            $moiMalyshDbRepository = new MoiMalyshEloquentRepository();
            $view->with('recommendedProducts', $moiMalyshDbRepository->getActiveRecommendedProducts());
        });
    }

    private function getCartInfo()
    {
        View::composer(['layouts.header'], function ($view)
        {
            $moiMalyshDbRepository = new MoiMalyshEloquentRepository();
            $view->with('cartInfo', $moiMalyshDbRepository->getCartInfo());
        });
    }
}
