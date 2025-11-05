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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('brand', 100);
            $table->string('model', 100);
            $table->string('registration_number', 50)->unique();
            $table->date('insurance_expiry')->nullable();
            $table->date('inspection_due_at')->nullable();
            $table->json('documents_json')->nullable(); // Store document metadata
            $table->timestamps();
            $table->softDeletes();

            $table->index('client_id');
            $table->index('registration_number');
            $table->index('insurance_expiry');
            $table->index('inspection_due_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
