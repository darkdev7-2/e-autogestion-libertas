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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('provider', 50); // kkiapay, fedapay
            $table->string('transaction_id')->unique()->nullable();
            $table->string('status', 20)->default('initiated'); // initiated, paid, failed, refunded
            $table->timestamp('paid_at')->nullable();
            $table->json('meta_json')->nullable(); // Store provider-specific metadata
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('provider');
            $table->index('status');
            $table->index('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
