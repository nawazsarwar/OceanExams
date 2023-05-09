<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarkAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('mark_attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('students')->nullable();
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
