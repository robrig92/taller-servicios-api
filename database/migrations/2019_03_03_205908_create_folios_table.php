<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuarioCreador')
                ->unsigned()
                ->nullable()
                ->default(null);
            $table->integer('cliente_id')
                ->unsigned()
                ->nullable()
                ->default(null);
            $table->integer('servicio_id')
                ->unsigned()
                ->nullable()
                ->default(null);
            $table->integer('asignadoA')
                ->nullable()
                ->default(null);
            $table->decimal('cotizacion', 10, 2)
                ->default(0);
            $table->decimal('total', 10, 2)
                ->default(0);
            $table->dateTime('fechaAbre')
                ->nullable()
                ->default(null);
            $table->dateTime('fechaCierre')
                ->nullable()
                ->default(null);
            $table->integer('estatus_id')
                ->unsigned()
                ->nullable()
                ->default(null);
            $table->tinyInteger('activo')
                ->default(0);
            $table->string('numeroSerie', 255)
                ->nullable()
                ->default(null);
            $table->integer( 'tipoEquipo_id')
                ->unsigned()
                ->nullable()
                ->default(null);
            $table->integer('marca_id')
                ->unsigned()
                ->nullable()
                ->default(null);
            $table->timestamps();

            $table->foreign('usuarioCreador')
                ->references('id')
                ->on('users');
            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes');
            $table->foreign('servicio_id')
                ->references('id')
                ->on('servicios');
           $table->foreign('tipoEquipo_id')
                ->references('id')
                ->on('tipoEquipos');
            $table->foreign('marca_id')
                ->references('id')
                ->on('marcas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folios');
    }
}
