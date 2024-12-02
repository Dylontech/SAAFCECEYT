<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Especialidad
 *
 * @property $id
 * @property $Nombre
 * @property $Tipo
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Especialidad extends Model
{
    
    static $rules = [
		'Nombre' => 'required',
		'Tipo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Nombre','Tipo'];



}
