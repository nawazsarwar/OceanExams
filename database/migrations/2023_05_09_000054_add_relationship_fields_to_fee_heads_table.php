<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFeeHeadsTable extends Migration
{
    public function up()
    {
        Schema::table('fee_heads', function (Blueprint $table) {
            $table->unsignedBigInteger('institute_id')->nullable();
            $table->foreign('institute_id', 'institute_fk_8450184')->references('id')->on('institutes');
        });
    }
}
