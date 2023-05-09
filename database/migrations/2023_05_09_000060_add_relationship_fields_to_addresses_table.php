<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAddressesTable extends Migration
{
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('postal_code_id')->nullable();
            $table->foreign('postal_code_id', 'postal_code_fk_8455247')->references('id')->on('postal_codes');
            $table->unsignedBigInteger('province_id')->nullable();
            $table->foreign('province_id', 'province_fk_8455248')->references('id')->on('provinces');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id', 'country_fk_8455249')->references('id')->on('countries');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_8450370')->references('id')->on('users');
        });
    }
}
