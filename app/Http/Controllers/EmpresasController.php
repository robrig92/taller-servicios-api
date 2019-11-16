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

        $args = $this->setDefaultValues($request, $args);
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

        \Log::debug($empresa);

        $empresa = $this->setUpdatedValues($request, $empresa);
        $empresa = $this->setDefaultValues($request, $empresa);
        $empresa->save();

        return HttpResponse::ok(compact('empresa'));
    }

    public function destroy($id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return HttpResponse::notFound();
        }

        $empresa->setDisabled();
        $empresa->save();

        return HttpResponse::ok(compact('empresa'));
    }

    public function setDefaultValues($request, $empresa)
    {
        if (!isset($request->razonSocial)) {
            is_array($empresa) ? $empresa['razonSocial'] = '' : $empresa->razonSocial = '';
        }

        if (!isset($request->direccion)) {
            is_array($empresa) ? $empresa['direccion'] = '' : $empresa->direccion = '';
        }

        return $empresa;
    }

    public function setUpdatedValues($request, $empresa)
    {
        $empresa->email = $request->email;
        $empresa->nombre = $request->nombre;
        $empresa->telefono = $request->telefono;
        $empresa->direccion = $request->direccion;
        $empresa->razonSocial = $request->razonSocial;

        return $empresa;
    }
}
