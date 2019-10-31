<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permiso;
use App\Utils\Http\HttpResponse;

class PermisosController extends Controller
{
    public function index()
    {
        $permisos = Permiso::all();

        if (!$permisos) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('permisos'));
    }
}
