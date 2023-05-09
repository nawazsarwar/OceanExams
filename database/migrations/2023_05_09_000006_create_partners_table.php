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
            $table->string('product_name')->unique();
            $table->string('subdomain')->unique();
            $table->string('hostname');
            $table->string('public_email')->nullable();
            $table->string('public_mobile')->nullable();
            $table->longText('address')->nullable();
            $table->string('header_background_color')->nullable();
            $table->string('footer_background_color')->nullable();
            $table->string('status')->nullable();
            $table->longText('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
