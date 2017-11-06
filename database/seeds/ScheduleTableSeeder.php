<?php

use Illuminate\Database\Seeder;

class ScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedule')->insert([
            'GroupShortTitle' => 'SSE-16-2',
            'TeachingId' => 1,
            'LessonType' => 'ЛК',
            'LessonDate' => \Carbon\Carbon::parse('2017-11-10'),
            'LessonNumber' => '1',
        ]);
        DB::table('schedule')->insert([
            'GroupShortTitle' => 'SSE-16-2',
            'TeachingId' => 1,
            'LessonType' => 'ЛК',
            'LessonDate' => \Carbon\Carbon::parse('2017-11-10'),
            'LessonNumber' => '2',
        ]);
        DB::table('schedule')->insert([
            'GroupShortTitle' => 'SSE-16-2',
            'TeachingId' => 2,
            'LessonType' => 'ПЗ',
            'LessonDate' => \Carbon\Carbon::parse('2017-11-10'),
            'LessonNumber' => '3',
        ]);
    }
}
