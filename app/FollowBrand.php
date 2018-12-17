<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowBrand extends Model
{

    protected $fillable = [
        'brand_id'
    ];
    
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function brand() {
        return $this->belongsTo('App\Brand');
    }

}
