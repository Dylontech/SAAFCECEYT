@extends('tablar::page')

@section('title')
    Nuevas solicitudes de Examenes
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        
                    </div>
                    <h2 class="page-title">
                        {{ __('Nuevas solicitudes de Examenes') }}
                    </h2>
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
                            <h3 class="card-title">Solicitudes</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <form method="GET" action="{{ route('control_user.index') }}">
                                <div class="d-flex align-items-end">
                                    <div class="me-2">
                                        <label class="form-label me-2">Buscar:</label>
                                        <input type="text" class="form-control form-control-sm" name="search" value="{{ request('search') }}" aria-label="Search invoice">
                                    </div>
                                    <div class="me-2">
                                        <label class="form-label me-2">Especialidad:</label>
                                        <select class="form-select form-select-sm" name="especialidad">
                                            <option value="">Todas</option>
                                            @foreach ($especialidades as $especialidad)
                                                <option value="{{ $especialidad }}" {{ request('especialidad') == $especialidad ? 'selected' : '' }}>{{ $especialidad }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="me-2">
                                        <label class="form-label me-2">Grupo:</label>
                                        <select class="form-select form-select-sm" name="grupo">
                                            <option value="">Todos</option>
                                            @foreach($grupos as $grupo)
                                                <option value="{{ $grupo }}" {{ request('grupo') == $grupo ? 'selected' : '' }}>{{ $grupo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="me-2">
                                        <label class="form-label me-2">Tipo de Pago:</label>
                                        <select class="form-select form-select-sm" name="tipo_pago">
                                            <option value="">Tipo</option>
                                            @foreach($tipo_pagos as $tipo_pago)
                                                <option value="{{ $tipo_pago }}" {{ request('tipo_pago') == $tipo_pago ? 'selected' : '' }}>{{ $tipo_pago }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive min-vh-100">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                <tr>
                                    
                                    <th class="w-1">No.
                                        <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-sm text-dark icon-thick" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <polyline points="6 15 12 9 18 15"/>
                                        </svg>
                                    </th>
                                    <th>Nombre del Alumno</th>
                                    <th>Número de Control</th>
                                    <th>Especialidad</th>
                                    <th>Grupo</th>
                                    <th>Tipo de Pago</th>
                                    <th>Fecha de Pago</th>
                                    <th>Materias</th>
                                    <th>Status</th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($formularios as $formulario)
                                    @if (Auth::user()->hasRole('control_escolar') || $formulario->alumno_id == Auth::guard('alumno')->id())
                                        <tr>
                                            
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $formulario->nombre }}</td>
                                            <td>{{ $formulario->numero_control }}</td>
                                            <td>{{ $formulario->especialidad }}</td>
                                            <td>{{ $formulario->grupo }}</td>
                                            <td>{{ $formulario->tipo_pago }}</td>
                                            <td>{{ $formulario->fecha_pago }}</td>
                                            <td>
                                                <span class="materias-tooltip" data-bs-toggle="tooltip" title="{{ $formulario->materias ? implode(', ', array_filter(array_column(json_decode($formulario->materias, true), 'nombre'))) : 'No hay materias' }}">
                                                    @if ($formulario->materias)
                                                        {{ array_filter(array_column(json_decode($formulario->materias, true), 'nombre'))[0] }}...
                                                    @else
                                                        No hay materias
                                                    @endif
                                                </span>
                                                
                                            </td>
                                            <td>
                                                <span class="status-tooltip" data-bs-toggle="tooltip" title="{{ $formulario->comentario ?? 'No hay comentario' }}">
                                                    {{ $formulario->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                            Acciones
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <!-- Botón Ver modificado para redirigir directamente -->
                                                            <a href="{{ route('control_user.show', ['id' => $formulario->id]) }}" class="dropdown-item">
                                                                Ver
                                                            </a>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="10">Sin información</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            {!! $formularios->links('tablar::pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
@endsection