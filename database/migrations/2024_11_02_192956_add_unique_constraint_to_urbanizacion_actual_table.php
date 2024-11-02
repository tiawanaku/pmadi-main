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
        Schema::table('urbanizacion_actual', function (Blueprint $table) {
            $table->unique(['nombre_urb_actual', 'id_distrito'], 'unique_nombre_urb_actual_id_distrito');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('urbanizacion_actual', function (Blueprint $table) {
            $table->dropUnique('unique_nombre_urb_actual_id_distrito');
        });
    }
};
