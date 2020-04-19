<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price',
    ];

    //Creamos nuestra relación con el modelo User "Muchos a muchos"
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
