<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCollect extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_collect', function (Blueprint $table) {
            $table->Increments('collect_id');
            $table->string('coursesE_title');
            $table->string('class_name');
            $table->string('coursesE_tuition');
            $table->string('collect_day');
            $table->integer('student_id');
            $table->integer('collect_promotion');
            $table->integer('collect_moneynap');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_collect');
    }
}
