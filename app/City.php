<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function advert(){
        return $this->hasMany('App\Advert', 'city_id', 'id');
    }

    public function user(){
        return $this->hasMany('App\User', 'city_id', 'id');
    }
}
