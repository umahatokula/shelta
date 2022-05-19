<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable();
            $table->foreignId('property_id')->nullable();
            $table->foreign('property_id')->references('id')->on('properties')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('amount')->nullable();
            $table->string('transaction_number')->unique()->nullable();
            $table->string('type')->nullable();
            $table->foreignId('recorded_by')->nullable()->comment('User who made or recorded this transaction');
            $table->boolean('recorded_by_staff')->nullable()->default(1);
            $table->string('proof_reference_number')->unique()->nullable();
            $table->date('date')->nullable();
            $table->date('instalment_date')->nullable()->comment('The month this instalment payment is for');
            $table->integer('status')->nullable()->default(3)->comment('1=Approved / 2=Unapproved / 3=Unprocessed');
            $table->boolean('is_approved')->nullable()->default(0);
            $table->foreignId('processed_by')->nullable()->comment('User who made or processed/recorded this transaction');
            $table->boolean('is_first_instalment')->nullable()->default(0);
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
        Schema::dropIfExists('transactions');
    }
}
