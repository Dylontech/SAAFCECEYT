<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateFormulariosTable extends Migration
{
    public function up()
    {
        Schema::create('formularios', function (Blueprint $table) {
            $table->id(); // Crea una columna de clave primaria auto-incremental llamada id
            $table->foreignId('alumno_id')->constrained('alumnos')->onDelete('cascade'); // Relación con la tabla alumnos
            $table->string('nombre'); // Nombre del alumno
            $table->string('control'); // Número de control del alumno
            $table->string('especialidad'); // Especialidad del alumno
            $table->string('grupo'); // Grupo del alumno
            $table->string('generacion'); // Generación del alumno
            $table->string('semestre'); // Semestre que cursa el alumno
            $table->date('fecha'); // Fecha de solicitud
            $table->string('curp'); // CURP del alumno
            $table->string('tipo_servicio')->nullable(); // Tipo de servicio solicitado
            $table->string('status')->default('pendiente'); // Estado de la solicitud
            $table->text('comentario')->nullable(); // Comentario del formulario
            $table->timestamps(); // Marcas de tiempo de creación y actualización del registro
        });
    }

    public function down()
    {
        Schema::dropIfExists('formularios'); // Elimina la tabla formularios si existe
    }
}

