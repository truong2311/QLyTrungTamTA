<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_courses', function (Blueprint $table) {
            $table->Increments('coursesE_id');
            $table->integer('category_id');
            $table->string('coursesE_title');
            $table->string('coursesE_slug');
            $table->string('coursesE_image');
            $table->text('coursesE_content');
            $table->string('coursesE_seats');
/*            $table->string('coursesE_starttime');
            $table->string('coursesE_endtime');*/
            $table->string('coursesE_number');
            $table->integer('coursesE_tuition');
/*            $table->string('coursesE_startday');
            $table->string('coursesE_endday');*/
            $table->integer('coursesE_status');
            $table->text('coursesE_desc');
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
        Schema::dropIfExists('tbl_courses');
    }
}
