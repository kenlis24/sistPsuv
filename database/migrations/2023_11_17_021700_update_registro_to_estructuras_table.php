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
        Schema::table('estructuras', function (Blueprint $table) {
            $table->string('est_estado', 200)->nullable()->change();
            $table->string('est_municipio', 200)->nullable()->change();
            $table->string('est_parroquia', 200)->nullable()->change();
            $table->string('est_centro', 200)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estructuras', function (Blueprint $table) {
            $table->string('est_estado', 200)->nullable(false)->change();
            $table->string('est_municipio', 200)->nullable(false)->change();
            $table->string('est_parroquia', 200)->nullable(false)->change();
            $table->string('est_centro', 200)->nullable(false)->change();
        });
    }
};
