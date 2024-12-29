<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Servicios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
        }
        input, select {
            padding: 5px;
            margin-top: 5px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }
        .submit-btn {
            margin-top: 20px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Solicitud de Servicios</h1>
        <form action="/ruta-de-envio" method="post">
            @csrf
            <label for="nombre">Nombre del Alumno:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', Auth::guard('alumno')->user()->Nombre ?? '') }}">

            <label for="control">No. de Control:</label>
            <input type="text" id="control" name="control" value="{{ old('control', Auth::guard('alumno')->user()->numero_control ?? '') }}">

            <label for="especialidad">Especialidad:</label>
            <input type="text" id="especialidad" name="especialidad" value="{{ old('especialidad', Auth::guard('alumno')->user()->especialidad ?? '') }}">

            <label for="grupo">Grupo:</label>
            <input type="text" id="grupo" name="grupo" value="{{ old('grupo', Auth::guard('alumno')->user()->grupo ?? '') }}">

            <label for="generacion">Generación:</label>
            <input type="text" id="generacion" name="generacion" value="{{ old('generacion', Auth::guard('alumno')->user()->generacion ?? '') }}">

            <label for="semestre">Semestre que Cursa:</label>
            <input type="text" id="semestre" name="semestre" value="{{ old('semestre', Auth::guard('alumno')->user()->semestre ?? '') }}">

            <label for="fecha">Fecha de Solicitud:</label>
            <input type="date" id="fecha" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}">

            <label for="curp">CURP:</label>
            <input type="text" id="curp" name="curp" value="{{ old('curp', Auth::guard('alumno')->user()->CURP ?? '') }}">

            <table>
                <thead>
                    <tr>
                        <th>Tipo de Servicio</th>
                        <th>Marcar</th>
                        <th>No. de Recibo de Pago</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Constancia de Inscripción y/o Estudios</td>
                        <td><input type="checkbox" name="servicio1"></td>
                        <td><input type="text" name="recibo1"></td>
                    </tr>
                    <tr>
                        <td>Duplicado de Credencial</td>
                        <td><input type="checkbox" name="servicio2"></td>
                        <td><input type="text" name="recibo2"></td>
                    </tr>
                    <tr>
                        <td>Certificado Incompleto (Parcial)</td>
                        <td><input type="checkbox" name="servicio3"></td>
                        <td><input type="text" name="recibo3"></td>
                    </tr>
                    <tr>
                        <td>Duplicado de Certificado de Estudios</td>
                        <td><input type="checkbox" name="servicio4"></td>
                        <td><input type="text" name="recibo4"></td>
                    </tr>
                    <tr>
                        <td>Examen de Titulación (Protocolo)</td>
                        <td><input type="checkbox" name="servicio5"></td>
                        <td><input type="text" name="recibo5"></td>
                    </tr>
                    <tr>
                        <td>Titulación (Tit. y Exp. de Ced. Prof.)</td>
                        <td><input type="checkbox" name="servicio6"></td>
                        <td><input type="text" name="recibo6"></td>
                    </tr>
                </tbody>
            </table>

            <button type="submit" class="submit-btn">Enviar Solicitud</button>
        </form>
    </div>
</body>
</html>


