<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'service_fee')) {
                $table->decimal('service_fee', 8, 2)->default(10)->after('tax');
            }
            if (!Schema::hasColumn('orders', 'discount_used')) {
                $table->decimal('discount_used', 8, 2)->default(0)->after('service_fee');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['service_fee', 'discount_used']);
        });
    }
};