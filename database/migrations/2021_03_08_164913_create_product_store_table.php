<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            // Keys
            $table->integer('store_id')->unsigned();
            $table->integer('product_id')->unsigned();

            // relations
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_stores');
    }
}
