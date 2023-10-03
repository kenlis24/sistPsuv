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
        Schema::create('militancias', function (Blueprint $table) {
            $table->id();
            $table->string('mil_nac', 1);
            $table->string('mil_cedula', 10);
            $table->string('mil_nombres', 100);
            $table->string('mil_apellidos', 100);
            $table->string('mil_telefono', 100);
            $table->string('mil_municipio', 300)->nullable();
            $table->string('mil_parroquia', 300)->nullable();
            $table->string('mil_centro', 300)->nullable();
            $table->string('mil_tipo_reg', 100);
            $table->date('mil_fecha');
            $table->unsignedBigInteger('mil_id');
            $table->string('mil_tipo_nivel', 100);
            $table->string('mil_lugar', 500);
            $table->string('mil_usua_crea', 100);
            $table->unsignedBigInteger('mil_eve_id');
            $table->foreign('mil_eve_id')
                ->references('id')
                ->on('eventos')
                ->onDelete('cascade');

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
        Schema::dropIfExists('militancias');
    }
};
