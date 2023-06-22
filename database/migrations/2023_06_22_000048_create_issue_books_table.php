<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueBooksTable extends Migration
{
    public function up()
    {
        Schema::create('issue_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('issue_date')->nullable();
            $table->datetime('return_date');
            $table->longText('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
