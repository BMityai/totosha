<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'number',
        'user_id',
        'name',
        'surname',
        'phone',
        'email',
        'region_id',
        'district',
        'city',
        'street',
        'building',
        'apartment',
        'delivery_type_id',
        'payment_form_id',
        'comment',
        'order_status_id',
        'received_bonus',
        'spent_bonus',
        'is_paid'
    ];
    //
}
