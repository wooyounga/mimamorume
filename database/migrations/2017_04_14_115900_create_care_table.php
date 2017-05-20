<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('care', function (Blueprint $table) {
            $table->string('sitter_id', 20);
            $table->integer('target_num')->unsigned();
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
        Schema::dropIfExists('care');
    }
}
