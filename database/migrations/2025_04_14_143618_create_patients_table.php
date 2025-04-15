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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');

            $table->string('document_number')->nullable();
            $table->string('extension')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('phone')->nullable();
            $table->enum('sex', ['M', 'F', 'O'])->nullable();
            $table->string('blood_type')->nullable();

            $table->decimal('height_cm', 5, 2)->nullable();
            $table->decimal('weight_kg', 5, 2)->nullable();

            $table->text('allergies')->nullable();
            $table->text('medical_conditions')->nullable();

            $table->string('emergency_contact')->nullable();
            $table->string('address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
