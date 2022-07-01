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
            $table->string('name');
            $table->string('email')->unique();
<<<<<<< HEAD
            $table->timestamp('email_verified_at')->nullable();
=======
             $table->timestamp('email_verified_at')->nullable();
>>>>>>> 7f3aedc92570ca4d6173e4fd25fa4d3e1c0edc66
            $table->boolean('status')->nullable()->default(1);
            $table->string('password')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('avatar')->nullable();
            $table->string('mobile')->nullable();
            // $table->string('address')->nullable();
            $table->string('gender')->nullable();
            // $table->string('role')->nullable()->default('customer');
            $table->integer('spam_count')->nullable()->default(0);
<<<<<<< HEAD
            $table->string( 'paypal_transaction_id')->nullable();
=======
>>>>>>> 7f3aedc92570ca4d6173e4fd25fa4d3e1c0edc66
            $table->rememberToken();
            $table->softDeletes();
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
