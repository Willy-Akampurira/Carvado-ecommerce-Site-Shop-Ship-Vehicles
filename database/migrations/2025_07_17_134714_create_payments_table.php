<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // Link to the order
            $table->unsignedBigInteger('order_id');

            // Payment details
            $table->string('paymen_reference')->unique();
            $table->enum('method', ['card', 'mobile_money', 'paypal', 'bank_transfer'])->default('card');
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');

            // Optional extras
            $table->string('transaction_id')->nullable();
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
