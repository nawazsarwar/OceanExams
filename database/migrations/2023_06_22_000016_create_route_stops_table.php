<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteStopsTable extends Migration
{
    public function up()
    {
        Schema::create('route_stops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->decimal('fare', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
