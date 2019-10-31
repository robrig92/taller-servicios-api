<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\HashHelper;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'enabled' => 1,
                'hashId' => HashHelper::hashId(),
                'nombre' => 'Administrador'
            ],
            [
                'enabled' => 1,
                'hashId' => HashHelper::hashId(),
                'nombre' => 'Técnico'
            ]
        ]);
    }
}
