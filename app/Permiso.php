<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    /** 
     * Tabla.
     * 
     * @var string
     */
    protected $table = 'permisos';

    /**
     * Atributos asignables para creación masiva.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    /**
     * Relación muchos a muchos con entidad Roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Rol', 'rol_permiso', 'permiso_id', 'rol_id');
    }
}
