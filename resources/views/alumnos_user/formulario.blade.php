<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Independiente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Solicitud pago de examen</h2>
        <form method="POST" action="#">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nombre del Alumno</label>
                <input type="text" name="nombre" class="form-control" placeholder="Apellido Paterno, Apellido Materno, Nombre(s)">
            </div>
            <div class="mb-3">
                <label class="form-label">No. de Control</label>
                <input type="text" name="numero_control" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Especialidad</label>
                <input type="text" name="especialidad" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Nº Lista</label>
                <input type="text" name="numero_lista" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Grupo</label>
                <input type="text" name="grupo" class="form-control">
            </div>

            <h3 class="mt-4">Tipo de Pago</h3>
            <div class="mb-3">
                <label class="form-label">Recuperación (R2) Todas las Asignaturas</label>
                <input type="date" name="fecha_recuperacion" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Regularización (3 Asignaturas)</label>
                <input type="date" name="fecha_regularizacion" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Curso Intensivo (Submódulos)</label>
                <input type="date" name="fecha_curso_intensivo" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Título Suficiencia</label>
                <input type="date" name="fecha_titulo_suficiencia" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">2º Curso Intensivo (Submódulos)</label>
                <input type="date" name="fecha_segundo_curso_intensivo" class="form-control">
            </div>

            <h3 class="mt-4">Materias y Exámenes</h3>
            <div class="mb-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Materia</th>
                            <th>Tipo de Examen</th>
                            <th>Nº de Recibo de Pago</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 7; $i++)
                            <tr>
                                <td>{{ $i }}</td>
                                <td><input type="text" name="materias[{{ $i }}][nombre]" class="form-control"></td>
                                <td>
                                    <select name="materias[{{ $i }}][tipo_examen]" class="form-control">
                                        <option value="R2">R2</option>
                                        <option value="REG">REG</option>
                                        <option value="CI">C.I.</option>
                                        <option value="TS">T.S.</option>
                                        <option value="2CI">2º C.I.</option>
                                    </select>
                                </td>
                                <td><input type="text" name="materias[{{ $i }}][numero_recibo]" class="form-control"></td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

            <div class="form-footer">
                <button type="button" class="btn btn-primary w-100">Guardar Registro</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
