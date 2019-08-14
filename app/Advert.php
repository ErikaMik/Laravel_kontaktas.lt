<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    public function category(){
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function comment(){
        return $this->hasMany('App\Comment', 'advert_id', 'id');
    }

    public function city(){
        return $this->hasOne('App\City', 'id', 'city_id');
    }

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
