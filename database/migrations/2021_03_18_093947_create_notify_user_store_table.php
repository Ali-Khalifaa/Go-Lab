<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifyUserStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notify_user_store', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('store_id')->unsigned();
            $table->bigInteger('notify_user_id')->unsigned();

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
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
        Schema::dropIfExists('notify_user_store');
    }
}
