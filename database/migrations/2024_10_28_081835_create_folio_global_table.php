<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFolioGlobalTable extends Migration
{
    public function up()
    {
        Schema::create('folio_global', function (Blueprint $table) {
            $table->id('id_folio_global');
            $table->unsignedInteger('id_folio');
            $table->float('superficie_restante')->nullable();
            $table->string('nombre_urb_anterior')->nullable();
            $table->timestamps();

            // relación con `folio`
            $table->foreign('id_folio')->references('id_folio')->on('folio')->onDelete('cascade');

            // `id_folio_individual` sin la relación en este paso
            $table->unsignedBigInteger('id_folio_individual')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('folio_global');
    }
}
