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
        Schema::create('mangas', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('en_alternative_title', 100);
            $table->string('es_alternative_title', 100);
            $table->text('synopsis');
            $table->unsignedInteger('price');
            $table->datetime('release_date');
            $table->string('cover', 255)->nullable();
            $table->string('cover_description', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mangas');
    }
};
