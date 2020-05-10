<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
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
        if(Auth::check()){
            return $this->basketProducts()->where('user_id', Auth::user()->id);
        }
        return $this->basketProducts()->where('session_id', session()->getId());
    }
}
