<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function posts() {
        return $this->belongsToMany('App\Post', 'transaction_details');
    }

}
