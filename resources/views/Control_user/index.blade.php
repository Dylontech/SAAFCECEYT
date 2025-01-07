@extends('tablar::page')

@section('title')
    GestionSE
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
                        {{ __('GestionSE') }}
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
                            <div class="d-flex">
                                <div class="text-muted">
                                    Mostrar
                                    <div class="mx-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm" value="10" size="3"
                                               aria-label="Invoices count">
                                    </div>
                                    Registros
                                </div>
                                <div class="ms-auto text-muted">
                                    Buscar:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm"
                                               aria-label="Search invoice">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive min-vh-100">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                <tr>
                                    <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                                                           aria-label="Select all invoices"></th>
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
                                            <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                       aria-label="Select solicitud"></td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $formulario->nombre }}</td>
                                            <td>{{ $formulario->numero_control }}</td>
                                            <td>{{ $formulario->especialidad }}</td>
                                            <td>{{ $formulario->grupo }}</td>
                                            <td>{{ $formulario->tipo_pago }}</td>
                                            <td>{{ $formulario->fecha_pago }}</td>
                                            <td>
                                                @if ($formulario->materias)
                                                    {{ implode(', ', array_column(json_decode($formulario->materias, true), 'nombre')) }}
                                                @else
                                                    No hay materias
                                                @endif
                                            </td>
                                            <td>{{ $formulario->status }}</td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle align-text-top"
                                                                data-bs-toggle="dropdown">
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
@endsection

