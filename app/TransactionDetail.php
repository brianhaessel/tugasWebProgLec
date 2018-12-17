<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    
    public function transaction() {
        return $this->belongsTo('App\Transaction');
    }

    public function post() {
        return $this->belongsTo('App\Post');
    }

}
