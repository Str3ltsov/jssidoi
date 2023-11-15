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
        Schema::create('jssi_reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->integer('article_id')->references('id')->on('jssi_articles')->cascadeOnUpdate()->nullOnDelete();
            $table->string('title', 255);
            $table->text('content');
            $table->boolean('isVisible')->default(false)->unsigned();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
