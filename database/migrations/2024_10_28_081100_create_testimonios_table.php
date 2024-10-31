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
        // Creación de la tabla notarios
        Schema::create('notarios', function (Blueprint $table) {
            $table->id('id_notario'); // Usar 'id_notario' como clave primaria
            $table->string('nombre_completo', 100);
            $table->string('nro_notaria', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Verificar si la tabla 'testimonios' y la clave foránea existen antes de intentar eliminar
        if (Schema::hasTable('testimonios')) {
            Schema::table('testimonios', function (Blueprint $table) {
                // Solo intentamos eliminar la clave foránea si existe
                if (Schema::hasColumn('testimonios', 'id_notario')) {
                    $table->dropForeign(['id_notario']); // Eliminar la clave foránea
                    $table->dropColumn('id_notario');    // Eliminar la columna
                }
            });
        }

        Schema::dropIfExists('notarios'); // Elimina la tabla 'notarios'
    }
};
