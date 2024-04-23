<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAdvise extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_advise', function (Blueprint $table) {
            $table->Increments('advise_id');
            $table->string('advise_name');
            $table->string('adivse_phone');
            $table->string('advise_email');
            $table->integer('category_id');
            $table->integer('advise_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_advise');
    }
}
