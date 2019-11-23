<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folio extends Model
{
    /**
     * Nombre de la tabla.
     *
     * @var string
     */
    protected $table = 'folios';

    /**
     * Los atributos asignables para insersión masiva.
     *
     * @var array
     */
    protected $fillable = [
        'usuarioCreador',
        'cliente_id',
        'servicio_id',
        'asignadoA',
        'cotizacion',
        'total',
        'fechaAbre',
        'fechaCierre',
        'estatus_id',
        'activo',
        'numeroSerie',
        'tipoEquipo_id',
        'marca_id'
    ];

    /**
     * Establece la consulta a solo registros activos.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('activo', 1);
    }

    /**
     * Relación con modelo Cliente.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo(\App\Cliente::class);
    }

    /**
     * Relación con modelo Servicio.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servicio()
    {
        return $this->belongsTo(\App\Servicio::class);
    }

    /**
     * Relación con modelo Estatus.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estatus()
    {
        return $this->belongsTo(\App\Estatus::class);
    }

    /**
     * Relación con modelo TipoEquipo.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoEquipo()
    {
        return $this->belongsTo(\App\TipoEquipo::class, 'tipoEquipo_id');
    }

    /**
     * Relación con modelo TipoEquipo.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marca()
    {
        return $this->belongsTo(\App\Marca::class);
    }

    /**
     * Relación con User.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function asignadoA()
    {
        return $this->belongsTo(\App\User::class, 'asignadoA');
    }

    /**
     * Disable the resource.
     *
     * @return void
     */
    public function setDisabled()
    {
        $this->activo = 0;
    }
}
