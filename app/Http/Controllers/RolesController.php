<?php

namespace App\Http\Controllers;

use App\Rol;
use App\Helpers\HashHelper;
use Illuminate\Http\Request;
use App\Utils\Http\HttpResponse;
use App\Permiso;

class RolesController extends Controller
{
    /** 
     * Obtiene todos los recursos.
     * 
     * @return \App\Utils\Http\HttpResponse
    */
    public function index()
    {
        $roles = Rol::enabled()->with(['permisos'])->get();

        if (!$roles) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('roles'));
    }

    /**
     * Store a role.
     *
     * @param Request $request
     * @return App\Utils\Http\HttpResponse
     */
    public function store(Request $request)
    {
        $args = $request->only([
            'enabled',
            'usuarioCreador',
            'nombre'
        ]);
        
        $args['hashId'] = HashHelper::hashId();

        $rol = Rol::create($args);

        return HttpResponse::created(compact('rol'));
    }

    /**
     * Get a role.
     *
     * @param integer $id
     * @return App\Utils\Http\HttpResponse
     */
    public function show($id)
    {
        $rol = Rol::with(['permisos'])->find($id);

        if (!$rol) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('rol'));
    }

    /**
     * Update a role.
     *
     * @param Request $request
     * @param integer $id
     * @return App\Utils\Http\HttpResponse
     */
    public function update(Request $request, $id)
    {
        $rol = Rol::with(['permisos'])->find($id);

        if (!$rol) {
            return HttpResponse::notFound();
        }

        $rol->nombre = $request->nombre;
        
        $rol->save();

        return HttpResponse::ok(compact('rol'));
    }

    /**
     * Destroy from storage a role.
     *
     * @param integer $id
     * @return App\Utils\Http\HttpResponse
     */
    public function destroy($id)
    {
        $rol = Rol::with(['permisos'])->find($id);

        if (!$rol) {
            return HttpResponse::notFound();
        }

        $rol->enabled = 0;
        
        $rol->permisos()->detach();
        
        $rol->save();

        return HttpResponse::ok(compact('rol'));
    }

    /**
     * Attach a permission from a role.
     *
     * @param Request $request
     * @param integer $id
     * @return App\Utils\Http\HttpResponse
     */
    public function storePermiso(Request $request, $id)
    {
        $rol = Rol::find($id);
        $permiso = Permiso::find($request->permisoId);

        if (!$rol || !$permiso) {
            return HttpResponse::notFound();
        }

        $rol->permisos()->attach($permiso);

        $rol = Rol::with(['permisos'])->find($id);

        return HttpResponse::created(compact('rol'));
    }

    /**
     * Removes a permission from a role.
     *
     * @param Request $request
     * @param integer $id
     * @return App\Utils\Http\HttpResponse
     */
    public function destroyPermiso(Request $request, $id)
    {
        $rol = Rol::find($id);
        $permisoId = $request->permisoId;

        if (!$rol) {
            return HttpResponse::notFound();
        }

        $rol->permisos()->detach($permisoId);

        $rol = Rol::with(['permisos'])->find($id);

        return HttpResponse::ok(compact('rol'));
    }
}
