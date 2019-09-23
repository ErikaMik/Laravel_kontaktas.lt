<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function adverts(){
    return $this->hasMany('App\Advert', 'category_id', 'id')->active();
    }

    public function subCategory(){
        return $this->hasMany('App\Category', 'parent_id', 'id');
    }

    public function subCategories(){
        return $this->hasMany('App\Category', 'parent_id','id')->active();
    }

    public function parent(){
        return $this->belongsTo('\App\Category', 'parent_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeParents($query)
    {
        return $query->where('parent_id', 0);
    }
}
