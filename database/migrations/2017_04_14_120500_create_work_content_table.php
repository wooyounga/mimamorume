<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_content', function (Blueprint $table) {
            $table->increments('num');
            $table->integer('log_num')->unsigned();
            $table->string('content_type', 20);
            $table->string('content', 100);
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
        Schema::dropIfExists('work_content');
    }
}
