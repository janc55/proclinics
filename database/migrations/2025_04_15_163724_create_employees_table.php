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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
            $table->string('position');
            $table->decimal('salary', 10, 2);
            $table->date('hire_date')->nullable();
        
            $table->enum('contract_type', ['indefinido', 'plazo fijo', 'consultoría'])->default('indefinido');
            $table->boolean('status')->default(true);
        
            $table->timestamps();        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
