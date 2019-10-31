<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('enabled')
                ->default(1);
            $table->integer('usuarioCreador')
                ->unsigned()
                ->nullable();
            $table->string('nombre', 100);
            $table->string('razonSocial');
            $table->string('direccion');
            $table->string('telefono', 100);
            $table->string('email', 100);
            $table->timestamps();

            $table->foreign('usuarioCreador')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
