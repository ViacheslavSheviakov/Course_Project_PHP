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
            'ProfessorId' => '1',
            'SubjectShortTitle' => 'ОПр',
        ]);
        DB::table('teaching')->insert([
            'ProfessorId' => '1',
            'SubjectShortTitle' => 'ООП',
        ]);
        DB::table('teaching')->insert([
            'ProfessorId' => '1',
            'SubjectShortTitle' => 'БД',
        ]);
        DB::table('teaching')->insert([
            'ProfessorId' => '2',
            'SubjectShortTitle' => 'ВМ',
        ]);
        DB::table('teaching')->insert([
            'ProfessorId' => '3',
            'SubjectShortTitle' => 'ВдITб',
        ]);
    }
}
