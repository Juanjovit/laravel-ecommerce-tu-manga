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
        Schema::create('purchases_has_mangas', function (Blueprint $table) {

            $table->foreignId('purchase_fk')->constrained('purchases', 'id');
            $table->foreignId('manga_fk')->constrained('mangas', 'id');

            $table->integer('quantity');

            $table->primary(['purchase_fk', 'manga_fk']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases_has_mangas');
    }
};
