<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
class Alumno extends Model implements AuthenticatableContract
{
    use Authenticatable, HasRoles, HasFactory;

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

    protected $fillable = [
        'Matricula',
        'CURP',
        'Carrera',
        'Grupo',
        'Nombre',
        'email',
        'estatus'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($alumno) {
            $alumno->assignRole('alumno');
        });
    }

    /**
     * Get the user associated with the Alumno
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
