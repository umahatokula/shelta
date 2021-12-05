<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estate_property_type_id')->nullable();
            $table->foreign('estate_property_type_id')->references('id')->on('estate_property_type')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('client_id')->nullable();
            $table->string('unique_number')->unique()->nullable();
            $table->foreignId('payment_plan_id')->nullable();
            $table->date('date_of_first_payment')->nullable()->comment('This is used to get date of monthly payment');
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
        Schema::dropIfExists('properties');
    }
}
