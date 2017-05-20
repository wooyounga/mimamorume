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
            $table->string('id', 20)->unique()->primary();
            $table->string('user_type', 10);
            $table->string('pw', 20);
            $table->string('name', 20);
            $table->integer('age');
            $table->string('gender', 10);
            $table->string('email', 20)->unique();
            $table->string('telephone', 20)->unique();
            $table->string('cellphone', 20)->unique();
            $table->string('adress_city', 10);
            $table->string('adress_gu', 10);
            $table->string('adress_dong', 10);
            $table->string('adress_rest', 30);
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
