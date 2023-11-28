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
        Schema::create('sectores_personas', function (Blueprint $table) {
            $table->id();

            $table->string('secp_nac', 1);
            $table->string('secp_cedula', 10);
            $table->string('secp_nombres', 200);
            $table->string('secp_telefono', 50);
            $table->string('secp_estado', 200)->nullable();
            $table->string('secp_municipio', 200)->nullable();
            $table->string('secp_parroquia', 200)->nullable();
            $table->string('secp_centro', 200)->nullable();
            $table->string('secp_tipo_reg', 200);
            $table->unsignedBigInteger('secp_sec_id');
            $table->foreign('secp_sec_id')
                ->references('id')
                ->on('sectores')
                ->onDelete('cascade');
            $table->unsignedBigInteger('secp_municipio_carga');
            $table->foreign('secp_municipio_carga')
                ->references('id')
                ->on('municipios')
                ->onDelete('cascade');
            $table->string('secp_usuario_creo', 100);

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
        Schema::dropIfExists('sectores_personas');
    }
};
