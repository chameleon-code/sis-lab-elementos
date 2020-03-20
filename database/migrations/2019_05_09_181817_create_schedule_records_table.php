<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('hours', function (Blueprint $table) {
            $table->increments('id');
            $table->time('start');
            $table->time('end');
            $table->timestamps();
        });

        Schema::create('schedule_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('laboratory_id');
            $table->foreign('laboratory_id')->references('id')->on('laboratories')->onDelete('cascade');
            $table->unsignedInteger('day_id');
            $table->foreign('day_id')->references('id')->on('days')->onDelete('cascade');
            $table->unsignedInteger('hour_id');
            $table->foreign('hour_id')->references('id')->on('hours')->onDelete('cascade');
            $table->string('professor');
            $table->string('subject');
            $table->string('color');
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
        
    }
}
