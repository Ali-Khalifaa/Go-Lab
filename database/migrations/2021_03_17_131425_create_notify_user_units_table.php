<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifyUserUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notify_user_units', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('discount_total')->default(0);
            $table->integer('discount_unit')->default(0);

            $table->integer('now_total')->default(0);
            $table->integer('now_unit')->default(0);
            $table->integer('later_total')->default(0);
            $table->integer('later_unit')->default(0);


            $table->integer('product_id')->unsigned();
            $table->bigInteger('notify_user_id')->unsigned();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('notify_user_id')->references('id')->on('notify_users')->onDelete('cascade');
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
        Schema::dropIfExists('notify_user_units');
    }
}
