<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poster', function (Blueprint $table) {
            $table->increments('num');
            $table->integer('target_num')->unsigned();
            $table->integer('snapshot_num')->unsigned();
            $table->string('clothes');
            $table->string('other');
            $table->timestamps();

            $table->foreign('target_num')->references('num')->on('target');
            $table->foreign('snapshot_num')->references('num')->on('snapshot');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poster');
    }
}
