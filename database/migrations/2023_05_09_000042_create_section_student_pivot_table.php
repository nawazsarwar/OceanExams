<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionStudentPivotTable extends Migration
{
    public function up()
    {
        Schema::create('section_student', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id', 'student_id_fk_8455237')->references('id')->on('students')->onDelete('cascade');
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id', 'section_id_fk_8455237')->references('id')->on('sections')->onDelete('cascade');
        });
    }
}
