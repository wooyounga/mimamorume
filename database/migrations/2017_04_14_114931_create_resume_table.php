<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume', function (Blueprint $table) {
            $table->increments('num');
            $table->string('profile_image', 70);
            $table->string('license', 20);
            $table->string('sitter_id', 20);
            $table->string('center', 20);
            $table->string('career', 50)->nullable();
            $table->timestamps();

            $table->foreign('sitter_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resume');
    }
}
