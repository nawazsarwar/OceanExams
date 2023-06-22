<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('student_user', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id', 'student_id_fk_8457114')->references('id')->on('students')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_8457114')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
