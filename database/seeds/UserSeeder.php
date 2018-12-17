<?php

use Illuminate\Database\Seeder;

use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->newUser('admin', 'admin');
        $this->newUser('member', 'user');

        factory(User::class, 5)->create();
    }

    private function newUser(string $role, string $name) {
        $user = new User();

        $user->role = $role;
        $user->name = $name;
        $user->email = $name.'@yahoo.com';
        $user->password = bcrypt($name);
        $user->gender = 'Male';
        $user->profile_picture = 'sample.png';

        $user->save();
    }
}
