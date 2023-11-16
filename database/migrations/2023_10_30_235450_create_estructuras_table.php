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
        Schema::create('estructuras', function (Blueprint $table) {

            $table->id();

            $table->string('est_nac', 1);
            $table->string('est_cedula', 10);
            $table->string('est_nombres', 200);
            $table->string('est_telefono', 50);
            $table->string('est_direccion', 250);
            $table->string('est_estado', 200);
            $table->string('est_municipio', 200);
            $table->string('est_parroquia', 200);
            $table->string('est_centro', 200);
            
            $table->unsignedBigInteger('est_car_id');
            $table->foreign('est_car_id')
                ->references('id')
                ->on('cargos')
                ->onDelete('cascade');
            $table->unsignedBigInteger('est_nivel_id');
            $table->string('est_nivel', 100);
            $table->string('est_usuario_creo', 100);
            $table->string('est_municipio_usu', 200);

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
        Schema::dropIfExists('estructuras');
    }
};
