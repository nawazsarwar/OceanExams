<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFeesStructuresTable extends Migration
{
    public function up()
    {
        Schema::table('fees_structures', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id', 'course_fk_8051150')->references('id')->on('courses');
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->foreign('batch_id', 'batch_fk_8051151')->references('id')->on('batches');
        });
    }
}
