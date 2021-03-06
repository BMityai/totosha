<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'image', 'mobile_image', 'slug', 'is_active', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
