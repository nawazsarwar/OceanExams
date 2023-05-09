<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRouteStopsTable extends Migration
{
    public function up()
    {
        Schema::table('route_stops', function (Blueprint $table) {
            $table->unsignedBigInteger('transport_route_id')->nullable();
            $table->foreign('transport_route_id', 'transport_route_fk_8457087')->references('id')->on('transport_routes');
        });
    }
}
