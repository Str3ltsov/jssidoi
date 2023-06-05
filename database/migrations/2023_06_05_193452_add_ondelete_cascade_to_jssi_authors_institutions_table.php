<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jssi_authors_institutions', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['institution_id']);

            $table->foreign('author_id')
                ->references('id')->on('jssi_authors')
                ->onDelete('cascade');

            $table->foreign('institution_id')
                ->references('id')->on('jssi_institutions')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jssi_authors_institutions', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['institution_id']);

            $table->foreignId('author_id')->constrained()->on('jssi_authors');
            $table->foreignId('institution_id')->constrained()->on('jssi_institutions');
        });
    }
};