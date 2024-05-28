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
        Schema::create('poblacion_familias', function (Blueprint $table) {
            $table->id();

            $table->string('pofa_nac', 1);
            $table->string('pofa_cedula', 10);
            $table->string('pofa_nombres', 200);
            $table->string('pofa_telefono', 50);   
            $table->date('pofa_fech_nac')->nullable();
            $table->string('pofa_estado', 200)->nullable();
            $table->string('pofa_municipio', 200)->nullable();
            $table->string('pofa_parroquia', 200)->nullable();
            $table->string('pofa_centro', 200)->nullable(); 
            $table->string('pofa_tipo_reg', 200);            
                   
            $table->unsignedBigInteger('pofa_calle_id');
            $table->unsignedBigInteger('pofa_jefe_id');
            $table->string('pofa_usuario_creo', 100);

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
        Schema::dropIfExists('poblacion_familias');
    }
};
