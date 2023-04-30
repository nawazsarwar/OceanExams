<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInstitutesTable extends Migration
{
    public function up()
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id', 'type_fk_7549494')->references('id')->on('institute_types');
            $table->unsignedBigInteger('level_id')->nullable();
            $table->foreign('level_id', 'level_fk_7549495')->references('id')->on('institute_levels');
            $table->unsignedBigInteger('partner_id')->nullable();
            $table->foreign('partner_id', 'partner_fk_7549553')->references('id')->on('partners');
        });
    }
}
