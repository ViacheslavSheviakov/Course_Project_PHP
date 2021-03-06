<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'RecordBookId' => 2,
            'Surname' => 'Белкин',
            'Name' => 'Василий',
            'Patronymic' => 'Андреевич',
            'GroupShortTitle' => 'SSE-16-2',
            'EnteringDate' => \Carbon\Carbon::parse('2016-01-01'),
        ]);
        DB::table('students')->insert([
            'RecordBookId' => 3,
            'Surname' => 'Смит',
            'Name' => 'Джон',
            'Patronymic' => 'Семёнович',
            'GroupShortTitle' => 'SSE-16-2',
            'EnteringDate' => \Carbon\Carbon::parse('2016-01-01'),
        ]);
        DB::table('students')->insert([
            'RecordBookId' => 4,
            'Surname' => 'Кузнецов',
            'Name' => 'Дмитрий',
            'Patronymic' => 'Сергеевич',
            'GroupShortTitle' => 'SSE-16-2',
            'EnteringDate' => \Carbon\Carbon::parse('2016-01-01'),
        ]);
    }
}
