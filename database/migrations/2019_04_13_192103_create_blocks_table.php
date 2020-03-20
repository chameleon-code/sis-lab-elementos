<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('management_id');
            $table->foreign('management_id')->references('id')->on('managements')->onDelete('cascade');
            $table->string('name');
            $table->boolean('available')->default(true);
            $table->string('block_path')->nullable();
            $table->timestamps();
        });

        // Schema::create('students', function (Blueprint $table){
        //     $table->increments('id');
        //     $table->unsignedInteger('user_id');
        //     $table->foreign('user_id')->references('id')->on('users');
        //     $table->timestamps();
        //     $table->Integer('ci');
        //     $table->unsignedInteger('block_id')->nullable();
        //     $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');
        //     $table->unsignedInteger('group_id')->nullable();
        //     $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        //     $table->string('student_path')->nullable();
        // });

        Schema::create('auxiliars', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('block_id')->nullable();
            $table->foreign('block_id')->references('id')->on('blocks');
            $table->string('type')->nullable();
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
        Schema::dropIfExists('auxiliars');
        Schema::dropIfExists('blocks');
    }
}
