<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute_types extends Model
{
    public function attribute()
    {
        return $this->hasOne('App\Attributes', 'type_id', 'id');
    }
}
