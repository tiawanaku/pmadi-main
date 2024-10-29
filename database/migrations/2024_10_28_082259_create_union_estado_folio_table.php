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
            $table->unsignedBigInteger('id_folio');
            $table->unsignedBigInteger('id_estado_folio');
            $table->primary(['id_folio', 'id_estado_folio']);
            $table->foreign('id_folio')->references('id_folio')->on('folio')->onDelete('cascade');
            $table->foreign('id_estado_folio')->references('id_estado_folio')->on('estado_folio')->onDelete('cascade');
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
