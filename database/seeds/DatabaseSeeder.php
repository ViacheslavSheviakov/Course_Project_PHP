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
        ]);
    }
}

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

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'GroupShortTitle' => 'SSE-16-2',
            'GroupFullTitle' => 'Software Software Engineering',
            'CuratorId' => '1',
        ]);
    }
}

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
            'Surname' => 'Белкин',
            'Name' => 'Василий',
            'Patronymic' => 'Андреевич',
            'GroupShortTitle' => 'SSE-16-2',
            'EnteringDate' => \Carbon\Carbon::parse('2016-01-01'),
        ]);
        DB::table('students')->insert([
            'Surname' => 'Смит',
            'Name' => 'Джон',
            'Patronymic' => 'Семёнович',
            'GroupShortTitle' => 'SSE-16-2',
            'EnteringDate' => \Carbon\Carbon::parse('2016-01-01'),
        ]);
        DB::table('students')->insert([
            'Surname' => 'Кузнецов',
            'Name' => 'Дмитрий',
            'Patronymic' => 'Сергеевич',
            'GroupShortTitle' => 'SSE-16-2',
            'EnteringDate' => \Carbon\Carbon::parse('2016-01-01'),
        ]);
    }
}
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
