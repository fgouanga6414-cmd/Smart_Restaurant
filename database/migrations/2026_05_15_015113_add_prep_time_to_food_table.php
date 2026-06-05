<?php
// database/migrations/2024_01_01_000001_add_prep_time_to_foods_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
{
    Schema::table('food', function (Blueprint $table) {
        $table->unsignedInteger('prep_time')->default(15)->after('Food_price');
    });
}

public function down(): void
{
    Schema::table('food', function (Blueprint $table) {
        if (Schema::hasColumn('food', 'prep_time')) {
            $table->dropColumn('prep_time');
        }
    });
}
};