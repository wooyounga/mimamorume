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
            $table->string('name');
            $table->string('profileImage');
            $table->string('age');
            $table->string('gender');
            $table->string('telephone')->unique();
            $table->string('cellphone')->unique();
            $table->string('adressCity');
            $table->string('adressGu');
            $table->string('adressDong');
            $table->string('adressRest');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('disabilityMain');
            $table->string('disabilitySub');
            $table->string('comment');
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
