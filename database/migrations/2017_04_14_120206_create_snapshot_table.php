<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSnapshotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snapshot', function (Blueprint $table) {
            $table->increments('num');
            $table->string('snapshotType');
            $table->string('snapshotName');
            $table->string('uploadName');
            $table->integer('cameraNum');
            $table->integer('targetNum');
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
        Schema::dropIfExists('snapshot');
    }
}
