<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Order;
use App\Order_detail;
use App\Product;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    //Creamos nuestra relación con el modelo Order
    public function orders(){
        return $this->hasMany(Order::class);
    }

    //Creamos nuestra relación con el modelo Order_detail, atravez de Order
    public function order_details(){
        return $this->hasManyThrough(Order_detail::class, Order::class);
    }

    //Creamos nuestra relación con el modelo Products "Muchos a muchos"
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}
