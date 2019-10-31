<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permisos')->insert([
            [
                'nombre' => 'Dashboard',
                'descripcion' => 'Permite acceder al contenido del Dashboard'
            ], 
            [
                'nombre' => 'Clientes',
                'descripcion' => 'Permite acceder al contenido de Clientes'
            ],
            [
                'nombre' => 'Equipos',
                'descripcion' => 'Permite acceder al contenido de Equipos'
            ],
            [
                'nombre' => 'Empresas',
                'descripcion' => 'Permite acceder al contenido de Empresas'
            ],
            [
                'nombre' => 'Folios',
                'descripcion' => 'Permite acceder al contenido de Folios'
            ],
            [
                'nombre' => 'Marcas',
                'descripcion' => 'Permite acceder al contenido de Marcas'
            ],
            [
                'nombre' => 'Roles',
                'descripcion' => 'Permite acceder al contenido de Roles'
            ],
            [
                'nombre' => 'Servicios',
                'descripcion' => 'Permite acceder al contenido de Servicios'
            ],
            [
                'nombre' => 'Usuarios',
                'descripcion' => 'Permite acceder al contenido de Usuarios'
            ]
        ]);
    }
}
