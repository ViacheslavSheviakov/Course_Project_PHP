<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->id = 1;
        $user->name = 'Admin';
        $user->email = 'admin@gmail.com';
        $user->password = 'admin';
        $user->save();

        $user->roles()->attach(Role::all()->where('name', 'Admin')->first()->id);
    }
}
