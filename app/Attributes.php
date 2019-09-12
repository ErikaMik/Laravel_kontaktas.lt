<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    public function type()
    {
        return $this->hasOne('App\Attribute_types', 'id', 'type_id');
    }

    public function value()
    {
        return $this->hasOne('App\Attribute_values', 'attribute_id', 'id');
    }
}
