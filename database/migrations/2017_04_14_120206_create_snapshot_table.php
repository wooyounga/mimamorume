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
            $table->string('snapshot_type', 20);
            $table->string('snapshot_name', 30)->unique();
            $table->string('upload_name', 30);
            $table->integer('camera_num')->unsigned();
            $table->timestamps();

            $table->foreign('camera_num')->references('num')->on('camera');
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
