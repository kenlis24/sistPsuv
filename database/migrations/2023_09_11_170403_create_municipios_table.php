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
        Schema::create('municipios', function (Blueprint $table) {
            $table->id();
            $table->string('mun_codigo', 100)->unique();
            $table->string('mun_nombre', 250);
            $table->string('mun_estado', 1);

            $table->unsignedBigInteger('mun_edo_id');
            $table->foreign('mun_edo_id')
                ->references('id')
                ->on('estados')
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
        Schema::dropIfExists('municipios');
    }
};
