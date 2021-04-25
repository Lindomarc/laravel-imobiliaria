<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('sale');
            $table->boolean('rent');
            $table->unsignedInteger('owner_id');
            $table->boolean('owner_spouse')->nullable();
            $table->unsignedInteger('owner_company_id')->nullable();
            $table->unsignedInteger('acquirer_id');
            $table->boolean('acquirer_spouse')->nullable();
            $table->unsignedInteger('acquirer_company_id')->nullable();
            $table->unsignedInteger('property_id');
            $table->double('price');
            $table->double('tribute');
            $table->double('condominium');
            $table->unsignedInteger('due_date');
            $table->unsignedInteger('dateline');
            $table->date('start_at');
            $table->timestamps();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('owner_company_id')->references('id')->on('companies')->onDelete('CASCADE');
            $table->foreign('acquirer_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('acquirer_company_id')->references('id')->on('companies')->onDelete('CASCADE');
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
        Schema::dropIfExists('contracts');
    }
}
