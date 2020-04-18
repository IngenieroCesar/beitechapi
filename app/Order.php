<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['total'];

    //Creamos nuestra relación con el modelo User
    public function user(){
        return $this->belongsTo(User::class);
    }

}
