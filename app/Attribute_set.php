<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute_set extends Model
{
    public function relations()
    {
        return $this->hasMany('App\Attributes_set_relations', 'attribute_set_id', 'id');
    }

}
