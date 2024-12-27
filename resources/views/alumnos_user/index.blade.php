@extends('tablar::page')

@section('title')
    Alumnos
@endsection

@section('content')
    <!-- Encabezado de la página -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Pre-título de la página -->
                    <div class="page-pretitle">
                        Bienvenido
                    </div>
                    <h2 class="page-title">
                        {{ __('Vista de Alumnos') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Cuerpo de la página -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Contenido en blanco -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
