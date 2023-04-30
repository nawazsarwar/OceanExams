<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseSubjectPivotTable extends Migration
{
    public function up()
    {
        Schema::create('course_subject', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id', 'course_id_fk_8051016')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id', 'subject_id_fk_8051016')->references('id')->on('subjects')->onDelete('cascade');
        });
    }
}
