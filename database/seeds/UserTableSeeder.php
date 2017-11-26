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
        // Admin
        $user = new User();
        $user->id = 1;
        $user->name = 'Admin';
        $user->email = 'admin@gmail.com';
        $user->password = 'admin';
        $user->save();

        $user->roles()->attach(Role::all()->where('name', 'Admin')->first()->id);

        // Students
        $user = new User();
        $user->id = 2;
        $user->name = 'Белкин Василий';
        $user->email = 'belkin@gmail.com';
        $user->password = '123456';
        $user->save();

        $user->roles()->attach(Role::all()->where('name', 'Student')->first()->id);

        $user = new User();
        $user->id = 3;
        $user->name = 'Смит Джон';
        $user->email = 'smith@gmail.com';
        $user->password = '123456';
        $user->save();

        $user->roles()->attach(Role::all()->where('name', 'Student')->first()->id);

        $user = new User();
        $user->id = 4;
        $user->name = 'Кузнецов Дмитрий';
        $user->email = 'kuznetsov@gmail.com';
        $user->password = '123456';
        $user->save();

        $user->roles()->attach(Role::all()->where('name', 'Student')->first()->id);

        // Professors
        $user = new User();
        $user->id = 5;
        $user->name = 'Иванов Иван';
        $user->email = 'ivanov@gmail.com';
        $user->password = 'teacher';
        $user->save();

        $user->roles()->attach(Role::all()->where('name', 'Professor')->first()->id);

        $user = new User();
        $user->id = 6;
        $user->name = 'Сидоров Василий';
        $user->email = 'sidorov@gmail.com';
        $user->password = 'teacher';
        $user->save();

        $user->roles()->attach(Role::all()->where('name', 'Professor')->first()->id);

        $user = new User();
        $user->id = 7;
        $user->name = 'Бирюков Богдан';
        $user->email = 'biryukov@gmail.com';
        $user->password = 'teacher';
        $user->save();

        $user->roles()->attach(Role::all()->where('name', 'Professor')->first()->id);
    }
}
