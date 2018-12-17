<?php

use Illuminate\Database\Seeder;

use App\Brand;
use App\User;

class CategorySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->newCategory('Landscape');
        $this->newCategory('Abstract');
        $this->newCategory('Futuristic');
        $this->newCategory('Potrait');
        $this->newCategory('Still');

        $users = User::all();
        Brand::all()->each(function($category) use($users) {
            $category->followedBy()->attach(
                $users->random(random_int(0, 5))->pluck('id')->toArray()
            );
        });
    }

    private function newCategory(string $name) {
        $category = new Brand();
        $category->name = $name;
        $category->save();
    }
}
