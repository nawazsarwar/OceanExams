<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchesTable extends Migration
{
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('target_date');
            $table->string('type')->nullable();
            $table->time('timing')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
