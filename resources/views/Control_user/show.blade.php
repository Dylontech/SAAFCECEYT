@extends('tablar::page')

@section('title', 'Ver Solicitud')

@section('content')
    <!-- Encabezado de página -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Pre-título de la página -->
                    <div class="page-pretitle">
                        Ver
                    </div>
                    <h2 class="page-title">
                        {{ __('Solicitud ') }}
                    </h2>
                </div>
                <!-- Acciones del título de la página -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('gestions.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Descargar icono SVG desde http://www.tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Lista de Solicitudes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cuerpo de la página -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    @if(config('tablar','display_alert'))
                        @include('tablar::common.alert')
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detalles de la Solicitud</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <strong>Nombre del Alumno:</strong>
                                {{ $formulario->nombre }}
                            </div>
                            <div class="form-group">
                                <strong>Número de Control:</strong>
                                {{ $formulario->control }}
                            </div>
                            <div class="form-group">
                                <strong>Especialidad:</strong>
                                {{ $formulario->especialidad }}
                            </div>
                            <div class="form-group">
                                <strong>Grupo:</strong>
                                {{ $formulario->grupo }}
                            </div>
                            <div class="form-group">
                                <strong>Generación:</strong>
                                {{ $formulario->generacion }}
                            </div>
                            <div class="form-group">
                                <strong>Semestre:</strong>
                                {{ $formulario->semestre }}
                            </div>
                            <div class="form-group">
                                <strong>Fecha:</strong>
                                {{ $formulario->fecha }}
                            </div>
                            <div class="form-group">
                                <strong>CURP:</strong>
                                {{ $formulario->curp }}
                            </div>
                            <div class="form-group">
                                <strong>Tipo de Servicio:</strong>
                                {{ $formulario->tipo_servicio }}
                            </div>
                            <div class="form-group">
                                <strong>Status:</strong>
                                <form action="{{ route('gestions.updateStatus', $formulario->id) }}" method="POST" id="status-form">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" id="status-select" class="form-control mb-3">
                                        <option value="aprobada" {{ $formulario->status == 'aprobada' ? 'selected' : '' }}>Aprobada</option>
                                        <option value="generando_liga_pago" {{ $formulario->status == 'generando_liga_pago' ? 'selected' : '' }}>Generando Liga de Pago</option>
                                        <option value="declinada" {{ $formulario->status == 'declinada' ? 'selected' : '' }}>Declinada</option>
                                    </select>
                                    <div id="comentario-div" class="mt-3">
                                        <label for="comentario">Comentario:</label>
                                        <textarea name="comentario" id="comentario" class="form-control">{{ $formulario->comentario }}</textarea>
                                    </div>
                                    <div class="mt-3">
                                        <label for="comentario_financiero">Comentario a Servicio Financiero:</label>
                                        <textarea name="comentario_financiero" id="comentario_financiero" class="form-control">{{ $formulario->comentario_financiero }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                                </form>
                            </div>
                            <div class="form-group mt-4">
                                <a href="{{ route('finanzas.downloadComprobanteOficial', $formulario->id) }}" class="btn btn-secondary mt-2"
                                   @if(!$formulario->comprobante_oficial) style="display: none;" @endif>
                                    Descargar Comprobante Oficial
                                </a>
                            </div>
                            <div class="form-group mt-4">
                                <form action="{{ route('gestions.uploadComprobante', $formulario->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label for="comprobante">Subir Comprobante:</label>
                                    <input type="file" name="comprobante" id="comprobante" class="form-control">
                                    <div class="alert alert-warning mt-2" role="alert">
                                        El tamaño máximo permitido para los archivos es de 10 MB.
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Subir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('status-select').addEventListener('change', function () {
            if (this.value === 'declinada') {
                document.getElementById('comentario').setAttribute('required', 'required');
            } else {
                document.getElementById('comentario').removeAttribute('required');
            }
        });
    </script>
@endsection
