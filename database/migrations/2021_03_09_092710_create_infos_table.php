<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity')->default(0);
            $table->integer('quantity_unit')->default(0);
            $table->integer('lower_limit')->default(0);
            $table->integer('max_limit')->default(0);
            $table->integer('first_period')->default(0);
            $table->integer('reorder_limit')->default(0);
            $table->float('buy_price')->default(0);
            $table->float('sp_unit_percentage')->default(0);
            $table->float('sp_total_percentage')->default(0);

            // keys
            $table->integer('store_id')->unsigned();
            //relations
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');

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
        Schema::dropIfExists('infos');
    }
}
