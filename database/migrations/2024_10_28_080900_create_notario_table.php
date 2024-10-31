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
        // Creación de la tabla testimonios
        Schema::create('testimonios', function (Blueprint $table) {
            $table->id('id_testimonio'); // Primary Key
            $table->string('nro_testimonio', 20); // Número de testimonio
            $table->unsignedBigInteger('id_notario')->nullable(); // Relación con tabla notarios
            $table->string('distrito_judicial', 50); // Campo como string sin relación
            $table->string('registro_notarial', 50); // Campo como string sin relación
            $table->text('descripcion_testimonio')->nullable(); // Descripción del testimonio
            $table->unsignedBigInteger('id_registrado_por')->nullable(); // Registrado por

            // Timestamps y eliminación lógica
            $table->timestamps();
            $table->softDeletes();

            // Foreign Keys (Relaciones con otras tablas)
            $table->foreign('id_notario')->references('id_notario')->on('notarios')->onDelete('cascade'); // Cambiado a 'notarios'
            $table->foreign('id_registrado_por')->references('id_registrado_por')->on('registrado_por')->onDelete('set null');
        });

        // Creación de tabla de unión para "denominaciones" (muchos a muchos)
        Schema::create('union_testimonio_denominacion', function (Blueprint $table) {
            $table->unsignedBigInteger('id_testimonio');
            $table->unsignedBigInteger('id_denominacion');
            $table->primary(['id_testimonio', 'id_denominacion']);

            $table->foreign('id_testimonio')->references('id_testimonio')->on('testimonios')->onDelete('cascade');
            $table->foreign('id_denominacion')->references('id_denominacion')->on('denominacion')->onDelete('cascade');
        });

        // Creación de tabla de unión para "estado_testimonio" (muchos a muchos)
        Schema::create('union_estado_testimonio', function (Blueprint $table) {
            $table->unsignedBigInteger('id_testimonio');
            $table->unsignedBigInteger('id_estado_testimonio');
            $table->primary(['id_testimonio', 'id_estado_testimonio']);

            $table->foreign('id_testimonio')->references('id_testimonio')->on('testimonios')->onDelete('cascade');
            $table->foreign('id_estado_testimonio')->references('id_estado_testimonio')->on('estado_testimonio')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar tablas de unión solo si existen
        if (Schema::hasTable('union_estado_testimonio')) {
            Schema::dropIfExists('union_estado_testimonio');
        }

        if (Schema::hasTable('union_testimonio_denominacion')) {
            Schema::dropIfExists('union_testimonio_denominacion');
        }

        // Verificar si existe 'testimonios' antes de eliminarla
        if (Schema::hasTable('testimonios')) {
            Schema::dropIfExists('testimonios');
        }
    }
};
