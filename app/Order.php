<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

//    public function orderItems(){
//        return $this->belongsToMany('Book', 'order_tables')->withPivot('amount','price','total');
//    }

    public function orderItems(){
        return $this->belongsToMany('Product', 'order_items')->withPivot(
            'quantity',
            'total_item_price','total_item_price_formatted',
            'total_discount_price','total_discount_price_formatted'
        );
    }
}