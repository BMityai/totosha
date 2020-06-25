<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['position', 'title', 'main_image', 'content_image', 'content'];
}
