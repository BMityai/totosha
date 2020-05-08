<?php

namespace App\Providers;

use App\Reposotories\MoiMalyshEloquentRepository\MoiMalyshEloquentRepository;
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
        $moiMalysgDbRepository = new MoiMalyshEloquentRepository();
        $categories = $moiMalysgDbRepository->getAllActiveCategories();
        view()->share('categories', $categories);
    }
}
