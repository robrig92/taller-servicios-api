<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estatus')->insert([
            [
                'estatus' => 'Creado'
            ],
            [
                'estatus' => 'Diagnóstico'
            ],
            [
                'estatus' => 'Cotización'
            ],
            [
                'estatus' => 'Validado'
            ],
            [
                'estatus' => 'Entregar'
            ],
            [
                'estatus' => 'Finalizado' 
            ],
            [
                'estatus' => 'Cancelado' 
            ]
        ]);
    }
}
