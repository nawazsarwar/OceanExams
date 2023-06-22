<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBooksTable extends Migration
{
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->foreign('subject_id', 'subject_fk_8658080')->references('id')->on('subjects');
            $table->unsignedBigInteger('added_by_id')->nullable();
            $table->foreign('added_by_id', 'added_by_fk_8658133')->references('id')->on('users');
        });
    }
}
