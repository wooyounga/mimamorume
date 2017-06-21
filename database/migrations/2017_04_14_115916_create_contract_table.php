<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract', function (Blueprint $table) {
            $table->string('family_id', 20);
            $table->string('sitter_id', 20);
            $table->string('work_week', 20);
            $table->string('work_start', 20);
            $table->string('work_end', 20);
            $table->string('work_start_time', 20);
            $table->string('work_end_time', 20);
            $table->timestamps();

            $table->foreign('family_id')->references('id')->on('user');
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
        Schema::dropIfExists('contract');
    }
}
