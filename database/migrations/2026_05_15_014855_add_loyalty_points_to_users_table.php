<?php
// ═══════════════════════════════════════════════════════════════
//  MIGRATIONS À CRÉER (exécuter dans l'ordre avec php artisan migrate)
// ═══════════════════════════════════════════════════════════════

// ──────────────────────────────────────────────────────────────
// 1. Colonnes fidélité sur la table users
//    php artisan make:migration add_loyalty_to_users_table
// ──────────────────────────────────────────────────────────────

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('loyalty_points')->default(0)->after('email');
            $table->string('loyalty_badge')->default('Nouveau')->after('loyalty_points');
            $table->decimal('total_spent', 10, 2)->default(0)->after('loyalty_badge');
            $table->unsignedInteger('next_level_points')->default(50)->after('total_spent');
            $table->string('role')->default('client')->after('next_level_points'); // client | employe | admin
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['loyalty_points', 'loyalty_badge', 'total_spent', 'next_level_points', 'role']);
        });
    }
};

