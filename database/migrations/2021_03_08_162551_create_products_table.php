<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('category_id')->nullable();
            $table->string('company_id')->nullable();
            $table->string('subcategory_id')->nullable();
            $table->integer('price');
            $table->integer('price_unit');
            $table->integer('discount')->nullable();
            $table->integer('quantity')->nullable();
            $table->text('description')->nullable();
            $table->string('unit_type');
            $table->integer('quantity_unit');
            $table->integer('quantity_status');
            $table->integer('max_quantity');
            $table->integer('status')->default(0);
            $table->integer('store_id')->nullable();
            $table->integer('waiting_status')->default(0);
            $table->string('subunit_type');
            $table->string('image')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
