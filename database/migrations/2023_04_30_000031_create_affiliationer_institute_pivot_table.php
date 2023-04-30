<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliationerInstitutePivotTable extends Migration
{
    public function up()
    {
        Schema::create('affiliationer_institute', function (Blueprint $table) {
            $table->unsignedBigInteger('institute_id');
            $table->foreign('institute_id', 'institute_id_fk_7549497')->references('id')->on('institutes')->onDelete('cascade');
            $table->unsignedBigInteger('affiliationer_id');
            $table->foreign('affiliationer_id', 'affiliationer_id_fk_7549497')->references('id')->on('affiliationers')->onDelete('cascade');
        });
    }
}
