<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attributes_set_relations extends Model
{
    public function attributes()
    {
        return $this->hasOne('App\Attributes', 'id', 'attribute_id');
    }
}
