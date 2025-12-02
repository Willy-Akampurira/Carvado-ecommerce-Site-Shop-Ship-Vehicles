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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Foreign key to users (nullable for guest checkout)
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('set null');

            // Unique order code or reference
            $table->string('order_number')->unique();

            // Customer details
            $table->string('name');
            $table->string('email');
            $table->string('address');

            // Order details
            $table->string('vehicle')->nullable(); // Optional for now
            $table->decimal('amount', 10, 2)->default(0); // Total amount
            $table->decimal('total_price', 10, 2)->default(0); // Can match amount or sum multiple items

            $table->enum('status', ['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'])->default('pending');

            // Optional notes
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
