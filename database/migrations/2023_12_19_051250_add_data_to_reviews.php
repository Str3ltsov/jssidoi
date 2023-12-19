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
        Schema::table('jssi_reviews', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('content');
            $table->dropColumn('isVisible');
            $table->dropColumn('author_id');

            $table->foreignId('reviewer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('evaluation', 50);
            $table->string('originality', 50);
            $table->string('methodology', 50);
            $table->string('structure', 50);
            $table->string('language', 50);
            $table->string('advice', 50);
            $table->text('generalComment');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jssi_reviews', function (Blueprint $table) {
            $table->dropForeign(['reviewer_id']);
            $table->dropColumn('reviewer_id');
            $table->dropColumn('evaluation');
            $table->dropColumn('originality');
            $table->dropColumn('methodology');
            $table->dropColumn('structure');
            $table->dropColumn('language');
            $table->dropColumn('advice');
            $table->dropColumn('generalComment');

        });
    }
};
