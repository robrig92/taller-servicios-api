<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->tinyInteger('enabled')->default(1);
            $table->string('hashId');
            $table->integer('usuarioCreador')
                ->unsigned()
                ->nullable()
                ->default(null);
            $table->string('nombre');
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
        Schema::dropIfExists('roles');
    }
}
