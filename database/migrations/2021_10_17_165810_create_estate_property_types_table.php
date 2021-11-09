<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstatePropertyTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estate_property_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estate_id')->nullable();
            $table->foreignId('property_type_id')->nullable();
            $table->foreign('estate_id')->references('id')->on('estates')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('property_type_id')->references('id')->on('property_types')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('price')->nullable();
            $table->integer('number_of_units')->nullable();
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
        Schema::dropIfExists('estate_property_type');
    }
}
