<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { Schema::create('distritos', function (Blueprint $table) {
        $table->id('id_distrito'); // Esto define la columna como unsignedBigInteger y clave primaria
        $table->string('nombre_distrito', 100);
        $table->decimal('lat', 10, 8)->nullable(); // columna lat para la latitud
        $table->decimal('lng', 11, 8)->nullable(); // columna lng para la longitud
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distritos');
    }
}
