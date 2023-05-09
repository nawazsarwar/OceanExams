<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionSubjectPivotTable extends Migration
{
    public function up()
    {
        Schema::create('section_subject', function (Blueprint $table) {
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id', 'subject_id_fk_8454900')->references('id')->on('subjects')->onDelete('cascade');
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id', 'section_id_fk_8454900')->references('id')->on('sections')->onDelete('cascade');
        });
    }
}
