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
        Schema::create('clinical_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->unique()->constrained('patients')->onDelete('cascade');

            $table->text('family_history')->nullable();
            $table->text('medical_history')->nullable();
            $table->text('surgical_history')->nullable();
            $table->text('gyne_ob_history')->nullable();
            $table->text('vaccination_notes')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinical_histories');
    }
};
