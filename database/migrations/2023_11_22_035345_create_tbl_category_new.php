<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCategoryNew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_category_new', function (Blueprint $table) {
            $table->Increments('cate_new_id');
            $table->text('cate_new_name');
            $table->string('cate_new_slug');
            $table->text('cate_new_desc');
            $table->integer('cate_new_status');
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
        Schema::dropIfExists('tbl_category_new');
    }
}
