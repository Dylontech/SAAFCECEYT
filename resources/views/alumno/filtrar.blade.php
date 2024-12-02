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
    <div class="container">
        <h1>Filtrar</h1>
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