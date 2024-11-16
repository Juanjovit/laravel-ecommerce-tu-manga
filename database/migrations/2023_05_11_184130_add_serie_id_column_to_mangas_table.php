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
        Schema::table('mangas', function (Blueprint $table) {
            $table->unsignedSmallInteger('serie_fk')->after('id');

            $table->foreign('serie_fk')->references('id')->on('series');        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mangas', function (Blueprint $table) {
            //
        });
    }
};
