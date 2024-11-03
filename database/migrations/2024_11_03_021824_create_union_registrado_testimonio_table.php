<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnionRegistradoTestimonioTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('union_registrado_testimonio', function (Blueprint $table) {
            $table->unsignedBigInteger('id_testimonio');
            $table->unsignedBigInteger('id_registrado_por');
            $table->primary(['id_testimonio', 'id_registrado_por']);

            $table->foreign('id_testimonio')->references('id_testimonio')->on('testimonios')->onDelete('cascade');
            $table->foreign('id_registrado_por')->references('id_registrado_por')->on('registrado_por')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('union_registrado_testimonio');
    }
}
