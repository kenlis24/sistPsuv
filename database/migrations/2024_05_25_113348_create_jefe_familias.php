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
        Schema::create('jefe_familias', function (Blueprint $table) {
            $table->id();

            $table->string('jfal_nac', 1);
            $table->string('jfal_cedula', 10);
            $table->string('jfal_nombres', 200);
            $table->string('jfal_telefono', 50);
            $table->string('jfal_direccion', 250);    
            $table->string('jfal_estado', 200)->nullable();
            $table->string('jfal_municipio', 200)->nullable();
            $table->string('jfal_parroquia', 200)->nullable();
            $table->string('jfal_centro', 200)->nullable(); 
            $table->string('jfal_tipo_reg', 200);
                   
            $table->unsignedBigInteger('jfal_calle_id');
            $table->string('jfal_usuario_creo', 100);

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
        Schema::dropIfExists('jefe_familias');
    }
};
