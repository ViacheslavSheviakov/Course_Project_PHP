<?php

use Illuminate\Database\Seeder;

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
        'CuratorId' => '5',
    ]);
    }
}
