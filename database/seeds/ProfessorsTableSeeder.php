<?php

use Illuminate\Database\Seeder;

class ProfessorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('professors')->insert([
            'Surname' => 'Иванов',
            'Name' => 'Иван',
            'Patronymic' => 'Иванович',
        ]);
        DB::table('professors')->insert([
            'Surname' => 'Сидоров',
            'Name' => 'Василий',
            'Patronymic' => 'Петрович',
        ]);
        DB::table('professors')->insert([
            'Surname' => 'Бирюков',
            'Name' => 'Богдан',
            'Patronymic' => 'Ярославович',
        ]);
    }
}
