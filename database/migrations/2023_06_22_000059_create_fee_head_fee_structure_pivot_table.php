<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeHeadFeeStructurePivotTable extends Migration
{
    public function up()
    {
        Schema::create('fee_head_fee_structure', function (Blueprint $table) {
            $table->unsignedBigInteger('fee_structure_id');
            $table->foreign('fee_structure_id', 'fee_structure_id_fk_8457148')->references('id')->on('fee_structures')->onDelete('cascade');
            $table->unsignedBigInteger('fee_head_id');
            $table->foreign('fee_head_id', 'fee_head_id_fk_8457148')->references('id')->on('fee_heads')->onDelete('cascade');
        });
    }
}
