<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Helpers\HashHelper;
use Illuminate\Http\Request;
use App\Utils\Http\HttpResponse;

class ClientesController extends Controller
{
    /**
     * Obtiene todos los recursos.
     *
     * @return \App\Utils\Http\HttpResponse
     */
    public function index() {
        $clientes = Cliente::enabled()
            ->with(['empresa'])
            ->get();

        if (!$clientes) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('clientes'));
    }

    public function store(Request $request)
    {
        $args = $request->only([
            'usuarioCreador',
            'nombreContacto',
            'nombreComercial',
            'direccion',
            'telefono',
            'email',
            'empresa_id'
        ]);

        $args = $this->setDefaults($request, $args);
        $cliente = Cliente::create($args);

        return HttpResponse::created(compact('cliente'));
    }

    public function show($id)
    {
        $cliente = Cliente::where('hashId', $id)
            ->with(['empresa'])
            ->first();

        if (!$cliente) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::where('hashId', $id)
            ->with(['empresa'])
            ->first();

        if (!$cliente) {
            return HttpResponse::notFound();
        }

        $cliente = $this->setUpdatedValues($request, $cliente);
        $cliente->save();

        return HttpResponse::ok(compact('cliente'));
    }

    public function destroy($id)
    {
        $cliente = Cliente::where('hashId', $id)
            ->with(['empresa'])
            ->first();

        if (!$cliente) {
            return HttpResponse::notFound();
        }

        $cliente->setDisabled();
        $cliente->save();

        return HttpResponse::ok(compact('cliente'));
    }

    public function setUpdatedValues($request, $cliente)
    {
        $cliente->email = $request->email;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->empresa_id = $request->empresa_id;
        $cliente->nombreContacto = $request->nombreContacto;
        $cliente->nombreComercial = $request->nombreComercial;
        $cliente = $this->setDefaultsForUpdate($request, $cliente);

        return $cliente;
    }

    public function setDefaultsForStore($request, $cliente)
    {
        $cliente = $this->setDefaults($request, $cliente);

        $cliente['hashId'] = HashHelper::hashId();
        $cliente['enabled'] = 1;

        return $cliente;
    }

    public function setDefaultsForUpdate($request, $cliente)
    {
        $cliente = $this->setDefaults($request, $cliente);

        return $cliente;
    }

    public function setDefaults($request, $cliente)
    {
        if (!isset($request->direccion)) {
            is_array($cliente) ? $cliente['direccion'] = '' : $cliente->direccion = '';
        }

        if (!isset($request->nombreComercial)) {
            is_array($cliente) ? $cliente['nombreComercial'] = '' : $cliente->nombreComercial = '';
        }

        return $cliente;
    }
}
