<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Master
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        
        // ----
        $this->call(PostSeeder::class);

        $this->call(TransactionSeeder::class);
    }
}
