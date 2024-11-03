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
            $table->string('distrito_judicial', 50); // Campo para distrito judicial
            $table->string('registro_notarial', 50); // Campo para registro notarial
            $table->text('descripcion_testimonio')->nullable(); // Descripción del testimonio

            // Campos "Otro" que se llenan si el usuario selecciona "Otro"
            $table->string('otro_registrado_testimonio')->nullable(); // Almacenar "otro" valor para registrado_por
            $table->string('otro_estado_testimonio')->nullable(); // Almacenar "otro" valor para estado_testimonio

            // Timestamps y eliminación lógica
            $table->timestamps();
            $table->softDeletes();

            // Foreign Key con la tabla notarios
            $table->foreign('id_notario')->references('id_notario')->on('notarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonios');
    }
};

