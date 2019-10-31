<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    /** 
     * Tabla.
     * 
     * @var string
    */
    protected $table = 'servicios';

    /**
     * Atributos asignables para creación masiva.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion',
        'precio',
        'observaciones',
        'tiempoPromedio',
        'usuarioCreador',
        'enabled'
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
}
