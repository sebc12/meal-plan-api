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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->integer('week'); // Uge nummer
            $table->foreignId('day_1')->nullable()->constrained('recipes')->onDelete('set null');
            $table->foreignId('day_2')->nullable()->constrained('recipes')->onDelete('set null');
            $table->foreignId('day_3')->nullable()->constrained('recipes')->onDelete('set null');
            $table->foreignId('day_4')->nullable()->constrained('recipes')->onDelete('set null');
            $table->foreignId('day_5')->nullable()->constrained('recipes')->onDelete('set null');
            $table->foreignId('day_6')->nullable()->constrained('recipes')->onDelete('set null');
            $table->foreignId('day_7')->nullable()->constrained('recipes')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
