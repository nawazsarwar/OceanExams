<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSubjectPivotTable extends Migration
{
    public function up()
    {
        Schema::create('employee_subject', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id', 'employee_id_fk_8457179')->references('id')->on('employees')->onDelete('cascade');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id', 'subject_id_fk_8457179')->references('id')->on('subjects')->onDelete('cascade');
        });
    }
}
