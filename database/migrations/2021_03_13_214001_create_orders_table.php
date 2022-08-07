<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('price_total_sum');
            $table->float('price_unit_sum');
            $table->boolean('is_complete')->default(0);
            $table->date('date_of_order');
            $table->date('date_of_receipt')->nullable();
            $table->text('comment')->nullable();
            $table->float('paid_value')->nullable();
            $table->float('rest_value')->nullable();
            // Direct_sell ?
            $table->boolean('is_direct_sell')->default(0);

            $table->Integer('user_id')->unsigned();
            $table->Integer('store_id')->unsigned();
            $table->integer('mandob_id')->unsigned()->nullable();
            $table->bigInteger('transfer_id')->unsigned()->nullable();
            $table->bigInteger('mondob_stage_id')->unsigned()->nullable();
            $table->bigInteger('order_stage_id')->unsigned()->nullable();

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('mandob_id')->references('id')->on('mandobs')->onDelete('cascade');
            $table->foreign('transfer_id')->references('id')->on('transfers')->onDelete('cascade');
            $table->foreign('mondob_stage_id')->references('id')->on('mandob_stages')->onDelete('cascade');
            $table->foreign('order_stage_id')->references('id')->on('order_stages')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('orders');
    }
}
