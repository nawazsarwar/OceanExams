<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTransportVehiclesTable extends Migration
{
    public function up()
    {
        Schema::table('transport_vehicles', function (Blueprint $table) {
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->foreign('driver_id', 'driver_fk_8450238')->references('id')->on('employees');
            $table->unsignedBigInteger('assistant_id')->nullable();
            $table->foreign('assistant_id', 'assistant_fk_8450239')->references('id')->on('employees');
        });
    }
}
