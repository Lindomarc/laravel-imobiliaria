<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('property_id');
            $table->string('path');
            $table->boolean('cover')->nullable();
            $table->timestamps();
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties_images');
    }
}
