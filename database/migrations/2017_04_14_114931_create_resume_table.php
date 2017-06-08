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
            $table->string('sitter_id', 20);
            $table->string('license', 20);
            $table->string('center', 20);
            $table->string('career', 50)->nullable();
            $table->string('profile_image', 20);
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
