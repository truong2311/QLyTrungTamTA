<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblClassonline extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_classonline', function (Blueprint $table) {
            $table->Increments('classonline_id');
            $table->string('online_name');
            $table->string('online_phone');
            $table->string('online_email');
            $table->integer('class_id');
            $table->integer('coursesE_id');
            $table->integer('online_status');
            $table->string('online_desc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_classonline');
    }
}
