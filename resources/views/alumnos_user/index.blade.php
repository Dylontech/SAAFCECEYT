<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        Bienvenido
                    </div>
                    <div class="card-body">
                        <h2 class="card-title text-center">{{ __('Vista de Alumnos') }}</h2>
                        @auth('alumno')
                            <p>Bienvenido, {{ Auth::guard('alumno')->user()->Nombre ?? 'Alumno' }}!</p>
                            <p>Rol: {{ Auth::guard('alumno')->user()->roles->pluck('name')->implode(', ') ?? 'Sin rol' }}</p>
                            <p>Esta es la vista de inicio para los alumnos. Aquí puedes acceder a tus recursos y funcionalidades específicas.</p>
                            <a href="{{ route('home') }}" class="btn btn-primary">Ir al Dashboard</a>
                            <!-- Botón para mostrar el formulario -->
                            <a href="{{ route('formulario') }}" class="btn btn-secondary mt-3">Solicitud</a>
                        @else
                            <p>No tienes acceso a esta vista. Por favor, <a href="{{ route('login') }}">inicia sesión</a>.</p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

