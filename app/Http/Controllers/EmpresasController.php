<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use App\Utils\Http\HttpResponse;

class EmpresasController extends Controller
{
    /** 
     * Obtiene todos los recursos.
     * 
     * @return \App\Utils\Http\HttpResponse
    */
    public function index()
    {
        $empresas = Empresa::enabled()->get();

        if (!$empresas) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('empresas'));
    }

    public function store(Request $request)
    {
        $args = $request->only([
            'usuarioCreador',
            'nombre',
            'razonSocial',
            'direccion',
            'telefono',
            'email'
        ]);

        if (!isset($args['razonSocial'])) {
            $args['razonSocial'] = '';
        }

        if (!isset($args['direccion'])) {
            $args['direccion'] = '';
        }

        $empresa = Empresa::create($args);

        return HttpResponse::created(compact('empresa'));
    }

    public function show($id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('empresa'));
    }

    public function update(Request $request, $id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return HttpResponse::notFound();
        }

        $empresa->email = $request->email;
        $empresa->nombre = $request->nombre;
        $empresa->telefono = $request->telefono;
        $empresa->direccion = $request->direccion;
        $empresa->razonSocial = $request->razonSocial;

        if (!isset($request->razonSocial)) {
            $empresa->razonSocial = '';
        }

        if (!isset($request->direccion)) {
            $empresa->direccion = '';
        }
        
        $empresa->save();

        return HttpResponse::ok(compact('empresa'));
    }

    public function destroy($id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return HttpResponse::notFound();
        }

        $empresa->enabled = 0;

        $empresa->save();

        return HttpResponse::ok(compact('empresa'));
    }
}
