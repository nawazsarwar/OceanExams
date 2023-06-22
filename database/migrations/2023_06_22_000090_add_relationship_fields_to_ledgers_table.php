<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLedgersTable extends Migration
{
    public function up()
    {
        Schema::table('ledgers', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id', 'student_fk_8658291')->references('id')->on('students');
            $table->unsignedBigInteger('fee_structure_id')->nullable();
            $table->foreign('fee_structure_id', 'fee_structure_fk_8658292')->references('id')->on('fee_structures');
            $table->unsignedBigInteger('institute_id')->nullable();
            $table->foreign('institute_id', 'institute_fk_8658279')->references('id')->on('institutes');
            $table->unsignedBigInteger('added_by_id')->nullable();
            $table->foreign('added_by_id', 'added_by_fk_8658296')->references('id')->on('users');
        });
    }
}
