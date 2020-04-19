<?php

namespace App;
use App\Order;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $fillable = [
        'description', 'price', 'quantity'
    ];

    //Creamos nuestra relación con el modelo User
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
