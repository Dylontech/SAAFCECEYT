@extends('tablar::page')

@section('title', 'Alumnos - Inicio')

@section('content')
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
                        @else
                            <p>No tienes acceso a esta vista. Por favor, <a href="{{ route('login') }}">inicia sesión</a>.</p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
