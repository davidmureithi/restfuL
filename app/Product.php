<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function products(){
        return $this->hasOne('App\CartItem');
    }

    public function orders(){
        return $this->hasOne('App\OrderItem');
    }
}