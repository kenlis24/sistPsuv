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
        Schema::create('cne_datos', function (Blueprint $table) {
            $table->id();

            $table->string('cne_estado', 250);
            $table->string('cne_municipio', 250);
            $table->string('cne_cod_centro', 100);
            $table->string('cne_centro', 250);
            $table->string('cne_nac', 1);
            $table->string('cne_cedula', 10);
            $table->string('cne_nombres', 250);
            $table->string('cne_sexo', 1);
            $table->date('cne_fecha_nac');            

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
        Schema::dropIfExists('cne_datos');
    }
};
