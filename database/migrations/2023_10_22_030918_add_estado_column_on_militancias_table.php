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
        Schema::table('militancias', function (Blueprint $table) {
            $table->string('mil_estado', 300)->nullable()->after('mil_telefono');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('militancias', function (Blueprint $table) {
            $table->dropColumn('mil_estado');
        });
    }
};
