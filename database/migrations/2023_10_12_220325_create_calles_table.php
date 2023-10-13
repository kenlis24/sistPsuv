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
        Schema::create('calles', function (Blueprint $table) {
            $table->id();

            $table->string('cal_codigo', 100)->unique();
            $table->string('cal_nombre', 250);
            $table->string('cal_estado', 1);

            $table->unsignedBigInteger('cal_com_id');
            $table->foreign('cal_com_id')
                ->references('id')
                ->on('comunidades')
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
        Schema::dropIfExists('calles');
    }
};
