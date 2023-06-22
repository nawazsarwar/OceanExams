<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIssueBooksTable extends Migration
{
    public function up()
    {
        Schema::table('issue_books', function (Blueprint $table) {
            $table->unsignedBigInteger('book_id')->nullable();
            $table->foreign('book_id', 'book_fk_8658124')->references('id')->on('books');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_8658125')->references('id')->on('users');
            $table->unsignedBigInteger('issued_by_id')->nullable();
            $table->foreign('issued_by_id', 'issued_by_fk_8658129')->references('id')->on('users');
        });
    }
}
