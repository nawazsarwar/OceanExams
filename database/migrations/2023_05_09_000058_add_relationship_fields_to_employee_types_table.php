<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEmployeeTypesTable extends Migration
{
    public function up()
    {
        Schema::table('employee_types', function (Blueprint $table) {
            $table->unsignedBigInteger('institute_id')->nullable();
            $table->foreign('institute_id', 'institute_fk_8450232')->references('id')->on('institutes');
            $table->unsignedBigInteger('institution_id')->nullable();
            $table->foreign('institution_id', 'institution_fk_8450297')->references('id')->on('institutes');
        });
    }
}
