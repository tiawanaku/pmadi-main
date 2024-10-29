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
    {
        Schema::create('distritos', function (Blueprint $table) {
            $table->id();  // Campo "id" como clave primaria autoincrementable
            $table->string('nombre_distrito');  // Campo "nombre_distrito" de tipo string para almacenar el nombre del distrito
            $table->timestamps();  // Campos "created_at" y "updated_at" automáticos
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
