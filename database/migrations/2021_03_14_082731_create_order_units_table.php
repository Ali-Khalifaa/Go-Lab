<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_units', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity_total');
            $table->integer('quantity_unit');
            $table->integer('receive_total')->default(0);
            $table->integer('receive_unit')->default(0);
            $table->integer('recall_total')->default(0);
            $table->integer('recall_unit')->default(0);


            $table->integer('product_id')->unsigned();
            $table->bigInteger('order_id')->unsigned();

            $table->foreign('order_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');


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
        Schema::dropIfExists('order_units');
    }
}
