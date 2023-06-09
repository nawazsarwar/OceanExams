<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEmployeesTable extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->foreign('designation_id', 'designation_fk_8457183')->references('id')->on('designations');
            $table->unsignedBigInteger('employee_type_id')->nullable();
            $table->foreign('employee_type_id', 'employee_type_fk_8457184')->references('id')->on('employee_types');
            $table->unsignedBigInteger('institution_id')->nullable();
            $table->foreign('institution_id', 'institution_fk_8457185')->references('id')->on('institutes');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_8457187')->references('id')->on('users');
        });
    }
}
