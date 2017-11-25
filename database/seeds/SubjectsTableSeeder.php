<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            'SubjectShortTitle' => 'ОПр',
            'SubjectFullTitle' => 'Основы Программирования',
            'Credits' => '5',
        ]);
        DB::table('subjects')->insert([
            'SubjectShortTitle' => 'ООП',
            'SubjectFullTitle' => 'Объектно-ориентированное Программирование',
            'Credits' => '5',
        ]);
        DB::table('subjects')->insert([
            'SubjectShortTitle' => 'БД',
            'SubjectFullTitle' => 'Базы Данных',
            'Credits' => '4',
        ]);
        DB::table('subjects')->insert([
            'SubjectShortTitle' => 'ВМ',
            'SubjectFullTitle' => 'Высшая Математика',
            'Credits' => '5',
        ]);
        DB::table('subjects')->insert([
            'SubjectShortTitle' => 'ВдITб',
            'SubjectFullTitle' => 'Введение в IT бизнес',
            'Credits' => '5',
        ]);
    }
}