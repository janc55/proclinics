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
        Schema::create('imaging_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('requested_by_id')->constrained('users')->onDelete('cascade');
        
            $table->dateTime('requested_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
        
            $table->enum('status', ['pendiente', 'en_proceso', 'completado', 'cancelado'])->default('pendiente');
            $table->string('result_file_path')->nullable(); // PDF del informe
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imaging_orders');
    }
};
