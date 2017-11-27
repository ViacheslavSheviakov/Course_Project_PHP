<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->increments('GradeId');
            $table->integer('RecordBookId')->unsigned();
            $table->integer('ScheduleId')->unsigned()->nullable();;
            $table->integer('Grade');


            $table->foreign('RecordBookId')->references('RecordBookId')->on('students')->onDelete('cascade');
            $table->foreign('ScheduleId')->references('ScheduleId')->on('schedule')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
