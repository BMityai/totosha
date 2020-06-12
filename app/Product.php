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
        'material_id',
        'manufacturer_id',
        'age_id'
    ];

    protected $with = ['category', 'getIfInTheBasket', 'getIfInTheWishList'];

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

    public function wishList()
    {
        return $this->hasMany(WishList::class);
    }

    public function getIfInTheWishList()
    {
        if (Auth::check()) {
            return $this->wishList()->where('user_id', Auth::user()->id);
        }
        return $this->wishList()->where('session_id', session()->getId());
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->orderBy('created_at', 'DESC');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function age()
    {
        return $this->belongsTo(Age::class);
    }

}
