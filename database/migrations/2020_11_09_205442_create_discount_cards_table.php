<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_cards', function (Blueprint $table) {
            $table->id();
            $table->uuid('card_number')->nullable();
            $table->date('expiry_date');
            $table->date('renewed_date')->nullable();
            $table->integer('discount_percent')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->integer('discount_card_fee')->nullable();
            $table->integer('discount_card_renew_fee')->nullable();
            $table->string('status');

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
        Schema::dropIfExists('discount_cards');
    }
}
