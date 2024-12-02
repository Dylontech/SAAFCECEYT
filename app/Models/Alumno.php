<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Alumno
 *
 * @property $id
 * @property $Matricula
 * @property $CURP
 * @property $Carrera
 * @property $Grupo
 * @property $Nombre
 * @property $email
 * @property $estatus
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Alumno extends Model
{
    
    static $rules = [
		'Matricula' => 'required',
		'CURP' => 'required',
		'Carrera' => 'required',
		'Grupo' => 'required',
		'Nombre' => 'required',
		'email' => 'required',
		'estatus' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Matricula','CURP','Carrera','Grupo','Nombre','email','estatus'];



}
