<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Boolean;

class CreateImageSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_sliders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('group')->nullable()->index();
            $table->string('image_path');
            $table->string('title')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('position')->nullable();
            $table->string('action_link')->nullable();
            $table->boolean('open_in_new_tab')->default(true);

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
        Schema::dropIfExists('image_sliders');
    }
}
