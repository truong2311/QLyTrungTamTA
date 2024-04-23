<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTeacher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_teacher', function (Blueprint $table) {
            $table->Increments('teacher_id');
            $table->string('teacher_name');
            $table->string('teacher_image');
            $table->string('teacher_dateofbirth');
            $table->string('teacher_cccd');
            $table->integer('teacher_gender');
            $table->string('teacher_phone');
            $table->string('teacher_university');
            $table->string('teacher_certificate');
            $table->string('teacher_address');
            $table->string('teacher_email');
            $table->string('teacher_password');
            $table->integer('teacher_salary');
            $table->string('teacher_startday');
            $table->integer('teacher_status');
            $table->text('teacher_desc');
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
        Schema::dropIfExists('tbl_teacher');
    }
}
