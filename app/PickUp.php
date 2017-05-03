<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PickUp extends Model
{
    protected $table = 'pickup';

    public function payment()
    {
        return $this->hasMany('App\Payment');
    }

    public function branch(){
        return $this->hasOne('App\Branch');
    }
}