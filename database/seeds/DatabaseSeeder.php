<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LessonTypesTableSeeder::class,
            SubjectsTableSeeder::class,
            ProfessorsTableSeeder::class,
            GroupsTableSeeder::class,
            StudentsTableSeeder::class,
            TeachingTableSeeder::class,
            ScheduleTableSeeder::class,
            GradesTableSeeder::class,
        ]);
    }
}
