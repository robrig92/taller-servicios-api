<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    /**
     * Nombre de la tabla.
     *
     * @var string
     */
    protected $table = 'empresas';

    /**
     * Atributos asignables para creación masiva.
     *
     * @var array
     */
    protected $fillable = [
        'usuarioCreador',
        'nombre',
        'razonSocial',
        'direccion',
        'telefono',
        'email'
    ];

    /**
     * Establece la consulta a solo registros habilitados.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEnabled($query)
    {
        return $query->where('enabled', 1);
    }
}
