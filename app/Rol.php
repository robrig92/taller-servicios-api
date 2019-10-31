<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    /** 
     * Tabla.
     * 
     * @var string
    */
    protected $table = 'roles';

    /**
     * Atributos asignables para creación masiva.
     *
     * @var array
     */
    protected $fillable = [
        'enabled',
        'hashId',
        'usuarioCreador',
        'nombre'
    ];

    /**
     * Establece la consulta a solo registros habilitados.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEnabled($query)
    {
        return $query->where('enabled', 1) ;
    }

    /**
     * Relación muchos a muchos con entidad Permisos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permisos()
    {
        return $this->belongsToMany('App\Permiso', 'rol_permiso', 'rol_id', 'permiso_id');
    }
}
