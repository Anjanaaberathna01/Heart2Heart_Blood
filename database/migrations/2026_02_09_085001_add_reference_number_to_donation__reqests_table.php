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
        if (!Schema::hasColumn('donation_requests', 'reference_number')) {
            Schema::table('donation_requests', function (Blueprint $table) {
                $table->string('reference_number')->nullable()->after('id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('donation_requests', 'reference_number')) {
            Schema::table('donation_requests', function (Blueprint $table) {
                $table->dropColumn('reference_number');
            });
        }
    }
};