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
        Schema::create('jssi_articles_authors_institutions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained()->on('jssi_articles');
            $table->unsignedBigInteger('authors_institution_id');
            $table->foreign('authors_institution_id', 'jssi_art_aut_ins_aut_ins_id_foreign')
                ->references('id')
                ->on('jssi_authors_institutions');
            $table->integer('sequence')->unsigned();
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jssi_articles_authors_institutions');
    }
};
