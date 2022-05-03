<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('sname')->nullable();
            $table->string('onames')->nullable();
            $table->string('slug')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->foreignId('state_id')->nullable();
            $table->string('address')->nullable();
            $table->string('nok_name')->nullable()->comment('nok means Next of kin');
            $table->string('nok_address')->nullable();
            $table->string('nok_city')->nullable();
            $table->integer('nok_state_id')->nullable();
            $table->string('relationship_with_nok')->nullable();
            $table->string('employer_name')->nullable();
            $table->string('employer_address')->nullable();
            $table->string('employer_city')->nullable();
            $table->foreignId('employer_state_id')->nullable();
            $table->string('employer_country_id')->nullable();
            $table->string('employer_phone')->nullable();
            $table->string('payment_plan_id')->nullable();
            $table->foreignId('agent_id')->nullable()->comment('This should be the ID of the staff acting as agent');

            $table->integer('lc_country_id')->unsigned()->nullable();
            $table->tinyInteger('lc_region_id')->unsigned()->nullable();
            $table->foreignId('lga_id')->nullable();
            $table->foreignId('marital_satus_id')->nullable();
            $table->foreignId('nok_gender_id')->nullable();
            $table->string('nok_phone')->nullable();
            $table->string('nok_email')->nullable();
            $table->string('referrer')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
