<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToGradeSubjectsTable extends Migration
{
    public function up()
    {
        Schema::table('grade_subjects', function (Blueprint $table) {
            $table->unsignedBigInteger('grade_id')->nullable();
            $table->foreign('grade_id', 'grade_fk_8412199')->references('id')->on('grades');
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->foreign('subject_id', 'subject_fk_8412200')->references('id')->on('subjects');
            $table->unsignedBigInteger('institute_id')->nullable();
            $table->foreign('institute_id', 'institute_fk_8412201')->references('id')->on('institutes');
        });
    }
}
