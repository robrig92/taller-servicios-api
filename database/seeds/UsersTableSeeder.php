<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\HashHelper;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'hashId' => HashHelper::hashId(),
            'nombre' => 'Administrador',
            'email' => 'admin@mock.foo',
            'rol_id' => 1,
            'password' => Hash::make('admin'),
            'telefono' => ''
        ]);
    }
}
