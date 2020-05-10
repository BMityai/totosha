<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $fillable = ['session_id', 'user_id', 'product_id', 'count'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
