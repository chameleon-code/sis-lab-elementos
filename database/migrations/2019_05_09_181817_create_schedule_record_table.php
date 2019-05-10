<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('laboratory_id');
            $table->foreign('laboratory_id')->references('id')->on('laboratory')->onDelete('cascade');
            $table->unsignedInteger('day_id');
            $table->foreign('day_id')->references('id')->on('day')->onDelete('cascade');
            $table->unsignedInteger('hour_id');
            $table->foreign('hour_id')->references('id')->on('hour')->onDelete('cascade');
            $table->boolean('availability');
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
        Schema::dropIfExists('schedule_record');
    }
}
