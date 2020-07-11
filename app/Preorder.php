<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preorder extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'product_name', 'product_link', 'product_description'];
    //
}
