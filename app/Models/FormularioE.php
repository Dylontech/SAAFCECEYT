<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioE extends Model
{
    use HasFactory;

    protected $table = 'formulario_e'; // Especificar el nombre correcto de la tabla

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'alumno_id',
        'nombre',
        'numero_control',
        'especialidad',
        'numero_lista',
        'grupo',
        'tipo_pago',
        'fecha_pago',
        'materias',
        'status'
    ];

    /**
     * Relación con el modelo Alumno.
     */
    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}
