<?php

use Illuminate\Database\Seeder;

use App\Post;
use App\Brand;
use App\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class, 20)->create();

        $users = User::all();
        $faker = Faker\Factory::create();
        Post::all()->each(function ($post) use ($users, $faker) {
            $post->comments()->attach(
                random_int(1, $users->count()),
                [
                    'comment' => $faker->realText(100)
                ]
            );
        });
    }

}
