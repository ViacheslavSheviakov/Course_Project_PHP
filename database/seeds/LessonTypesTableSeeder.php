<?php

use Illuminate\Database\Seeder;

class LessonTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lesson_types')->insert([
            'TypeShortTitle' => 'ЛК',
            'TypeFullTitle' => 'Лекция',
        ]);
        DB::table('lesson_types')->insert([
            'TypeShortTitle' => 'ПЗ',
            'TypeFullTitle' => 'Практическое занятие',
        ]);
        DB::table('lesson_types')->insert([
            'TypeShortTitle' => 'ЛБ',
            'TypeFullTitle' => 'Лабораторная работа',
        ]);
        DB::table('lesson_types')->insert([
            'TypeShortTitle' => 'КОНС',
            'TypeFullTitle' => 'Консультация',
        ]);
        DB::table('lesson_types')->insert([
            'TypeShortTitle' => 'КУРС',
            'TypeFullTitle' => 'Курсовая работа',
        ]);
        DB::table('lesson_types')->insert([
            'TypeShortTitle' => 'ЭКЗ',
            'TypeFullTitle' => 'Экзамен',
        ]);
    }
}