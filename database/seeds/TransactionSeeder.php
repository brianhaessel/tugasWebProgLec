<?php

use Illuminate\Database\Seeder;

use App\Transaction;
use App\Post;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Transaction::class, 20)->create();

        $posts = Post::all();

        Transaction::all()->each(function($transaction) use($posts) {
            $transaction->posts()->attach(
                $posts->random(random_int(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
