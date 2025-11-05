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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // The referrer
            $table->string('code', 20)->unique();
            $table->foreignId('referred_user_id')->nullable()->constrained('users')->onDelete('set null'); // The referred user
            $table->decimal('bonus_cfa', 10, 2)->default(0);
            $table->string('status', 20)->default('pending'); // pending, active, paid
            $table->timestamp('activated_at')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('code');
            $table->index('referred_user_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
