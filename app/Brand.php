<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    
    public function posts() {
        return $this->hasMany('App\Post', 'post_category_details');
    }

    public function followedBy() {
        return $this->belongsToMany('App\User', 'follow_categories');
    }

}
