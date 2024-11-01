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
        Schema::create('folio', function (Blueprint $table) {
            $table->increments('id_folio'); // Clave primaria como `unsigned integer`
            $table->boolean('gravamen');
            $table->decimal('superficie', 10, 2);
            $table->string('cod_catastral', 100);
            $table->string('nro_folio', 50);
            $table->unsignedBigInteger('id_tipo_registro');
            $table->unsignedBigInteger('id_urb_actual');
            $table->unsignedBigInteger('id_testimonio');

            // Claves foráneas hacia otras tablas
            $table->foreign('id_urb_actual')->references('id_urb_actual')->on('urbanizacion_actual')->onDelete('cascade');
            $table->foreign('id_tipo_registro')->references('id')->on('tipo_registro')->onDelete('cascade');
            $table->foreign('id_testimonio')->references('id_testimonio')->on('testimonios')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folio');
    }
};
