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
        $this->newBrand('Toyota');
        $this->newBrand('Honda');
        $this->newBrand('Ferrari');
        $this->newBrand('Mercedes-Benz');
        $this->newBrand('BMW');

        $users = User::all();
        Brand::all()->each(function($brand) use($users) {
            $brand->followedBy()->attach(
                $users->random(random_int(0, 5))->pluck('id')->toArray()
            );
        });
    }

    private function newBrand(string $name) {
        $brand = new Brand();
        $brand->name = $name;
        $brand->save();
    }
}
