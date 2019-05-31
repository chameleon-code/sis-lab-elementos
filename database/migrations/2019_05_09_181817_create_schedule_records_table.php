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
        Schema::create('schedule_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('laboratory_id');
            $table->foreign('laboratory_id')->references('id')->on('laboratories');
            $table->unsignedInteger('day_id');
            $table->foreign('day_id')->references('id')->on('days');
            $table->unsignedInteger('hour_id');
            $table->foreign('hour_id')->references('id')->on('hours');
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
        Schema::dropIfExists('schedules_record');
    }
}
