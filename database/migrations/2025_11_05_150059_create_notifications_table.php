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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('channel', 20); // sms, email, whatsapp
            $table->string('template_key', 100);
            $table->json('payload_json')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->string('status', 20)->default('pending'); // pending, sent, failed, delivered
            $table->text('error_message')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('channel');
            $table->index('status');
            $table->index('sent_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
