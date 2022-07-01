<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->nullable()->default(1);
            $table->string('userid')->unique();
            $table->string('password')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('dob')->nullable();
            $table->string('parent_address')->nullable();
            $table->string('parent_apt')->nullable();
            $table->string('parent_city')->nullable();
            $table->string('parent_state')->nullable();
            $table->string('parent_country')->nullable();
            $table->string('parent_zip')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('spouse_first_name')->nullable();
            $table->string('spouse_last_name')->nullable();
            $table->string('child_first_name')->nullable();
            $table->string('child_last_name')->nullable();
            $table->string('child_age')->nullable();
            $table->string('child_address')->nullable();
            $table->string('child_city')->nullable();
            $table->string('child_state')->nullable();
            $table->string('child_country')->nullable();
            $table->string('child_zip')->nullable();
            $table->enum('payment_status',['payment_pending','payment_done'])->default('Payment_pending');
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('avatar')->nullable();
            // $table->string('address')->nullable();
            $table->string('gender')->nullable();
            // $table->string('role')->nullable()->default('customer');
            $table->integer('spam_count')->nullable()->default(0);
            $table->string( 'paypal_transaction_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
