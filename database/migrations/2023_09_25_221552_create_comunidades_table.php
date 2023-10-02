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
        Schema::create('comunidades', function (Blueprint $table) {
            $table->id();

            $table->string('com_codigo', 100)->unique();
            $table->string('com_nombre', 250);
            $table->string('com_estado', 1);

            $table->unsignedBigInteger('com_agr_id');
            $table->foreign('com_agr_id')
                ->references('id')
                ->on('agrupaciones')
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
        Schema::dropIfExists('comunidades');
    }
};
