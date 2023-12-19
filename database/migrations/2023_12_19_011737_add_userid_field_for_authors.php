<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jssi_authors', function ($table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jssi_authors', function ($table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

        });

    }
};
