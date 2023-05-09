<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileModeOnlineTestsTable extends Migration
{
    public function up()
    {
        Schema::create('file_mode_online_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('quiz');
            $table->string('mode')->nullable();
            $table->string('type')->nullable();
            $table->date('test_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
