<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStudentsTable extends Migration
{
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id', 'course_fk_8051073')->references('id')->on('courses');
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->foreign('batch_id', 'batch_fk_8051074')->references('id')->on('batches');
            $table->unsignedBigInteger('transport_route_id')->nullable();
            $table->foreign('transport_route_id', 'transport_route_fk_8412360')->references('id')->on('transport_routes');
            $table->unsignedBigInteger('transport_stop_id')->nullable();
            $table->foreign('transport_stop_id', 'transport_stop_fk_8412361')->references('id')->on('route_stops');
        });
    }
}
