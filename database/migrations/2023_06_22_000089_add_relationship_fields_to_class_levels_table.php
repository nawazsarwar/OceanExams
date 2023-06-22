<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToClassLevelsTable extends Migration
{
    public function up()
    {
        Schema::table('class_levels', function (Blueprint $table) {
            $table->unsignedBigInteger('institute_id')->nullable();
            $table->foreign('institute_id', 'institute_fk_8658268')->references('id')->on('institutes');
        });
    }
}
