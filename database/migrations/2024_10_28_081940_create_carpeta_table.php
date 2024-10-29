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
        Schema::create('carpeta', function (Blueprint $table) {
            $table->id('id_carpeta');
            $table->integer('nro_carpeta');
            $table->unsignedBigInteger('id_urb_actual');
            $table->unsignedBigInteger('id_folio');
            $table->foreign('id_urb_actual')->references('id_urb_actual')->on('urbanizacion_actual')->onDelete('cascade');
            $table->foreign('id_folio')->references('id_folio')->on('folio')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carpeta');
    }
};
