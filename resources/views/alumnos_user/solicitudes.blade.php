@extends('layouts.page')

@section('title')
    Generar Solicitud
@endsection

@section('content')
    <!-- Encabezado de la página -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Pre-título de la página -->
                    <div class="page-pretitle">
                        Generar
                    </div>
                    <h2 class="page-title">
                        {{ __('Solicitud') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Cuerpo de la página -->
    <div class="page-body">
        <div class="container-xl">
            @if(config('tablar','display_alert'))
                @include('tablar::common.alert')
            @endif
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Nueva Solicitud</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('solicitudes.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="tipo_solicitud">Tipo de Solicitud</label>
                                    <select id="tipo_solicitud" name="tipo_solicitud" class="form-control" required>
                                        <option value="academica">Académica</option>
                                        <option value="administrativa">Administrativa</option>
                                        <option value="financiera">Financiera</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea id="descripcion" name="descripcion" class="form-control" rows="4" required></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-3">Enviar Solicitud</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Listado de Solicitudes -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h3 class="card-title">Mis Solicitudes</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive min-vh-100">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tipo de Solicitud</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                        <th class="w-1"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($solicitudes as $solicitud)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $solicitud->tipo_solicitud }}</td>
                                            <td>{{ $solicitud->descripcion }}</td>
                                            <td>{{ $solicitud->estado }}</td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <a class="btn btn-primary" href="{{ route('solicitudes.show', $solicitud->id) }}">Ver</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">No se encontraron solicitudes.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center">
                                {!! $solicitudes->links('tablar::pagination') !!}
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
