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
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->foreignId('category_id');
            $table->boolean('is_active')->default(true);
            $table->integer('regular_price');
            $table->integer('sale_price')->nullable();
            $table->dateTime('sale_price_from')->nullable();
            $table->dateTime('sale_price_to')->nullable();
            $table->text('product_highlights')->nullable();
            $table->text('description')->nullable();
            $table->text('purchase_note')->nullable();
            $table->string('sku')->nullable();
            $table->boolean('manage_stock')->default(false);
            $table->integer('stock_quantity')->nullable();
            $table->boolean('limited_stock')->nullable();
            $table->string('product_weight', 20)->nullable();
            $table->integer('product_length')->nullable();
            $table->integer('product_width')->nullable();
            $table->integer('product_height')->nullable();
            
            $table->softDeletes();
            $table->userstamps();
            $table->softUserstamps();
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
        Schema::dropIfExists('products');
    }
}
