<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('enabled');
            $table->text('hashId');
            $table->integer('usuarioCreador')
                ->unsigned()
                ->nullable()
                ->default(null);
            $table->string('nombreContacto', 100);
            $table->string('nombreComercial', 120);
            $table->string('direccion');
            $table->string('telefono', 100);
            $table->string('email', 100);
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
        Schema::dropIfExists('clientes');
    }
}
