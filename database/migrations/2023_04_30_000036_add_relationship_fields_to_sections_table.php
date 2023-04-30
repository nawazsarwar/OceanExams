<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSectionsTable extends Migration
{
    public function up()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->unsignedBigInteger('grade_id')->nullable();
            $table->foreign('grade_id', 'grade_fk_8412175')->references('id')->on('grades');
        });
    }
}
