<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableServicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuarioCreador')
                ->unsigned()
                ->nullable()
                ->default(null);
            $table->string('descripcion');
            $table->decimal('precio', 10, 2);
            $table->string('observaciones')->default('');
            $table->decimal('tiempoPromedio', 10, 2);
            $table->tinyInteger("enabled")->default(1);
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
        Schema::dropIfExists('servicios');
    }
}
