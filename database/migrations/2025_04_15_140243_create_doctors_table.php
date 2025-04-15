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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('document_number')->nullable();
            $table->string('extension')->nullable();
            $table->string('specialty');
            $table->string('license_number')->nullable();
            $table->text('biography')->nullable();
            $table->string('phone')->nullable();
            $table->decimal('consultation_price', 10, 2)->nullable();
            $table->boolean('status')->default(true);
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
