<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id()->from(2000);
            $table->foreignId('user_id')->constrained('users');
            $table->double('subtotal_price', 15, 2)->nullable();
            $table->double('shipping_charge', 8, 2)->nullable();
            $table->double('discount_amount', 15, 2)->nullable();
            $table->double('total_price', 15, 2)->nullable();
            // $table->integer('tax_percent')->nullable();
            $table->enum('status', ['pending', 'processing', 'shipped', 'completed', 'cancelled', 'refunded'])->default('pending');
            $table->string('payment_method');
            $table->enum('payment_status', ['pending', 'paid', 'refunded'])->default('pending');
            $table->text('paypal_response')->nullable();
            $table->string('invoice_number')->nullable();
            $table->text('notes')->nullable();
            
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
        Schema::dropIfExists('orders');
    }
}
