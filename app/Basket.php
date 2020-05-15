<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Basket extends Model
{
    protected $fillable = ['session_id', 'user_id', 'product_id', 'count'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function totalSum(){
        if(Auth::check()){
            $products = $this->where('user_id', Auth::user()->id)->get();
        } else {
            $products = $this->where('session_id', session()->getId())->get();
        }

        $totalSum = ['summ' => 0, 'discountSumm' => 0];

        foreach ($products as $product){
            $totalSum['summ'] += (int)$product->price;
            $totalSum['discountSumm'] += (int)$product->discount_price;
        }

        return $totalSum;
    }
}
