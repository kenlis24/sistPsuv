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
            $table->string('est_tipo_reg', 200)->after('est_municipio_usu');;
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
            $table->dropColumn('est_tipo_reg');
        });
    }
};
