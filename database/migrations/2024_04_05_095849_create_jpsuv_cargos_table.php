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
        Schema::create('jpsuv_cargos', function (Blueprint $table) {
            $table->id();

            $table->string('carj_cargo', 250);
            $table->string('carj_nivel', 100);
            $table->string('carj_cantidad', 10);
            $table->string('carj_estado', 1);
            
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
        Schema::dropIfExists('jpsuv_cargos');
    }
};
