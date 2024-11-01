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
        Schema::create('union_estado_folio', function (Blueprint $table) {
            // Clave foránea hacia `folio`
            $table->unsignedInteger('id_folio'); // Debe coincidir con el tipo en `folio`
            $table->foreign('id_folio')->references('id_folio')->on('folio')->onDelete('cascade');

            // Clave foránea hacia `estado_folio`
            $table->unsignedBigInteger('id_estado_folio'); // Debe coincidir con el tipo en `estado_folio`
            $table->foreign('id_estado_folio')->references('id_estado_folio')->on('estado_folio')->onDelete('cascade');

            // Clave primaria compuesta
            $table->primary(['id_folio', 'id_estado_folio']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('union_estado_folio');
    }
};
