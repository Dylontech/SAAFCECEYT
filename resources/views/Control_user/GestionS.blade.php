@extends('tablar::page')

@section('title')
Nuevas solicitudes de Servivios
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
                        {{ __('Nuevas solicitudes de Servicios') }}
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
                            <form method="GET" action="{{ route('Control_user.GestionS') }}" class="d-flex flex-wrap align-items-end mb-3">
                                <div class="me-2">
                                    <label class="form-label">Especialidad</label>
                                    <select name="especialidad" class="form-select form-select-sm" aria-label="Filtrar por especialidad">
                                        <option value="" selected>Todas</option>
                                        @foreach($especialidades as $especialidad)
                                            <option value="{{ $especialidad }}">{{ $especialidad }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="me-2">
                                    <label class="form-label">Grupos</label>
                                    <select name="grupo" class="form-select form-select-sm" aria-label="Filtrar por grupo">
                                        <option value="" selected>Todos</option>
                                        @foreach($grupos as $grupo)
                                            <option value="{{ $grupo }}">{{ $grupo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="me-2">
                                    <label class="form-label">No control</label>
                                    <select name="control" class="form-select form-select-sm" aria-label="Filtrar por NO. Control">
                                        <option value="" selected>Todos</option>
                                        @foreach($controles as $control)
                                            <option value="{{ $control }}">{{ $control }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="me-2">
                                    <label class="form-label">Tipo de servicio</label>
                                    <select name="tipo_servicio" class="form-select form-select-sm" aria-label="Filtrar por tipo de servicio">
                                        <option value="" selected>Todos</option>
                                        @foreach($tipos_servicio as $tipo_servicio)
                                            <option value="{{ $tipo_servicio }}">{{ $tipo_servicio }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="me-2">
                                    <label class="form-label">Buscar</label>
                                    <input type="text" name="buscar" class="form-control form-control-sm" aria-label="Search invoice">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
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
                                    <th>Nombre</th>
                                    <th>No. Control</th>
                                    <th>Especialidad</th>
                                    <th>Grupo</th>
                                    <th>Semestre</th>
                                    <th>Fecha</th>
                                    <th>CURP</th>
                                    <th>Tipo Servicio</th>
                                    <th>Status</th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($formularios as $formulario)
                                    @if($formulario->comprobante && $formulario->updated_at->lt(\Carbon\Carbon::now()->subDay()))
                                        @continue
                                    @endif
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $formulario->nombre }}</td>
                                        <td>{{ $formulario->control }}</td>
                                        <td>{{ $formulario->especialidad }}</td>
                                        <td>{{ $formulario->grupo }}</td>
                                        <td>{{ $formulario->semestre }}</td>
                                        <td>{{ $formulario->fecha }}</td>
                                        <td>
                                            <span title="{{ $formulario->curp }}">{{ Str::limit($formulario->curp, 10) }}</span>
                                        </td>
                                        <td>
                                            <span title="{{ $formulario->tipo_servicio }}">{{ Str::limit($formulario->tipo_servicio, 10) }}</span>
                                        </td>
                                        <td>
                                            {{ $formulario->comprobante ? 'Finalizada' : $formulario->status }}
                                        </td>
                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top"
                                                            data-bs-toggle="dropdown">
                                                        Acciones
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="{{ route('gestions.show', $formulario->id) }}" class="dropdown-item">
                                                            Ver
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11">Sin información</td>
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
@endsection
