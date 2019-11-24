<?php

namespace App\Http\Controllers;

use App\Marca;
use Illuminate\Http\Request;
use App\Utils\Http\HttpResponse;

class MarcasController extends Controller
{
    /** 
     * Obtiene todos los recursos.
     * 
     * @return \App\Utils\Http\HttpResponse
    */
    public function index()
    {
        $marcas = Marca::enabled()->get();

        if (!$marcas) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('marcas'));
    }

    public function store(Request $request)
    {
        $args = $request->only([
            'enabled',
            'usuarioCreador',
            'marca'
        ]);

        $marca = Marca::create($args);

        return HttpResponse::created(compact('marca'));
    }

    public function show($id)
    {
        $marca = Marca::find($id);

        if (!$marca) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('marca'));
    }

    public function update(Request $request, $id)
    {
        $marca = Marca::find($id);

        if (!$marca) {
            return HttpResponse::notFound();
        }

        $marca = $this->setUpdatedValues($request, $marca);
        $marca->save();

        return HttpResponse::ok(compact('marca'));
    }

    public function destroy($id)
    {
        $marca = Marca::find($id);

        if (!$marca) {
            return HttpResponse::notFound();
        }

        $marca->setDisabled();
        $marca->save();

        return HttpResponse::ok(compact('marca'));
    }

    public function setUpdatedValues($request, $marca)
    {
        $marca->marca = $request->marca;

        return $marca;
    }
}
