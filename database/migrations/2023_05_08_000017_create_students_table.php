<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile_no');
            $table->string('fathers_name')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('parents_contact');
            $table->date('date_of_birth');
            $table->date('date_of_joining');
            $table->string('email')->nullable();
            $table->boolean('image_verified')->default(0);
            $table->boolean('archived')->default(0)->nullable();
            $table->string('enrollment_no')->nullable();
            $table->string('roll_no')->nullable();
            $table->string('id_card_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
