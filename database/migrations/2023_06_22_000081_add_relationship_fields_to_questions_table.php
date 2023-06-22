<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToQuestionsTable extends Migration
{
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->unsignedBigInteger('institute_id')->nullable();
            $table->foreign('institute_id', 'institute_fk_8457279')->references('id')->on('institutes');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id', 'course_fk_8457280')->references('id')->on('courses');
            $table->unsignedBigInteger('affiliationer_id')->nullable();
            $table->foreign('affiliationer_id', 'affiliationer_fk_8457281')->references('id')->on('affiliationers');
            $table->unsignedBigInteger('chapter_id')->nullable();
            $table->foreign('chapter_id', 'chapter_fk_8457282')->references('id')->on('chapters');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_8457296')->references('id')->on('users');
            $table->unsignedBigInteger('verified_by_id')->nullable();
            $table->foreign('verified_by_id', 'verified_by_fk_8457297')->references('id')->on('users');
        });
    }
}
