<?php

use Illuminate\Database\Seeder;

use App\Brand;
use App\User;

class BrandSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->newCategory('Toyota');
        $this->newCategory('Honda');
        $this->newCategory('Ferrari');
        $this->newCategory('Mercedes-Benz');
        $this->newCategory('BMW');

        $users = User::all();
        Brand::all()->each(function($brand) use($users) {
            $brand->followedBy()->attach(
                $users->random(random_int(0, 5))->pluck('id')->toArray()
            );
        });
    }

    private function newCategory(string $name) {
        $brand = new Brand();
        $brand->name = $name;
        $brand->save();
    }
}
