<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formulario_e', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alumno_id'); // Relacionar con el alumno que creó la solicitud
            $table->string('nombre'); // Nombre del alumno
            $table->string('numero_control'); // Número de control del alumno
            $table->string('especialidad'); // Especialidad del alumno
            $table->string('numero_lista'); // Número de lista del alumno
            $table->string('grupo'); // Grupo del alumno
            $table->string('tipo_pago'); // Tipo de pago seleccionado
            $table->date('fecha_pago'); // Fecha de pago
            $table->json('materias'); // Almacenar las materias y tipos de examen en formato JSON
            $table->string('status')->default('pendiente'); // Campo status con valor predeterminado 'pendiente'
            $table->timestamps(); // Marcas de tiempo para la creación y actualización del registro

            // Clave foránea
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulario_e');
    }
};
