@extends('tablar::page')

@section('title', 'Solicitud de Servicios')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Solicitud de Servicios</h1>
    <form action="/ruta-de-envio" method="post">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Alumno:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', Auth::guard('alumno')->user()->Nombre ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="control" class="form-label">No. de Control:</label>
            <input type="text" id="control" name="control" class="form-control" value="{{ old('control', Auth::guard('alumno')->user()->numero_control ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="especialidad" class="form-label">Especialidad:</label>
            <input type="text" id="especialidad" name="especialidad" class="form-control" value="{{ old('especialidad', Auth::guard('alumno')->user()->especialidad ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="grupo" class="form-label">Grupo:</label>
            <input type="text" id="grupo" name="grupo" class="form-control" value="{{ old('grupo', Auth::guard('alumno')->user()->grupo ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="generacion" class="form-label">Generación:</label>
            <input type="text" id="generacion" name="generacion" class="form-control" value="{{ old('generacion', Auth::guard('alumno')->user()->generacion ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="semestre" class="form-label">Semestre que Cursa:</label>
            <input type="text" id="semestre" name="semestre" class="form-control" value="{{ old('semestre', Auth::guard('alumno')->user()->semestre ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de Solicitud:</label>
            <input type="date" id="fecha" name="fecha" class="form-control" value="{{ old('fecha', date('Y-m-d')) }}">
        </div>
        <div class="mb-3">
            <label for="curp" class="form-label">CURP:</label>
            <input type="text" id="curp" name="curp" class="form-control" value="{{ old('curp', Auth::guard('alumno')->user()->CURP ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="tipo_servicio" class="form-label">Tipo de Servicio:</label>
            <select id="tipo_servicio" name="tipo_servicio" class="form-control">
                <option value="Constancia de Inscripción y/o Estudios">Constancia de Inscripción y/o Estudios</option>
                <option value="Duplicado de Credencial">Duplicado de Credencial</option>
                <option value="Certificado Incompleto (Parcial)">Certificado Incompleto (Parcial)</option>
                <option value="Duplicado de Certificado de Estudios">Duplicado de Certificado de Estudios</option>
                <option value="Examen de Titulación (Protocolo)">Examen de Titulación (Protocolo)</option>
                <option value="Titulación (Tit. y Exp. de Ced. Prof.)">Titulación (Tit. y Exp. de Ced. Prof.)</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-4">Enviar Solicitud</button>
    </form>
</div>
@endsection


