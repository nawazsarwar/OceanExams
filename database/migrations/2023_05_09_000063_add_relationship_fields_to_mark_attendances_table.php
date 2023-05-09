<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMarkAttendancesTable extends Migration
{
    public function up()
    {
        Schema::table('mark_attendances', function (Blueprint $table) {
            $table->unsignedBigInteger('institute_id')->nullable();
            $table->foreign('institute_id', 'institute_fk_8457270')->references('id')->on('institutes');
            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('section_id', 'section_fk_8457271')->references('id')->on('sections');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_8457274')->references('id')->on('users');
        });
    }
}
