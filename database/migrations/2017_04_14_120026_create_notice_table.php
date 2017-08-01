<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice', function (Blueprint $table) {
            $table->increments('num');
            $table->integer('target_num')->nullable()->unsigned();
            $table->string('addressee_id', 20);
            $table->string('sender', 20)->nullable();
            $table->string('work_week')->nullable();
            $table->string('work_start')->nullable();
            $table->string('work_end')->nullable();
            $table->string('work_start_time')->nullable();
            $table->string('work_end_time')->nullable();
            $table->string('notice_kind', 10);
            $table->string('notice_title', 100);
            $table->string('notice_content', 100)->nullable();
            $table->string('notice_check', 100)->nullable();
            $table->timestamps();

            $table->foreign('target_num')->references('num')->on('target');
            $table->foreign('addressee_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice');
    }
}
