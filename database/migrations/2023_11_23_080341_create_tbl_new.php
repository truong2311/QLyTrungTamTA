<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblNew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_new', function (Blueprint $table) {
            $table->Increments('new_id');
            $table->integer('cate_new_id');
            $table->text('new_title');
            $table->string('new_slug');
            $table->text('new_desc');
            $table->text('new_content');
            $table->string('new_meta_desc');
            $table->string('new_meta_keywords');
            $table->integer('new_status');
            $table->string('new_image');
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
        Schema::dropIfExists('tbl_new');
    }
}
