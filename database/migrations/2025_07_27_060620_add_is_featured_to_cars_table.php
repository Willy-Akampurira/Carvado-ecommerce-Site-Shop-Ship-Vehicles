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
        Schema::table('cars', function (Blueprint $table) {
            // Add 'is_featured' if it doesn't already exist
            if (!Schema::hasColumn('cars', 'is_featured')) {
                $table->boolean('is_featured')->default(false);
            }

            // Add 'fuel_type' if it doesn't already exist
            if (!Schema::hasColumn('cars', 'fuel_type')) {
                $table->string('fuel_type')->default('Petrol');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            // Drop 'is_featured' safely
            if (Schema::hasColumn('cars', 'is_featured')) {
                $table->dropColumn('is_featured');
            }

            // Drop 'fuel_type' safely
            if (Schema::hasColumn('cars', 'fuel_type')) {
                $table->dropColumn('fuel_type');
            }
        });
    }
};
