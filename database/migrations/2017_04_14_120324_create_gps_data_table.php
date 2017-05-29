<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGpsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gps_data', function (Blueprint $table) {
            $table->increments('num');
            $table->string('latitude', 20);
            $table->string('longitude', 20);
            $table->integer('target_num')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('gps_data');
    }
}
