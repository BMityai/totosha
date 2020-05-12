<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'cost_price',
        'price',
        'discount',
        'discount_price',
        'category_id',
        'subcategory_id',
        'art_no',
        'count',
        'sales_count',
        'note',
        'description',
        'recommended',
        'new',
        'coming_soon',
        'is_active',
        'height',
        'width',
        'depth',
        'material',
        'manufacturer',
        'age'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function basketProducts()
    {
        return $this->hasMany(Basket::class);
    }

    public function getIfInTheBasket()
    {
        if (Auth::check()) {
            return $this->basketProducts()->where('user_id', Auth::user()->id);
        }
        return $this->basketProducts()->where('session_id', session()->getId());
    }
}
