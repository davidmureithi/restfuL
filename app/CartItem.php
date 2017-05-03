<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    public function cart(){
        return $this->belongsTo('App\Cart');
    }

    // TODO Change from hasOne to hasMany
    public function products(){
        return $this->hasOne('App\Product', 'id', 'product_id');
    }
}