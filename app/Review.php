<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['name', 'product_id', 'review', 'user_id', 'admin_review'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
