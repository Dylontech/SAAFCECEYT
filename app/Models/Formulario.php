<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    use HasFactory;

    protected $table = 'formularios';

    protected $fillable = [
        'alumno_id',
        'nombre',
        'control',
        'especialidad',
        'grupo',
        'generacion',
        'semestre',
        'fecha',
        'curp',
        'tipo_servicio',
        'status',
        'comentario', // Añadido
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}
