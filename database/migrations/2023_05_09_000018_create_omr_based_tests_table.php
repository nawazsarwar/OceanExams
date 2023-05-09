<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOmrBasedTestsTable extends Migration
{
    public function up()
    {
        Schema::create('omr_based_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('series');
            $table->string('type');
            $table->integer('negative_mark')->nullable();
            $table->integer('correct_mark')->nullable();
            $table->integer('total_question')->nullable();
            $table->date('target_year')->nullable();
            $table->date('test_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
