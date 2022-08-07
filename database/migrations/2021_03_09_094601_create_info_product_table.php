<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_info', function (Blueprint $table) {
            $table->Increments('id');
            $table->timestamps();

            //keys
            $table->integer('product_id')->unsigned();
            $table->biginteger('info_id')->unsigned();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('info_id')->references('id')->on('infos')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_info');
    }
}
