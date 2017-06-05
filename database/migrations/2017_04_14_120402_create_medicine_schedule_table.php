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
             $table->string('medicine_name', 20);
             $table->date('start_date');
             $table->date('end_date');
             $table->date('time');
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
         Schema::dropIfExists('medicine_schedule');
     }
}
