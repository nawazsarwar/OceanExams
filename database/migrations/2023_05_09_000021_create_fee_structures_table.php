<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeStructuresTable extends Migration
{
    public function up()
    {
        Schema::create('fee_structures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('fee')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
