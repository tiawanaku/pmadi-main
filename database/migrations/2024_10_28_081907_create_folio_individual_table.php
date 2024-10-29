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
        Schema::create('folio_individual', function (Blueprint $table) {
            $table->id('id_folio_individual');
            $table->unsignedBigInteger('id_folio');
            $table->unsignedBigInteger('id_folio_global');
            $table->foreign('id_folio')->references('id_folio')->on('folio')->onDelete('cascade');
            $table->foreign('id_folio_global')->references('id_folio_global')->on('folio_global')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folio_individual');
    }
};
