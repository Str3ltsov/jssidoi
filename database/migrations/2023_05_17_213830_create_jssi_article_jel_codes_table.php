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
        Schema::create('jssi_article_jel_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('jel_code_id');

            $table->foreign('article_id')->references('id')->on('jssi_articles')->onDelete('cascade');
            $table->foreign('jel_code_id')->references('id')->on('jssi_jel_codes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jssi_article_jel_codes');
    }
};