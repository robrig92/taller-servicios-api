<?php

namespace App\Http\Controllers;

use App\User;
use App\Helpers\HashHelper;
use Illuminate\Http\Request;
use App\Utils\Http\HttpResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Obtiene todos los recursos.
     *
     * @return \App\Utils\Http\HttpResponse
     */
    public function index()
    {
        $usuarios = User::with(['rol'])->get();

        if (!$usuarios) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('usuarios'));
    }

    public function store(Request $request)
    {
        $args = $request->only([
            'usuarioCreador',
            'nombre',
            'email',
            'telefono',
            'rol_id'
        ]);
        $args['hashId'] = HashHelper::hashId();
        $args['password'] = Hash::make($request->password);
        $args = $this->handleIncomingFile($request, $args);
        $usuario = User::create($args);

        return HttpResponse::created(compact('usuario'));
    }

    public function show($hashId)
    {
        $usuario = User::with(['rol'])->where('hashId', $hashId)->first();

        if (!$usuario) {
            return HttpResponse::notFound();
        }

        return HttpResponse::ok(compact('usuario'));
    }

    public function update(Request $request, $hashId)
    {
        $usuario = User::where('hashId', $hashId)->first();

        if (!$usuario) {
            return HttpResponse::notFound();
        }

        $usuario = $this->handleIncomingFile($request, $usuario);
        $usuario = $this->setUpdatedValues($request, $usuario);
        $usuario->save();

        return HttpResponse::ok(compact('usuario'));
    }

    public function setUpdatedValues($request, $usuario)
    {
        $usuario->nombre = $request->nombre;
        $usuario->rol_id = $request->rol_id;
        $usuario->telefono = $request->telefono;
        !isset($request->password) ?: $usuario->password = Hash::make($request->password);

        return $usuario;
    }

    public function handleIncomingFile($request, $usuario)
    {
        $path = $this->fileUpload($request, 'public/images/users/profile');

        if (is_array($usuario)) {
            empty($path) ? : $usuario['imagenPerfil'] = $path;
        }

        if ($usuario instanceof User && $path) {
            $this->fileDelete($usuario->imagenPerfil);
            $usuario->imagenPerfil = $path;
        }

        return $usuario;
    }

    public function destroy($hashId)
    {
        $usuario = User::where('hashId', $hashId)->first();

        if (!$usuario) {
            return HttpResponse::notFound();
        }

        $this->fileDelete($usuario->imagenPerfil);
        $usuario->delete();

        return HttpResponse::ok(compact('usuario'));
    }

    /**
     * Store a file into the path.
     *
     * @param  Request $request
     * @param  string $path
     * @return void
     */
    protected function fileUpload($request, $path)
    {
        if (!$request->hasFile('imagePerfil')) {
            return '';
        }

        $imagenPerfil = $request->imagePerfil->store($path);
        return $imagenPerfil;
    }

    /**
     * Deletes a file.
     *
     * @param  string $path
     * @return void
     */
    protected function fileDelete($path)
    {
        Storage::delete($path);
    }

    /**
     * Obtiene el path del servidor (public storage) de un archivo.
     *
     * @param Request $request
     * @param int $hashId
     * @return void
     */
    public function publicPath(Request $request, $hashId)
    {
        $user = User::where('hashId', $hashId)->first();

        if (!$user) {
            return HttpResponse::notFound();
        }

        if (!$user->imagenPerfil) {
            return HttpResponse::notFound();
        }

        $url = Storage::url(html_entity_decode($user->imagenPerfil));

        return HttpResponse::ok(compact('url'));
    }
}
