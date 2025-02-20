@extends('tablar::page')

@section('title', 'Formulario Independiente')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Solicitud pago de examen</h2>
    <form method="POST" action="{{ route('formulario.store') }}" data-ajax="true">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Alumno</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', Auth::guard('alumno')->user()->Nombre ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="curp" class="form-label">CURP</label>
            <input type="text" id="curp" name="curp" class="form-control" value="{{ old('curp', Auth::guard('alumno')->user()->CURP ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="numero_control" class="form-label">No. de Control</label>
            <input type="text" id="numero_control" name="numero_control" class="form-control" value="{{ old('numero_control', Auth::guard('alumno')->user()->numero_control ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="especialidad" class="form-label">Especialidad</label>
            <input type="text" id="especialidad" name="especialidad" class="form-control" value="{{ old('especialidad', Auth::guard('alumno')->user()->especialidad ?? '') }}">
        </div>
        <div class="mb-3">
            <input type="hidden" id="numero_lista" name="numero_lista" value="1">
        </div>
        <div class="mb-3">
            <label for="grupo" class="form-label">Grupo</label>
            <input type="text" id="grupo" name="grupo" class="form-control" value="{{ old('grupo', Auth::guard('alumno')->user()->Grupo ?? '') }}">
        </div>

        <h3 class="mt-4">Tipo de Pago</h3>
        <div class="mb-3">
            <label for="tipo_pago" class="form-label">Seleccione el tipo de pago</label>
            <select id="tipo_pago" name="tipo_pago" class="form-control">
                <option value="">Seleccione</option>
                <option value="recuperacion">Recuperación (R2) Todas las Asignaturas</option>
                <option value="regularizacion">Regularización (3 Asignaturas)</option>
                <option value="curso_intensivo">Curso Intensivo (Submódulos)</option>
                <option value="titulo_suficiencia">Título Suficiencia</option>
                <option value="segundo_curso_intensivo">2º Curso Intensivo (Submódulos)</option>
                
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_pago" class="form-label">Fecha de Pago</label>
            <input type="date" id="fecha_pago" name="fecha_pago" class="form-control" value="{{ date('Y-m-d') }}">
        </div>

        <h3 class="mt-4">Materias</h3>
        <div class="mb-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Materia</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 7; $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                <select name="materias[{{ $i }}][nombre]" class="form-control">
                                    <option value="">Seleccione</option>
                                    @foreach ($materias as $materia)
                                        <option value="{{ $materia->materia }}">{{ $materia->materia }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="materias[{{ $i }}][tipo_examen]" value="R2">
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Guardar Registro</button>
        </div>
    </form>
</div>
@endsection