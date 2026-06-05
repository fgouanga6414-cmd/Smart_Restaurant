<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ajouter prep_time à order_items si elle n'existe pas
        if (!Schema::hasColumn('order_items', 'time')) {
            Schema::table('order_items', function (Blueprint $table) {
                $table->unsignedInteger('time')->default(15)->after('subtotal');
                // prep_time = minutes nécessaires pour préparer cet item
            });
        }

        // Ajouter ingredients à food si elle n'existe pas
        if (!Schema::hasColumn('food', 'ingredients')) {
            Schema::table('food', function (Blueprint $table) {
                $table->json('ingredients')->nullable()->after('image');
                // ingredients = ["farine","oeufs","lait"] en JSON
            });
        }

        // Ajouter allergenes à users si elle n'existe pas
        if (!Schema::hasColumn('users', 'allergenes')) {
            Schema::table('users', function (Blueprint $table) {
                $table->json('allergenes')->nullable()->after('total_spent');
                // allergenes = ["gluten","lactose","noix"] en JSON
            });
        }
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            if (Schema::hasColumn('order_items', 'time')) {
                $table->dropColumn('time');
            }
        });
        Schema::table('food', function (Blueprint $table) {
            if (Schema::hasColumn('food', 'ingredients')) {
                $table->dropColumn('ingredients');
            }
        });
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'allergenes')) {
                $table->dropColumn('allergenes');
            }
        });
    }
};