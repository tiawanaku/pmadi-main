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
        // Verificar si la tabla ya existe antes de crearla
        if (!Schema::hasTable('denomination')) {
            Schema::create('denomination', function (Blueprint $table) {
                $table->id('id_denominacion');
                $table->string('descripcion', 100);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denomination'); // Corregir el nombre de la tabla
    }
};
