<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('country_code')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->foreignId('lga_id')->nullable();
            $table->foreignId('marital_status_id')->nullable();
            $table->text('residential_address')->nullable();
            $table->foreignId('nok_gender_id')->nullable();
            $table->string('referrer')->nullable();
            $table->string('nok_phone')->nullable();
            $table->string('nok_dob')->nullable();
            $table->string('nok_email')->nullable();
            $table->boolean('by_online_subscription')->default(false)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            //
        });
    }
}
