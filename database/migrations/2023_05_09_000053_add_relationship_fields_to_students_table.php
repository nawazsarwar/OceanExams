<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStudentsTable extends Migration
{
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('transport_route_id')->nullable();
            $table->foreign('transport_route_id', 'transport_route_fk_8450159')->references('id')->on('transport_routes');
            $table->unsignedBigInteger('transport_stop_id')->nullable();
            $table->foreign('transport_stop_id', 'transport_stop_fk_8450160')->references('id')->on('route_stops');
        });
    }
}
