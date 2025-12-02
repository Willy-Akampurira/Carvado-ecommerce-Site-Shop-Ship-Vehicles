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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();                                    // Primary key
            $table->string('make');                          // Car manufacturer (e.g. Toyota)
            $table->string('model');                         // Car model (e.g. corolla)
            $table->year('year');                            // Manufacturing year
            $table->integer('mileage')->default(0);          // Distance driven
            $table->string('color');                         // Exterior color
            $table->string('transmission');                  // Automatic/manual
            $table->string('fuel_type');                     // Petrol/diesel/electric/etc.
            $table->string('vin')->unique();                 // Unique vehicle ID
            $table->string('image')->nullable();             // Pathh/URL to image file
            $table->decimal('price', 10, 2)->default(0);     // Listing price (e.g. 15000.00)
            $table->timestamps();                            // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
