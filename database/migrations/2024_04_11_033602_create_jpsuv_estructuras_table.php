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
        Schema::create('jpsuv_estructuras', function (Blueprint $table) {
            $table->id();

            $table->string('estj_nac', 1);
            $table->string('estj_cedula', 10);
            $table->string('estj_nombres', 200);
            $table->string('estj_telefono', 50);
            $table->string('estj_direccion', 250);
            $table->string('estj_estado', 200)->nullable();
            $table->string('estj_municipio', 200)->nullable();
            $table->string('estj_parroquia', 200)->nullable();
            $table->string('estj_centro', 200)->nullable();
            
            $table->unsignedBigInteger('estj_car_id');
            $table->foreign('estj_car_id')
                ->references('id')
                ->on('jpsuv_cargos')
                ->onDelete('cascade');
            $table->unsignedBigInteger('estj_nivel_id');
            $table->string('estj_nivel', 100);
            $table->string('estj_usuario_creo', 100);
            $table->string('estj_municipio_usu', 200);
            $table->string('estj_tipo_reg', 200);

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
        Schema::dropIfExists('jpsuv_estructuras');
    }
};