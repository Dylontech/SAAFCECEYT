<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botón de Ayuda por WhatsApp</title>
    <style>
        .btn-whatsapp {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #25d366;
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            text-decoration: none;
            z-index: 1000;
        }
        .btn-whatsapp svg {
            width: 30px;
            height: 30px;
        }
        .btn-filter {
            background-color: #4CAF50; /* Color verde */
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 2px;
            cursor: pointer;
            border-radius: 5px;
        }
        #results {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    @if (Auth::guard('alumno')->check())
        <!-- Botones para el alumno -->
        <a href="{{ route('solicitudesE.index') }}" class="btn-filter">Ver Solicitudes de Exámenes</a>
        <a href="{{ route('formularios.index') }}" class="btn-filter">Ver Solicitudes de Servicios</a>
    @elseif (Auth::user() && Auth::user()->hasRole('control_escolar'))
        <!-- Botón para control escolar -->
        <a href="{{ route('control_user.index') }}" class="btn-filter">Solicitudes de Examenes</a>
        <!-- Botón para acceder a la vista GestionS -->
        <a href="{{ route('gestions.index') }}" class="btn-filter">Solicitudes de Servicios</a>
    @endif

    <div id="results"></div>

    <a href="https://wa.me/{{ $whatsappSettings->phone_number }}?text={{ urlencode($whatsappSettings->message) }}" class="btn-whatsapp" target="_blank" rel="noreferrer">
        <!-- WhatsApp SVG icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24V24H0z" fill="none"/>
            <path d="M3 21l1.65 -4.75a9 9 0 1 1 3.1 3.1l-4.75 1.65m10.5 -11.65a3 3 0 1 0 -4 4l1 1l-1 3l3 -1l1 -1a3 3 0 0 0 1 -4"/>
        </svg>
    </a>
</body>
</html>
