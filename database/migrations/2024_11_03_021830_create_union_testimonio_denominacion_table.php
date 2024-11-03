<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnionTestimonioDenominacionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('union_testimonio_denominacion', function (Blueprint $table) {
            $table->unsignedBigInteger('id_testimonio');
            $table->unsignedBigInteger('id_denominacion');
            $table->primary(['id_testimonio', 'id_denominacion']);

            $table->foreign('id_testimonio')->references('id_testimonio')->on('testimonios')->onDelete('cascade');
            $table->foreign('id_denominacion')->references('id_denominacion')->on('denomination')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('union_testimonio_denominacion');
    }
}
