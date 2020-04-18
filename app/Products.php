<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Products extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'price',
    ];

    //Creamos nuestra relación con el modelo User "Muchos a muchos"
    public function user()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
