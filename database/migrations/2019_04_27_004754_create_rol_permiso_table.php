<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolPermisoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol_permiso', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rol_id')
                ->nullable()
                ->unsigned()
                ->default(null);
            $table->integer('permiso_id')
                ->nullable()
                ->unsigned()
                ->default(null);
            $table->timestamps();

            $table->foreign('rol_id')
                ->references('id')
                ->on('roles');
            $table->foreign('permiso_id')
                ->references('id')
                ->on('permisos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol_permiso');
    }
}
