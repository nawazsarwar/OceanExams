<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeHeadsTable extends Migration
{
    public function up()
    {
        Schema::create('fee_heads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('type');
            $table->longText('recurrence')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
