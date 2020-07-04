<?php

namespace App;

use App\Notifications\EmailNotification;
use App\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'mail', 'bonus', 'birth_date', 'password','is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['WishListProducts', 'BasketProducts', 'Orders'];

    public function Orders()
    {
        return $this->hasMany(Order::class);
    }

    public function BasketProducts()
    {
        return $this->hasMany(Basket::class);
    }

    public function WishListProducts()
    {
        return $this->hasMany(WishList::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailNotification());
    }
}
