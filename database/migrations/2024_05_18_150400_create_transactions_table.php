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
            $table->string('tx_ref')->nullable();
            $table->string('flw_ref')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('currency');
            $table->decimal('charged_amount', 15, 2)->nullable();
            $table->decimal('service_charge', 15, 2)->nullable();
            $table->string('ip')->nullable();
            $table->string('narration')->nullable();
            $table->string('status');
            $table->string('payment_type')->nullable();
            $table->string('payment_method');
            $table->decimal('amount_settled', 15, 2)->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
