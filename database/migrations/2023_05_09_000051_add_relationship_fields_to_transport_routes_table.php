<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTransportRoutesTable extends Migration
{
    public function up()
    {
        Schema::table('transport_routes', function (Blueprint $table) {
            $table->unsignedBigInteger('institute_id')->nullable();
            $table->foreign('institute_id', 'institute_fk_8450125')->references('id')->on('institutes');
        });
    }
}
