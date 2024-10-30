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
        Schema::create('urbanizacion_actual', function (Blueprint $table) {
            $table->id('id_urb_actual');
            $table->string('nombre_urb_actual', 100);
            $table->unsignedBigInteger('id_distrito');
            $table->foreign('id_distrito')->references('id_distrito')->on('distritos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urbanizacion_actual');
    }
};
