<?php

namespace App\Http\Controllers;

use App\Servicio;
use Illuminate\Http\Request;
use App\Utils\Http\HttpResponse;

class ServiciosController extends Controller
{
    /** 
     * Obtiene todos los recursos.
     * 
     * @return \App\Utils\Http\HttpResponse
    */
    public function index()
    {
        $servicios = Servicio::enabled()->get();

        if (!$servicios) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('servicios'));
    }

    public function store(Request $request)
    {
        $args = $request->only([
            'usuarioCreador',
            'descripcion',
            'precio',
            'observaciones',
            'tiempoPromedio',
            'enabled'
        ]);

        $servicio = Servicio::create($args);

        return HttpResponse::created(compact('servicio'));
    }

    public function show($id)
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('servicio'));
    }

    public function update(Request $request, $id)
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            return HttpResponse::notFound();
        }

        $servicio = $this->setUpdatedValues($request, $servicio);
        $servicio->save();

        return HttpResponse::ok(compact('servicio'));
    }

    public function destroy($id)
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            return HttpResponse::notFound();
        }

        $servicio->setDisabled();
        $servicio->save();

        return HttpResponse::ok(compact('servicio'));
    }

    public function setUpdatedValues($request, $servicio)
    {
        $servicio->precio = $request->precio;
        $servicio->descripcion = $request->descripcion;
        $servicio->observaciones = $request->observaciones;
        $servicio->tiempoPromedio = $request->tiempoPromedio;

        return $servicio;
    }
}
