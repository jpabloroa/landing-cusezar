<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Prospecto
 *
 * @property $id
 * @property $created_at
 * @property $nombre_1
 * @property $nombre_2
 * @property $apellido_1
 * @property $apellido_2
 * @property $cedula
 * @property $celular
 * @property $correo
 * @property $estado_civil
 * @property $caja_compensacion
 * @property $actividad
 * @property $ingresos
 * @property $cesantias
 * @property $ahorros
 * @property $documentos_cliente
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Prospecto extends Model
{

    /**
     * @var string[]
     */
    static $rules = [
        'nombre_1' => ['required', 'string', 'max:50'],
        'nombre_2' => ['string', 'max:50'],
        'apellido_1' => ['required', 'string', 'max:50'],
        'apellido_2' => ['string', 'max:50'],
        'cedula' => ['required', 'numeric', 'max:255'],
        'celular' => ['required', 'string', 'max:255'],
        'correo' => ['required', 'email', 'max:100'],
        'estado_civil' => ['required', 'string', 'max:255'],
        'aplica_subsidio' => ['required', 'string', 'max:255'],
        'caja_compensacion' => ['string', 'max:50'],
        'actividad' => ['required', 'string', 'max:50'],
        'ingresos' => ['required', 'numeric', 'max:255'],
        'gastos' => ['numeric', 'max:255'],
        'primas_proyectadas' => ['numeric', 'max:255'],
        'cesantias' => ['numeric', 'max:255'],
        'cesantias_proyectadas' => ['numeric', 'max:255'],
        'ahorros' => ['numeric', 'max:255'],
        'ahorros_proyectados' => ['numeric', 'max:255'],
        'activos' => ['numeric', 'max:255'],
        'pasivos' => ['numeric', 'max:255'],
        'credito' => ['numeric', 'max:255'],
        'documentos_cliente' => ['required', 'json', 'max:255'],
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_1',
        'nombre_2',
        'apellido_1',
        'apellido_2',
        'cedula',
        'celular',
        'correo',
        'estado_civil',
        'aplica_subsidio',
        'caja_compensacion',
        'actividad',
        'ingresos',
        'gastos',
        'primas_proyectadas',
        'cesantias',
        'cesantias_proyectadas',
        'ahorros',
        'ahorros_proyectados',
        'activos',
        'pasivos',
        'credito',
        'documentos_cliente',
        'updated_at'
    ];


}
