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
            $table->string('pw', 70);
            $table->string('name', 20);
            $table->integer('age');
            $table->string('gender', 10);
            $table->string('email', 30);
            $table->string('telephone', 20);
            $table->string('cellphone', 20);
            $table->string('zip_code', 10);
            $table->string('main_address', 50);
            $table->string('rest_address', 50);
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
