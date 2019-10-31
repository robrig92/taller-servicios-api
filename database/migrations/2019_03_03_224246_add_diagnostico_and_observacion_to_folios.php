<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiagnosticoAndObservacionToFolios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('folios', function (Blueprint $table) {
            $table->longText('diagnostico')
                ->nullable()
                ->default(null);
            $table->string('observacion', 255)
                ->nullable()
                ->default(null);;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('folios', function (Blueprint $table) {
            $table->dropColumn('diagnostico');
            $table->dropColumn('observacion');
        });
    }
}
