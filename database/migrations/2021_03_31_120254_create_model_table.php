<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger("rating");
            $table->string('category');
            $table->string('image');
            $table->string('reputationBadge');
            $table->unsignedBigInteger("reputation");
            $table->unsignedBigInteger("price");
            $table->unsignedBigInteger("availability");
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
        Schema::dropIfExists('model');
    }
}