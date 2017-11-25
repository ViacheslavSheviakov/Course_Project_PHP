<?php

use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->insert([
            'RecordBookId' => 2,
            'ScheduleId' => 1,
            'Grade' => '100',
        ]);
        DB::table('grades')->insert([
            'RecordBookId' => 2,
            'ScheduleId' => 2,
            'Grade' => '80',
        ]);
        DB::table('grades')->insert([
            'RecordBookId' => 2,
            'ScheduleId' => 3,
            'Grade' => '90',
        ]);
        DB::table('grades')->insert([
            'RecordBookId' => 3,
            'ScheduleId' => 2,
            'Grade' => '75',
        ]);
        DB::table('grades')->insert([
            'RecordBookId' => 3,
            'ScheduleId' => 3,
            'Grade' => '80',
        ]);
    }
}
