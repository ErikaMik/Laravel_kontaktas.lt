<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public function advert(){
        return $this->hasOne('App\Advert', 'id', 'advert_id');
}

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}
