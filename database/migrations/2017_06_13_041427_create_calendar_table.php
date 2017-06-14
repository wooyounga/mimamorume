<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar', function (Blueprint $table) {
            $table->increments('num');
            $table->string('title', 50);
            $table->string('start_year', 5);
            $table->string('start_month', 5);
            $table->string('start_day', 5);
            $table->string('start_hour', 5);
            $table->string('start_minute', 5);
            $table->string('end_year', 5);
            $table->string('end_month', 5);
            $table->string('end_day', 5);
            $table->string('end_hour', 5);
            $table->string('end_minute', 5);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar');
    }
}
