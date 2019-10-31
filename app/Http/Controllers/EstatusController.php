<?php

namespace App\Http\Controllers;

use App\Estatus;
use Illuminate\Http\Request;
use App\Utils\Http\HttpResponse;

class EstatusController extends Controller
{
    /** 
     * Obtien e todos los recursos.
     *
     * @return \App\Utils\Http\HttpResponse
     */
    public function index()
    {
        $estatus = Estatus::all();

        if (!$estatus) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('estatus'));
    }

    public function show($id)
    {
        $estatus = Estatus::find($id);

        if (!$estatus) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('estatus'));
    }
}
