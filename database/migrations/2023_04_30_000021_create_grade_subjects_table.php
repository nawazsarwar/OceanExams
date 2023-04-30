<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradeSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('grade_subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
