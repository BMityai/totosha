<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryType extends Model
{
    public function getTarif()
    {
        return $this->hasMany(KazPostTarif::class);
    }
}
