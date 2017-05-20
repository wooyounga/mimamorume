<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVitalDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vital_data', function (Blueprint $table) {
            $table->increments('num');
            $table->string('data_type', 20);
            $table->integer('target_num')->unsigned();
            $table->string('value', 30);
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
        Schema::dropIfExists('vital_data');
    }
}
