<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('contact');
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
