<!-- resources/views/alumno/filtrar.blade.php -->
@extends('tablar::page')

@section('title')
Filtrar
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        List
                    </div>
                    <h2 class="page-title">
                        {{ __('Filtrar Alumno ') }}
                    </h2>
                </div>
                <!-- Page title actions -->
<div class="col-12 col-md-auto ms-auto d-print-none">
    <div class="btn-list">
        
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('alumnos.create') }}" class="btn btn-warning d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Alta Alumno
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            @if(config('tablar','display_alert'))
                @include('tablar::common.alert')
            @endif
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Alumno</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-muted">
                                    Mostrar
                                    <div class="mx-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm" value="10" size="3"
                                               aria-label="Invoices count">
                                 
                          
                            
                                <div class="ms-auto text-muted">
                                    Buscar:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm"
                                               aria-label="Search invoice">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
       
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="grupo" class="form-label">Filtrar por grupo</label>
                <select id="grupo" class="form-select">
                    <option value="">Selecciona un grupo</option>
                    <option value="1"></option>
                    <option value="2">Grupo 2</option>
                    <option value="3"></option>
                    <option value="4">Grupo 2</option>
                    <option value="5"></option>
                    <option value="6">Grupo 2</option>
                    <option value="7">Grupo 2</option>

                    <!-- Agrega más opciones según sea necesario -->
                </select>
            </div>
            <div class="col-md-4">
                <label for="carrera" class="form-label">Filtrar por carrera</label>
                <select id="carrera" class="form-select">
                    <option value="">Selecciona una carrera</option>
                    <option value="ingenieria">ventas</option>
                    <option value="medicina">Diseño Grafico Digital</option>
                    <option value="Produccion Industrial de Alimentos">Diseño Grafico Digital</option>
                    <!-- Agrega más opciones según sea necesario -->
                </select>
            </div>
            <div class="col-md-4">
                <label for="estatus" class="form-label">Filtrar por estatus</label>
                <select id="estatus" class="form-select">
                    <option value="">Selecciona un estatus</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                    <!-- Agrega más opciones según sea necesario -->
                </select>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Grupo</th>
                    <th>Carrera</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí puedes agregar filas de ejemplo o dinámicamente con datos -->
                <tr>
                    <td>Juan Pérez</td>
                    <td>Grupo 1</td>
                    <td>Ingeniería</td>
                    <td>Activo</td>
                </tr>
                <tr>
                    <td>María López</td>
                    <td>Grupo 2</td>
                    <td>Medicina</td>
                    <td>Inactivo</td>
                </tr>
            </tbody>
        </table>
    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
