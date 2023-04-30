<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportVehiclesTable extends Migration
{
    public function up()
    {
        Schema::create('transport_vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
