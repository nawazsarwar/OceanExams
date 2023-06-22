<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgersTable extends Migration
{
    public function up()
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('payable', 15, 2);
            $table->decimal('discount', 15, 2);
            $table->decimal('paid', 15, 2);
            $table->decimal('balance', 15, 2);
            $table->date('due_date');
            $table->date('payment_date');
            $table->longText('remark')->nullable();
            $table->integer('payment_cycle');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
