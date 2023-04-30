<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBatchesTable extends Migration
{
    public function up()
    {
        Schema::table('batches', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id', 'course_fk_8051023')->references('id')->on('courses');
        });
    }
}
