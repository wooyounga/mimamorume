<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->string('id')->unique()->primary();
            $table->string('userType');
            $table->string('pw');
            $table->string('name');
            $table->string('age');
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('telephone')->unique();
            $table->string('cellphone')->unique();
            $table->string('adressCity');
            $table->string('adressGu');
            $table->string('adressDong');
            $table->string('adressRest');
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
        Schema::dropIfExists('user');
    }
}
