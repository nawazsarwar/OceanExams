<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('paper')->nullable();
            $table->string('question_no')->nullable();
            $table->longText('description');
            $table->string('type');
            $table->integer('no_of_options')->nullable();
            $table->longText('option_1')->nullable();
            $table->longText('option_2')->nullable();
            $table->longText('option_3')->nullable();
            $table->longText('option_4')->nullable();
            $table->longText('option_5')->nullable();
            $table->longText('option_6')->nullable();
            $table->longText('correct_option')->nullable();
            $table->string('status')->nullable();
            $table->datetime('verified_at')->nullable();
            $table->longText('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
