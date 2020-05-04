<?php


namespace App\Reposotories\MoiMalyshEloquentRepository;


use App\Category;

class MoiMalyshEloquentRepository implements MoiMalyshEloquentRepositoryInterface
{
    public function getCategoryBySlug($slug)
    {
        return Category::where('slug', $slug)->first();
    }

    public function getAllCategories()
    {
        return Category::all();
    }

}
