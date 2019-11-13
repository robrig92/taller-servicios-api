<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /**
     * Nombre de la tabnla.
     *
     * @var string
     */
    protected $table = 'clientes';

    /**
     * Campos asignables para inserción masiva.
     *
     * @var array
     */
    protected $fillable = [
        'enabled',
        'hashId',
        'usuarioCreador',
        'nombreContacto',
        'nombreComercial',
        'direccion',
        'telefono',
        'email',
        'empresa_id'
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
     * Relationship with Empresa Model.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function setDisabled()
    {
        $this->enabled = 0;
    }
}
