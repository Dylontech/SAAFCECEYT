@extends('tablar::page')

@section('title')
    Solicitudes de Servicios de Exámenes
@endsection

@section('content')
    <!-- Encabezado de página -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle"></div>
                    <h2 class="page-title">
                        {{ __('Solicitudes de Servicios de Exámenes') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Cuerpo de la página -->
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
                            <form action="{{ route('solicitudes-servicios-s.index') }}" method="GET" class="d-flex flex-wrap align-items-end">
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
                                    <label class="form-label">Grupo</label>
                                    <select class="form-select form-select-sm" id="grupo" name="grupo">
                                        <option value="">Todos</option>
                                        @foreach ($grupos as $grupo)
                                            <option value="{{ $grupo }}">{{ $grupo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="me-2">
                                    <label class="form-label">Buscar</label>
                                    <input type="text" class="form-control form-control-sm" name="buscar" value="{{ request('buscar') }}" aria-label="Buscar">
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
                                        <th>Nombre del Alumno</th>
                                        <th>Número de Control</th>
                                        <th>Especialidad</th>
                                        <th>Grupo</th>
                                        <th>Tipo de Pago</th>
                                        <th>Fecha de Solicitud</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($formularios as $formulario)
                                        <tr>
                                            <td>{{ $formulario->nombre }}</td>
                                            <td>{{ $formulario->numero_control }}</td>
                                            <td>{{ $formulario->especialidad }}</td>
                                            <td>{{ $formulario->grupo }}</td>
                                            <td>{{ $formulario->tipo_pago }}</td>
                                            <td>{{ $formulario->fecha_pago }}</td>
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
                                                            <a href="{{ route('finanzas.comprobantes', $formulario->id) }}" class="dropdown-item">
                                                                <i class="fa fa-fw fa-info-circle"></i> Detalles
                                                            </a>
                                                            @if ($formulario->comentario_financiero)
                                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#comentarioModal{{ $formulario->id }}">
                                                                    <i class="fa fa-fw fa-eye"></i> Ver Comentario
                                                                </button>
                                                            @endif
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
