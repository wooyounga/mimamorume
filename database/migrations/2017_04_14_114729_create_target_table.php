<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target', function (Blueprint $table) {
            $table->increments('num');
            $table->string('name', 20);
            $table->string('profile_image', 70);
            $table->integer('age');
            $table->string('gender', 10);
            $table->string('telephone', 20);
            $table->string('cellphone', 20);
            $table->string('zip_code', 10);
            $table->string('main_address', 50);
            $table->string('rest_address', 50);
            $table->string('latitude', 20)->nullable();
            $table->string('longitude', 20)->nullable();
            $table->string('disability_main', 20);
            $table->string('disability_sub', 20)->nullable();
            $table->string('comment', 100)->nullable();
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
        Schema::dropIfExists('target');
    }
}
