<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    public function comments() {
        return $this->belongsToMany('App\User', 'post_comments')->withPivot('comment');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function brand() {
        return $this->belongsTo('App\Brand');
    }

    public function transactions() {
        return $this->belongsToMany('App\Transaction', 'transaction_details');
    }

}
