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
        Schema::create('jssi_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('issue_id')->constrained()->on('jssi_issues');
            $table->foreignId('article_type_id')->constrained()->on('jssi_article_types');
            $table->text('title');
            $table->date('received')->nullable();
            $table->date('accepted')->nullable();
            $table->date('published')->nullable();
            $table->text('abstract')->nullable();
            $table->longText('content')->nullable();
            $table->integer('start_page')->default(0)->unsigned()->nullable();
            $table->integer('end_page')->default(0)->unsigned()->nullable();
            $table->string('file')->nullable();
            $table->string('doi')->nullable();
            $table->string('elsevierid', 50)->nullable();
            $table->string('hal', 15)->nullable();
            $table->text('note')->nullable();
            $table->text('funding')->nullable();
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
        Schema::dropIfExists('jssi_articles');
    }
};
