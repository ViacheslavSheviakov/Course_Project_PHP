<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->increments('ScheduleId');
            $table->string('GroupShortTitle');
            $table->integer('TeachingId')->unsigned();
            $table->string('LessonType');
            $table->date('LessonDate');
            $table->integer('LessonNumber');

            $table->foreign('GroupShortTitle')->references('GroupShortTitle')->on('groups');
            $table->foreign('TeachingId')->references('TeachingId')->on('teaching');
            $table->foreign('LessonType')->references('TypeShortTitle')->on('lesson_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule');
    }
}
