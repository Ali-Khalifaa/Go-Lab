<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMandobPlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mandob_place', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('place_id')->unsigned();
            $table->integer('mandob_id')->unsigned();

            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('mandob_id')->references('id')->on('mandobs')->onDelete('cascade');

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
        Schema::dropIfExists('mandob_place');
    }
}
