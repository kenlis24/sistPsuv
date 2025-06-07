<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cne_datos', function (Blueprint $table) {
            // Elimina el índice actual sobre la cédula sola
            $table->dropUnique('cne_datos_cne_cedula_unique'); // <-- verifica este nombre con SHOW INDEX

            // Crea el nuevo índice compuesto
            $table->unique(['cne_nac', 'cne_cedula'], 'unique_cedula');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cne_datos', function (Blueprint $table) {
            $table->dropUnique('unique_cedula');
            $table->unique('cne_cedula'); // opcional: restaura el índice original si hiciste rollback
        });
    }
};
