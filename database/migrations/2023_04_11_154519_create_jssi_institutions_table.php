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
        Schema::create('jssi_institutions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('website')->nullable();
            $table->string('city', 100)->nullable();
            $table->foreignId('country_id')->constrained()->on('jssi_countries');
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jssi_institutions');
    }
};
