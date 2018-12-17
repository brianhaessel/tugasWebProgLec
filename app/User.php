<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role', 'name', 'email', 'password', 'gender', 'profile_picture'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comments() {
        return $this->belongsToMany('App\Post', 'post_comments')->withPivot('comment');
    }

    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function transactions() {
        return $this->hasMany('App\Transaction');
    }

    public function followedCategories() {
        return $this->belongsToMany('App\Brand', 'follow_categories');
    }
}
