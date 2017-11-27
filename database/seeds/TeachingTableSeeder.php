<?php

use Illuminate\Database\Seeder;

class TeachingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teaching')->insert([
            'ProfessorId' => 5,
            'SubjectShortTitle' => 'ОПр',
        ]);
        DB::table('teaching')->insert([
            'ProfessorId' => 5,
            'SubjectShortTitle' => 'ООП',
        ]);
        DB::table('teaching')->insert([
            'ProfessorId' => 5,
            'SubjectShortTitle' => 'БД',
        ]);
        DB::table('teaching')->insert([
            'ProfessorId' => 6,
            'SubjectShortTitle' => 'ВМ',
        ]);
        DB::table('teaching')->insert([
            'ProfessorId' => 7,
            'SubjectShortTitle' => 'ВдITб',
        ]);
    }
}
