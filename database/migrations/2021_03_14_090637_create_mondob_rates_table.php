<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMondobRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mondob_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rate');

            $table->integer('mandob_id')->unsigned()->nullable();
            $table->bigInteger('order_id')->unsigned();

            $table->foreign('mandob_id')->references('id')->on('mandobs')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

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
        Schema::dropIfExists('mondob_rates');
    }
}
