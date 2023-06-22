<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutesTable extends Migration
{
    public function up()
    {
        Schema::create('institutes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('subdomain')->unique();
            $table->string('hostname')->nullable();
            $table->string('public_email')->nullable();
            $table->string('public_mobile')->nullable();
            $table->longText('address')->nullable();
            $table->string('header_background_color')->nullable();
            $table->string('footer_background_color')->nullable();
            $table->longText('about')->nullable();
            $table->string('affiliation_no')->nullable();
            $table->string('template')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('status')->nullable();
            $table->longText('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
