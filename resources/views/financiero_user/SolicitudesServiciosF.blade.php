@extends('tablar::page')

@section('title')
    Solicitudes de Servicios Financieros
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle"></div>
                    <h2 class="page-title">
                        {{ __('Solicitudes de Servicios Financieros') }}
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
                            <div class="d-flex">
                                <div class="text-muted">
                                    Mostrar
                                    <div class="mx-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm" value="10" size="3" aria-label="Invoices count">
                                    </div>
                                    Registros
                                </div>
                                <div class="ms-auto text-muted">
                                    Buscar:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive min-vh-100">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
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
                                            <td>{{ $formulario->nombre }}</td>
                                            <td>{{ $formulario->control }}</td>
                                            <td>{{ $formulario->especialidad }}</td>
                                            <td>{{ $formulario->grupo }}</td>
                                            <td>{{ $formulario->tipo_servicio }}</td>
                                            <td>{{ $formulario->fecha }}</td>
                                            <td data-bs-toggle="tooltip" title="{{ $formulario->comentario ?? 'Sin comentario' }}">
                                                @if($formulario->comprobante_alumno)
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
                                                            <form action="{{ route('formulario.destroy', $formulario->id) }}" method="POST" class="delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-red delete-button">
                                                                    <i class="fa fa-fw fa-trash"></i> Eliminar
                                                                </button>
                                                            </form>
                                                            @if ($formulario->comentario)
                                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#comentarioModal{{ $formulario->id }}">
                                                                    <i class="fa fa-fw fa-eye"></i> Ver Comentario
                                                                </button>
                                                            @endif
                                                            <a href="{{ route('finanzas.show', $formulario->id) }}" class="dropdown-item">
                                                                <i class="fa fa-fw fa-upload"></i> Subir Liga de Pago
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
        @if ($formulario->comentario)
            <div class="modal fade" id="comentarioModal{{ $formulario->id }}" tabindex="-1" aria-labelledby="comentarioModalLabel{{ $formulario->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="comentarioModalLabel{{ $formulario->id }}">Comentario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>{{ $formulario->comentario }}</p>
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
