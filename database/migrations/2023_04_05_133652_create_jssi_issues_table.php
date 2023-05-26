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
        Schema::create('jssi_issues', function (Blueprint $table) {
            $table->id();
            $table->integer('volume')->unsigned();
            $table->integer('number')->unsigned();
            $table->date('date');
            $table->string('doi', 30)->nullable();
            $table->string('print')->nullable();
            $table->string('online')->nullable();
            $table->string('cover')->nullable();
            $table->boolean('visible')->default(false)->unsigned();
            $table->integer('views')->default(0)->unsigned();
            $table->integer('downloads')->default(0)->unsigned();
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jssi_issues');
    }
};
