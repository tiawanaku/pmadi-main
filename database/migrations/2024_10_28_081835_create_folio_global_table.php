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
        Schema::create('folio_global', function (Blueprint $table) {
            $table->id('id_folio_global');
            $table->unsignedBigInteger('id_folio');
            $table->decimal('superficie_restante', 10, 2);
            $table->string('nombre_urb_anterior', 100);
            $table->string('codigo_catastral')->nullable();
            $table->string('numero_catastro')->nullable();
            $table->json('estado_folio')->nullable(); // Cambia el tipo a JSON para almacenar arrays
            $table->string('otro_estado_folio')->nullable();
            $table->text('testimonio')->nullable();
            $table->timestamps();

            // Clave foránea a la tabla folio
            $table->foreign('id_folio')->references('id_folio')->on('folio')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folio_global');
    }
};
