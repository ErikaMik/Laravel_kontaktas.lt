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

    //Vietoj id paduodam slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function attributeSet()
    {
        return $this->hasOne('App\Attribute_set', 'id', 'attribute_set_id' );
    }


}
