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
        Schema::create('jssi_jel_codes', function (Blueprint $table) {
            $table->id();
            $table->char('name', 4);
            $table->string('description');
            $table->unsignedBigInteger('jel_subcategory_id');

            $table->foreign('jel_subcategory_id')->references('id')->on('jssi_jel_subcategories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jssi_jel_codes');
    }
};