<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('subject_matter_id');
            $table->foreign('subject_matter_id')->references('id')->on('subject_matters')->onDelete('cascade');
            $table->unsignedInteger('professor_id');
            $table->foreign('professor_id')->references('id')->on('professors')->onDelete('cascade');
            // $table->unsignedInteger('management_id');
            // $table->foreign('management_id')->references('id')->on('managements')->onDelete('cascade');
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
        Schema::dropIfExists('groups');
    }
}
