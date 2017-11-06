<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teaching', function (Blueprint $table) {
            $table->increments('TeachingId');
            $table->integer('ProfessorId')->unsigned();
            $table->string('SubjectShortTitle');


            $table->foreign('ProfessorId')->references('ProfessorId')->on('professors');
            $table->foreign('SubjectShortTitle')->references('SubjectShortTitle')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teaching');
    }
}
