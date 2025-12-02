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
        if (Schema::hasTable('testimonials')) {
            Schema::table('testimonials', function (Blueprint $table) {
                if (!Schema::hasColumn('testimonials', 'photo')) {
                    $table->string('photo')->nullable(); // column will be added at the end
                }

                if (!Schema::hasColumn('testimonials', 'rating')) {
                    $table->tinyInteger('rating')->unsigned()->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('testimonials')) {
            Schema::table('testimonials', function (Blueprint $table) {
                if (Schema::hasColumn('testimonials', 'photo')) {
                    $table->dropColumn('photo');
                }

                if (Schema::hasColumn('testimonials', 'rating')) {
                    $table->dropColumn('rating');
                }
            });
        }
    }
};
