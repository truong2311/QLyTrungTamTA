<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblChamcong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_chamcong', function (Blueprint $table) {
            $table->Increments('chamcong_id');
            $table->integer('teacher_id');
            $table->string('teacher_chamcong');
            $table->integer('teacher_number');
            $table->integer('teacher_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_chamcong');
    }
}
