<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToChaptersTable extends Migration
{
    public function up()
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->unsignedBigInteger('grade_subject_id')->nullable();
            $table->foreign('grade_subject_id', 'grade_subject_fk_8412212')->references('id')->on('grade_subjects');
        });
    }
}
