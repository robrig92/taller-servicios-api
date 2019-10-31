<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTipoEquipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipoEquipos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo');
            $table->integer('usuarioCreador')
                ->unsigned()
                ->nullable()
                ->default(null);
            $table->string('hashId');
            $table->tinyInteger('enabled')
                ->default(1);
            $table->timestamps();

            $table->foreign('usuarioCreador')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipoEquipos');
    }
}
