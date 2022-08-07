<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name');
            $table->string('address');

            // keys
            $table->bigInteger('place_id')->unsigned();
            $table->bigInteger('store_keeper_id')->unsigned();
            $table->bigInteger('accountant_id')->unsigned();

            // Relations
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('store_keeper_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('accountant_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('stores');
    }
}
