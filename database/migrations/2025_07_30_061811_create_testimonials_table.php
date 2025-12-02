<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('testimonials')) {
            Schema::create('testimonials', function (Blueprint $table) {
                $table->id();
                $table->string('name');                         // Customer name
                $table->text('text');                           // Their testimonial
                $table->string('photo')->nullable();            // Optional uploaded image
                $table->tinyInteger('rating')->unsigned(); // Star rating (1–5)
                $table->timestamps();                           // created_at & updated_at
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
