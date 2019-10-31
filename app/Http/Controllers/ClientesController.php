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
        
        if (!isset($request->direccion)) {
            $args['direccion'] = '';
        }

        if (!isset($request->nombreComercial)) {
            $args['nombreComercial'] = '';
        }

        $args['hashId'] = HashHelper::hashId();
        $args['enabled'] = 1;

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

        $cliente->email = $request->email;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->empresa_id = $request->empresa_id;
        $cliente->nombreContacto = $request->nombreContacto;
        $cliente->nombreComercial = $request->nombreComercial;

        if (!isset($request->direccion)) {
            $cliente->direccion = '';
        }

        if (!isset($request->nombreComercial)) {
            $cliente->nombreComercial = '';
        }

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

        $cliente->enabled = 0;

        $cliente->save();

        return HttpResponse::ok(compact('cliente'));
    }
}
