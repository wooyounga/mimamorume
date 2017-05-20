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
            $table->string('profile_image', 20);
            $table->integer('age');
            $table->string('gender', 10);
            $table->string('telephone', 20)->unique();
            $table->string('cellphone', 20)->unique();
            $table->string('adress_city', 10);
            $table->string('adress_gu', 10);
            $table->string('adress_dong', 10);
            $table->string('adress_rest', 30);
            $table->string('latitude', 20);
            $table->string('longitude', 20);
            $table->string('disability_main', 20)->nullable();
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
