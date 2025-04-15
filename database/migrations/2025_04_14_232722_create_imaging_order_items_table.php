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
        Schema::create('imaging_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('imaging_order_id')->constrained()->onDelete('cascade');
            $table->foreignId('imaging_study_id')->constrained()->onDelete('cascade');
        
            $table->text('report')->nullable(); // Informe médico
            $table->json('images')->nullable(); // Array de paths a imágenes
        
            $table->foreignId('processed_by_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imaging_order_items');
    }
};
