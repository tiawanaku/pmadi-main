<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnionEstadoTestimonioTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
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
        Schema::dropIfExists('union_estado_testimonio');
    }
}

