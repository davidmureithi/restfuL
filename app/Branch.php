<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public function pickup(){
        return $this->hasMany('App\PickUp');
    }
}
