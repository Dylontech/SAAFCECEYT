@extends('tablar::page')

@section('title')
    Solicitudes de Servicios (Financiero)
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle"></div>
                    <h2 class="page-title">
                        {{ __('Solicitudes de Servicios (Financiero)') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Solicitudes</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <form action="{{ route('finanzas.index') }}" method="GET" class="d-flex flex-wrap align-items-end">
                                <div class="me-2">
                                    <label class="form-label">No. control</label>
                                    <select class="form-select form-select-sm" id="control" name="control">
                                        <option value="">Todos</option>
                                        @foreach ($controles as $control)
                                            <option value="{{ $control }}">{{ $control }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="me-2">
                                    <label class="form-label">Especialidad</label>
                                    <select class="form-select form-select-sm" id="especialidad" name="especialidad">
                                        <option value="">Todas</option>
                                        @foreach ($especialidades as $especialidad)
                                            <option value="{{ $especialidad }}">{{ $especialidad }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="me-2">
                                    <label class="form-label">Tipo de Servicio</label>
                                    <select class="form-select form-select-sm" id="tipo_servicio" name="tipo_servicio">
                                        <option value="">Todos</option>
                                        @foreach ($tipos_servicio as $tipo_servicio)
                                            <option value="{{ $tipo_servicio }}">{{ $tipo_servicio }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="me-2">
                                    <label class="form-label">Buscar</label>
                                    <input type="text" class="form-control form-control-sm" name="buscar" value="{{ request('buscar') }}" aria-label="Search invoice">
                                </div>
                                <div class="me-2">
                                    <input type="submit" class="btn btn-primary btn-sm" value="Filtrar">
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
                                        <th>Tipo de Servicio</th>
                                        <th>Fecha de Solicitud</th>
                                        <th>Status</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($formularios as $formulario)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $formulario->nombre }}</td>
                                            <td>{{ $formulario->control }}</td>
                                            <td>{{ $formulario->especialidad }}</td>
                                            <td>{{ $formulario->grupo }}</td>
                                            <td>{{ $formulario->tipo_servicio }}</td>
                                            <td>{{ $formulario->fecha }}</td>
                                            <td data-bs-toggle="tooltip" title="{{ $formulario->comentario_financiero ?? 'Sin comentario' }}">
                                                @if($formulario->comprobante_oficial)
                                                    Finalizada
                                                @elseif($formulario->comprobante_alumno)
                                                    Comprobante del alumno disponible
                                                @else
                                                    {{ $formulario->status }}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                            Acciones
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            @if ($formulario->comentario_financiero)
                                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#comentarioModal{{ $formulario->id }}">
                                                                    <i class="fa fa-fw fa-eye"></i> Ver Comentario
                                                                </button>
                                                            @endif
                                                            <a href="{{ route('finanzas.show', $formulario->id) }}" class="dropdown-item">
                                                                @if ($formulario->comprobante_oficial)
                                                                    <i class="fa fa-fw fa-info-circle"></i> Detalles
                                                                @elseif ($formulario->comprobante_alumno)
                                                                    <i class="fa fa-fw fa-download"></i> Descargar Comprobante del Alumno
                                                                @else
                                                                    <i class="fa fa-fw fa-upload"></i> Subir Liga de Pago
                                                                @endif
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">Sin información</td>
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
    <!-- Modal para mostrar el comentario -->
    @foreach ($formularios as $formulario)
        @if ($formulario->comentario_financiero)
            <div class="modal fade" id="comentarioModal{{ $formulario->id }}" tabindex="-1" aria-labelledby="comentarioModalLabel{{ $formulario->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="comentarioModalLabel{{ $formulario->id }}">Comentario Financiero</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>{{ $formulario->comentario_financiero }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection

@section('scripts')
    <script>
        // Inicializar tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
@endsection