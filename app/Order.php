<?php

namespace App;
// use App\Order_detail;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['total'];

    //Creamos nuestra relación con el modelo User
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Creamos nuestra relación con el modelo Order_detail
    public function order_details(){
        return $this->hasMany(Order_detail::class);
    }

}
