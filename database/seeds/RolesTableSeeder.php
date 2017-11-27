<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name         = 'Admin';
        $admin->display_name = 'Admin'; // optional
        $admin->description  = 'Admin'; // optional
        $admin->save();

        $professor = new Role();
        $professor->name         = 'Professor';
        $professor->display_name = 'Professor'; // optional
        $professor->description  = 'Professor'; // optional
        $professor->save();

        $student = new Role();
        $student->name         = 'Student';
        $student->display_name = 'Student'; // optional
        $student->description  = 'Student'; // optional
        $student->save();
    }
}
