<?php

namespace App\Http\Controllers;

use App\TipoEquipo;
use App\Helpers\HashHelper;
use Illuminate\Http\Request;
use App\Utils\Http\HttpResponse;

class TipoEquiposController extends Controller
{
    /**
     * Obtiene todos los recursos.
     *
     * @return \App\Utils\Http\HttpResponse
     */
    public function index() {
        $tipoEquipos = TipoEquipo::enabled()->get();

        if (!$tipoEquipos) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('tipoEquipos'));
    }

    public function store(Request $request)
    {
        $args = $request->only([
            'tipo',
            'enabled',
            'usuarioCreador'
        ]);

        $args['hashId'] = HashHelper::hashId();
        $tipoEquipo = TipoEquipo::create($args);

        return HttpResponse::created(compact('tipoEquipo'));
    }

    public function show($id)
    {
        $tipoEquipo = TipoEquipo::where('hashId', $id)->first();

        if (!$tipoEquipo) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('tipoEquipo'));
    }

    public function update(Request $request, $id)
    {
        $tipoEquipo = TipoEquipo::where('hashId', $id)->first();

        if (!$tipoEquipo) {
            return HttpResponse::notFound();
        }

        $tipoEquipo = $this->serUpdatedValues($request, $tipoEquipo);
        $tipoEquipo->save();

        return HttpResponse::ok(compact('tipoEquipo'));
    }

    public function destroy($id)
    {
        $tipoEquipo = TipoEquipo::where('hashId', $id)->first();

        if (!$tipoEquipo) {
            return HttpResponse::notFound();
        }

        $tipoEquipo->setDisabled();
        $tipoEquipo->save();

        return HttpResponse::ok(compact('tipoEquipo'));
    }

    public function setUpdatedValues($request, $tipoEquipo)
    {
        $tipoEquipo->tipo = $request->tipo;

        return $tipoEquipo;
    }
}
