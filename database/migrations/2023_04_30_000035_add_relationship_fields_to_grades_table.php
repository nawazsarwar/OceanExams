<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToGradesTable extends Migration
{
    public function up()
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->unsignedBigInteger('institute_id')->nullable();
            $table->foreign('institute_id', 'institute_fk_8412173')->references('id')->on('institutes');
        });
    }
}
