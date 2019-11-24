<?php

namespace App\Http\Controllers;

use App\Folio;
use App\Cliente;
use App\Empresa;
use App\Estatus;
use Illuminate\Http\Request;
use App\Utils\Http\HttpResponse;
use Illuminate\Support\Facades\DB;
use App\User;

class DashboardController extends Controller
{
    /**
     * Retrieves the count of the active rows of Folio, Cliente and Empresa.
     * 
     * @return \App\Utils\Http\HttpResponse
     */
    public function counts()
    {
        $folios = Folio::active()->count();
        $clientes = Cliente::enabled()->count();
        $empresas = Empresa::enabled()->count();

        return HttpResponse::ok(compact(['folios', 'clientes', 'empresas']));
    }

    /**
     * Retrieves the count of the folios by estatus.
     *
     * @return \App\Utils\Http\HttpResponse
     */
    public function foliosCountByStatus()
    {
        $folio = new Folio;
        $estatus = new Estatus;

        $folios = DB::select(DB::raw("
            select 
                {$estatus->getTable()}.estatus as estatus, 
                count({$folio->getTable()}.id) as Folios 
            from 
                `folios` 
            right join `{$estatus->getTable()}` on `{$folio->getTable()}`.`estatus_id` = `{$estatus->getTable()}`.`id`
            group by `{$estatus->getTable()}`.`id`
        "));
        
        return HttpResponse::ok(compact('folios'));
    }

    public function foliosCreatedCountByUserCreated()
    {
        $folio = new Folio;
        $user = new User;

        $folios = DB::select(DB::raw( "
            SELECT
                {$user->getTable()}.nombre as nombre,
                count({$folio->getTable()}.id ) as Folios
            FROM
                {$folio->getTable()}
            RIGHT JOIN
                {$user->getTable()} ON ({$folio->getTable()}.usuarioCreador = {$user->getTable()}.id)
            GROUP BY {$user->getTable()}.id
        "));

        return HttpResponse::ok(compact('folios'));
    }

    public function foliosAsignedCountByUserAsigned()
    {
        $folio = new Folio;
        $user = new User;

        $folios = DB::select(DB::raw("
            SELECT
                {$user->getTable()}.nombre as nombre,
                count({$folio->getTable()}.id ) as Folios
            FROM
                {$folio->getTable()}
            RIGHT JOIN
                {$user->getTable()} ON ({$folio->getTable()}.asignadoA = {$user->getTable()}.id)
            GROUP BY {$user->getTable()}.id
        "));

        return HttpResponse::ok(compact('folios'));
    }
}
