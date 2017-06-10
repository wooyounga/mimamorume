<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('medicine_schedule', function (Blueprint $table) {
             $table->increments('num');
             $table->integer('log_num')->unsigned();
             $table->string('medicine_name', 20);
             $table->date('start_date');
             $table->date('end_date');
             $table->string('time');
             $table->timestamps();

             $table->foreign('log_num')->references('num')->on('work_log');
         });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
         Schema::dropIfExists('medicine_schedule');
     }
}
