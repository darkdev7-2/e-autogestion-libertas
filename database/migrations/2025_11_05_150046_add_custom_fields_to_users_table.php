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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 20)->nullable()->after('email');
            $table->string('role', 50)->default('client')->after('password'); // client, admin, agent, super_admin
            $table->string('two_factor_secret')->nullable()->after('role');
            $table->string('locale', 2)->default('fr')->after('two_factor_secret'); // fr, en
            $table->string('status', 20)->default('active')->after('locale'); // active, inactive, suspended
            $table->index('phone');
            $table->index('role');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['phone']);
            $table->dropIndex(['role']);
            $table->dropIndex(['status']);
            $table->dropColumn(['phone', 'role', 'two_factor_secret', 'locale', 'status']);
        });
    }
};
