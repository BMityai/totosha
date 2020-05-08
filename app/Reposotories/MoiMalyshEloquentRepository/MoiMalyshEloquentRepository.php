<?php

namespace App\Reposotories\MoiMalyshEloquentRepository;

use App\Category;
use App\Product;

class MoiMalyshEloquentRepository implements MoiMalyshEloquentRepositoryInterface
{
    public function getActiveCategoryBySlug($slug)
    {
        return Category::where('slug', $slug)->where('is_active', true)->first();
    }

    public function getAllActiveCategories()
    {
        return Category::where('is_active', true)->get();
    }

    public function getActiveNewProducts()
    {
        return Product::where('is_active', true)->where('new', true)->get();
    }

    public function getActiveRecommendedProducts()
    {
        return Product::where('is_active', true)->where('recommended', true)->get();
    }

    public function getActiveProductBySlug($slug)
    {
        return Product::where('is_active', true)->where('slug', $slug)->first();
    }

}
