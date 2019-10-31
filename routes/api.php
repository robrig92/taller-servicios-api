<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group([
    'prefix' => 'roles',
    'middleware' => ['jwt']
], function () {
    Route::get('/', 'RolesController@index')
        ->middleware(['access.manager:Roles|Folios']);
    Route::post('/', 'RolesController@store')
        ->middleware(['access.manager:Roles']);
    Route::get('/{id}', 'RolesController@show')
        ->middleware(['access.manager:Roles']);
    Route::patch('/{id}', 'RolesController@update')
        ->middleware(['access.manager:Roles']);
    Route::delete('/{id}', 'RolesController@destroy')
        ->middleware(['access.manager:Roles']);
    Route::post('/{id}/permisos', 'RolesController@storePermiso')
        ->middleware(['access.manager:Roles']);
    Route::delete('/{id}/permisos', 'RolesController@destroyPermiso')
        ->middleware(['access.manager:Roles']);
});

Route::group([
    'prefix' => 'marcas',
    'middleware' => ['jwt']
], function () {
    Route::get('/', 'MarcasController@index')
        ->middleware(['access.manager:Marcas|Folios']);
    Route::post('/', 'MarcasController@store')
        ->middleware(['access.manager:Marcas']);
    Route::get('/{id}', 'MarcasController@show')
        ->middleware(['access.manager:Marcas']);
    Route::patch('/{id}', 'MarcasController@update')
        ->middleware(['access.manager:Marcas']);
    Route::delete('/{id}', 'MarcasController@destroy')
        ->middleware(['access.manager:Marcas']);
});

Route::group([
    'prefix' => 'usuarios',
    'middleware' => ['jwt']
], function () {
    Route::get('/', 'UsersController@index')
        ->middleware(['access.manager:Usuarios|Folios']);
    Route::post('/', 'UsersController@store')
        ->middleware(['access.manager:Usuarios']);
    Route::get('/{id}', 'UsersController@show')
        ->middleware(['access.manager:Usuarios']);
    Route::patch('/{id}', 'UsersController@update')
        ->middleware(['access.manager:Usuarios']);
    Route::delete('/{id}', 'UsersController@destroy')
        ->middleware(['access.manager:Usuarios']);
    Route::get('/file/{id}', 'UsersController@publicPath')
        ->middleware(['access.manager:Usuarios']);
});

Route::group([
    'prefix' => 'tipoequipos',
    'middleware' => ['jwt']
], function () {
    Route::get('/', 'TipoEquiposController@index')
        ->middleware(['access.manager:Equipos|Folios']);
    Route::post('/', 'TipoEquiposController@store')
        ->middleware(['access.manager:Equipos']);
    Route::get('/{id}', 'TipoEquiposController@show')
        ->middleware(['access.manager:Equipos']);
    Route::patch('/{id}', 'TipoEquiposController@update')
        ->middleware(['access.manager:Equipos']);
    Route::delete('/{id}', 'TipoEquiposController@destroy')
        ->middleware(['access.manager:Equipos']);
});

Route::group([
    'prefix' => 'servicios',
    'middleware' => ['jwt']
], function () {
    Route::get('/', 'ServiciosController@index')
        ->middleware(['access.manager:Servicios|Folios']);
    Route::post('/', 'ServiciosController@store')
        ->middleware(['access.manager:Servicios']);
    Route::get('/{id}', 'ServiciosController@show')
        ->middleware(['access.manager:Servicios']);
    Route::patch('/{id}', 'ServiciosController@update')
        ->middleware(['access.manager:Servicios']);
    Route::delete('/{id}', 'ServiciosController@destroy')
        ->middleware(['access.manager:Servicios']);
});

Route::group([
    'prefix' => 'empresas',
    'middleware' => ['jwt']
], function () {
    Route::get('/', 'EmpresasController@index')
        ->middleware(['access.manager:Empresas']);
    Route::post('/', 'EmpresasController@store')
        ->middleware(['access.manager:Empresas']);
    Route::get('/{id}', 'EmpresasController@show')
        ->middleware(['access.manager:Empresas']);
    Route::patch('/{id}', 'EmpresasController@update')
        ->middleware(['access.manager:Empresas']);
    Route::delete('/{id}', 'EmpresasController@destroy')
        ->middleware(['access.manager:Empresas']);
});

Route::group([
    'prefix' => 'clientes',
    'middleware' => ['jwt']
], function () {
    Route::get('/', 'ClientesController@index')
        ->middleware(['access.manager:Clientes|Folios']);
    Route::post('/', 'ClientesController@store')
        ->middleware(['access.manager:Clientes']);
    Route::get('/{id}', 'ClientesController@show')
        ->middleware(['access.manager:Clientes']);
    Route::patch('/{id}', 'ClientesController@update')
        ->middleware(['access.manager:Clientes']);
    Route::delete('/{id}', 'ClientesController@destroy')
        ->middleware(['access.manager:Clientes']);
});

Route::group([
    'prefix' => 'folios',
    'middleware' => ['jwt']
], function () {
    Route::get('/', 'FoliosController@index')
        ->middleware(['access.manager:Folios']);
    Route::post('/', 'FoliosController@store')
        ->middleware(['access.manager:Folios']);
    Route::get('/{id}', 'FoliosController@show')
        ->middleware(['access.manager:Folios']);
    Route::patch('/{id}', 'FoliosController@update')
        ->middleware(['access.manager:Folios']);
    Route::delete('/{id}', 'FoliosController@destroy')
        ->middleware(['access.manager:Folios']);
});

Route::group([
    'prefix' => 'estatus',
    'middleware' => ['jwt']
], function () {
    Route::get('/', 'EstatusController@index')
        ->middleware(['access.manager:Estatus|Folios']);
    Route::post('/', 'EstatusController@store')
        ->middleware(['access.manager:Estatus']);
    Route::get('/{id}', 'EstatusController@show')
        ->middleware(['access.manager:Estatus']);
    Route::patch('/{id}', 'EstatusController@update')
        ->middleware(['access.manager:Estatus']);
    Route::delete('/{id}', 'EstatusController@destroy')
        ->middleware(['access.manager:Estatus']);
});

Route::group([
    'prefix' => 'dashboard',
    'middleware' => ['jwt']
], function() {
    Route::get('/counts', 'DashboardController@counts')
        ->middleware(['access.manager:Dashboard']);
    Route::get('/folios/status', 'DashboardController@foliosCountByStatus')
        ->middleware(['access.manager:Dashboard']);
    Route::get('/folios/created', 'DashboardController@foliosCreatedCountByUserCreated')
        ->middleware(['access.manager:Dashboard']);
    Route::get('/folios/asigned', 'DashboardController@foliosAsignedCountByUserAsigned')
        ->middleware(['access.manager:Dashboard']);
});

Route::group([
    'prefix' => 'permisos',
    'middleware' => ['jwt']
], function () {
    Route::get('/', 'PermisosController@index')
        ->middleware(['access.manager:Roles']);
});