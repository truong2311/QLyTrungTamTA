<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSpend extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_spend', function (Blueprint $table) {
            $table->Increments('spend_id');
            $table->string('spend_name');
            $table->string('spend_content');
            $table->string('spend_date');
            $table->integer('spend_money');
            $table->string('spend_desc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_spend');
    }
}
