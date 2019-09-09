<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function type(){
        return $this->hasMany('App\Type', 'id', 'type_id');
    }

    public function scopeActive($query){
        return $query->where('active', 1);
    }
    public function scopeUnread($query){
        return $query->where('status', 1);
    }

}
