<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'cost_price',
        'price',
        'discount',
        'discount_price',
        'art_no',
        'count',
    ];
    //
}
