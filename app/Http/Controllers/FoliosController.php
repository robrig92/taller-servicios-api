<?php

namespace App\Http\Controllers;

use App\Folio;
use Illuminate\Http\Request;
use App\Utils\Http\HttpResponse;

class FoliosController extends Controller
{
    /** 
     * Obtiene todos los recursos.
     * 
     * @return \App\Utils\Http\HttpResponse
    */
    public function index()
    {
        $folios = Folio::with([
                'marca',
                'estatus',
                'cliente',
                'servicio',
                'asignadoA',
                'tipoEquipo'
            ])
            ->get();

        if (!$folios) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('folios'));
    }

    public function store(Request $request)
    {
        $args = $request->only([
            'total',
            'marca_id',
            'asignadoA',
            'cliente_id',
            'cotizacion',
            'numeroSerie',
            'diagnostico',
            'observacion',
            'servicio_id',
            'tipoEquipo_id',
            'usuarioCreador'
        ]);

        $args['activo'] = 1;
        $args['fechaAbre'] = date('Y-m-d H:i:s');
        $args['estatus_id'] = \App\Estatus::$CREADO;

        $folio = Folio::create($args);

        return HttpResponse::created(compact('folio'));
    }

    public function show($id)
    {
        $folio = Folio::with([
                'marca',
                'estatus',
                'cliente',
                'servicio',
                'asignadoA',
                'tipoEquipo'
            ])
            ->find($id);

        if (!$folio) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('folio'));
    }

    public function update(Request $request, $id)
    {
        $folio = Folio::find($id);

        if (!$folio) {
            return HttpResponse::notFound();
        }

        $folio->total = $request->total;
        $folio->marca_id = $request->marca_id;
        $folio->asignadoA = $request->asignadoA;
        $folio->cliente_id = $request->cliente_id;
        $folio->cotizacion = $request->cotizacion;
        $folio->estatus_id = $request->estatus_id;
        $folio->diagnostico = $request->diagnostico;
        $folio->numeroSerie = $request->numeroSerie;
        $folio->observacion = $request->observacion;
        $folio->servicio_id = $request->servicio_id;
        $folio->tipoEquipo_id = $request->tipoEquipo_id;

        $folio->save();

        return HttpResponse::ok(compact('folio'));
    }

    public function destroy($id)
    {
        $folio = Folio::find($id);

        if (!$folio) {
            return HttpResponse::notFound();
        }

        $folio->activo = 0;

        $folio->save();

        return HttpResponse::ok(compact('folio'));
    }
}
