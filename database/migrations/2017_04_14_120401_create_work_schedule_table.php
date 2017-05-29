<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_schedule', function (Blueprint $table) {
            $table->increments('num');
            $table->string('sitter_id', 20);
            $table->integer('target_num')->unsigned();
            $table->date('work_date');
            $table->timestamps();

            $table->foreign('sitter_id')->references('id')->on('user');
            $table->foreign('target_num')->references('num')->on('target');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_schedule');
    }
}
