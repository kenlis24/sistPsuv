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
        Schema::table('sectores_personas', function (Blueprint $table) {
            $table->unsignedBigInteger('secp_cargos_id')->after('secp_sec_id');
            $table->foreign('secp_cargos_id')
                ->references('id')
                ->on('sector_cargos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sectores_personas', function (Blueprint $table) {
            $table->dropColumn('secp_cargos_id');
        });
    }
};
