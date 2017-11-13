<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('RecordBookId');
            $table->string('Surname');
            $table->string('Name');
            $table->string('Patronymic');
            $table->string('GroupShortTitle');
            $table->date('EnteringDate');

            $table->foreign('GroupShortTitle')->references('GroupShortTitle')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
