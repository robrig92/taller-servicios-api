<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    /**
     * Tabla.
     *
     * @var string
     */
    protected $table = 'marcas';

    /**
     * Atributos asignables para creación masiva.
     *
     * @var array
     */
    protected $fillable = [
        'marca',
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
