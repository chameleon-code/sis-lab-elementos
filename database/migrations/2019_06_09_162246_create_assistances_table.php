<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistances', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('blockschedule_id');
            $table->foreign('blockschedule_id')->references('id')->on('block_schedules');
            $table->unsignedInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->unsignedInteger('sesion_id');
            $table->foreign('sesion_id')->references('id')->on('sesions');
            $table->boolean('attend');
            $table->date('day')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assistances');
    }
}
