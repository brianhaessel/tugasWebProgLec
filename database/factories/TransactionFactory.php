<?php

use Faker\Generator as Faker;

use App\User;

$factory->define(App\Transaction::class, function (Faker $faker) {
    $users = User::all();
    return [
        'user_id' => random_int(1, $users->count()),
        'transaction_date' => Carbon\Carbon::now()
    ];
});
