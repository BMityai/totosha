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
        'is_paid',
        'total_sum',
        'delivery_price'
    ];

    protected $with = ['status', 'region', 'deliveryType', 'paymentForm'];

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function deliveryType()
    {
        return $this->belongsTo(DeliveryType::class);
    }

    public function paymentForm()
    {
        return $this->belongsTo(PaymentForm::class);
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
}
