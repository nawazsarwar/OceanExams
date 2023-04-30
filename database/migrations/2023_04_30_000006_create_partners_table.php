<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('prefix')->unique();
            $table->string('primary_url')->unique();
            $table->string('header_background_color')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
