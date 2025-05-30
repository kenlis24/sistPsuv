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
        Schema::table('cne_datos', function (Blueprint $table) {
            $table->string('cne_cedula',10)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cne_datos', function (Blueprint $table) {
            $table->string('cne_cedula',10)->unique()->change();
        });
    }
};
