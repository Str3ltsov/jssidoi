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
        Schema::create('jssi_authors_institutions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained()->on('jssi_authors');
            $table->foreignId('institution_id')->constrained()->on('jssi_institutions');
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jssi_authors_institutions');
    }
};
