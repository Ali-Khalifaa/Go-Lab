<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examination_units', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('receive');
            $table->integer('recall')->default(0);
            $table->integer('quantity_before');
            $table->integer('quantity_after');
            $table->bigInteger('receipt_status_id')->unsigned();
            $table->bigInteger('return_reason_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->biginteger('examination_id')->unsigned();

            $table->foreign('receipt_status_id')->references('id')->on('receipt_statuses')->onDelete('cascade');
            $table->foreign('return_reason_id')->references('id')->on('return_reasons')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('examination_id')->references('id')->on('examinations')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examination_units');
    }
}
