<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
    /**
     * ID de estatus Creado.
     *
     * @var integer
     */
    public static $CREADO = 1;

    /**
     * ID de estatus Diagnóstico.
     *
     * @var integer
     */
    public static $DIAGNOSTICO = 2;

    /**
     * ID de estatus Cotización.
     *
     * @var integer
     */
    public static $COTIZACION = 3;

    /**
     * ID de estatus Validado.
     *
     * @var integer
     */
    public static $VALIDADO = 4;

    /**
     * ID de estatus Entregar.
     *
     * @var integer
     */
    public static $ENTREGAR = 5;

    /**
     * ID de estatus Finalizado.
     *
     * @var integer
     */
    public static $FINALIZADO = 6;

    /**
     * ID de estatus Cancelado.
     *
     * @var integer
     */
    public static $CANCELADO = 7;

    /**
     * Nombre de la tabla.
     *
     * @var string
     */
    protected $table = 'estatus';

    /**
     * Los atributos asignables para insersión masiva.
     *
     * @var array
     */
    protected $fillable = ['estatus'];
}
