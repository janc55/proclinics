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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');

            $table->text('diagnosis')->nullable();
            $table->text('treatment')->nullable();
            $table->text('observations')->nullable();

            // Signos vitales
            $table->decimal('height_cm', 5, 2)->nullable(); // Ej: 172.5
            $table->decimal('weight_kg', 5, 2)->nullable(); // Ej: 65.0
            $table->decimal('temperature', 4, 1)->nullable(); // Ej: 36.8
            $table->string('blood_pressure')->nullable(); // Ej: 120/80
            $table->integer('heart_rate')->nullable(); // bpm
            $table->integer('respiratory_rate')->nullable(); // rpm
            $table->integer('oxygen_saturation')->nullable(); // %

            $table->dateTime('next_appointment')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
