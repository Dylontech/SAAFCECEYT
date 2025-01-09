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
                        <!-- Botón eliminado -->
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
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
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
                                <form action="{{ route('finanzas.store') }}" method="POST" id="status-form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="formulario_id" value="{{ $formulario->id }}">
                                    <select name="status" id="status-select" class="form-control form-control-sm">
                                        <option value="aprobada" {{ $formulario->status == 'aprobada' ? 'selected' : '' }}>Aprobada</option>
                                        <option value="generando_liga_pago" {{ $formulario->status == 'generando_liga_pago' ? 'selected' : '' }}>Generando Liga de Pago</option>
                                        <option value="liga_de_pago_disponible" {{ $formulario->status == 'liga_de_pago_disponible' ? 'selected' : '' }}>Liga de Pago Disponible</option>
                                        <option value="declinada" {{ $formulario->status == 'declinada' ? 'selected' : '' }}>Declinada</option>
                                    </select>
                                    <div id="comentario-div" class="mt-3">
                                        <label for="comentario">Comentario:</label>
                                        <textarea name="comentario" id="comentario" class="form-control">{{ $formulario->comentario }}</textarea>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="liga_de_pago">Subir Liga de Pago:</label>
                                        <input type="file" name="liga_de_pago" id="liga_de_pago" class="form-control">
                                        @if($formulario->liga_de_pago)
                                            <a href="{{ route('finanzas.downloadLigaDePago', $formulario->id) }}" target="_blank" class="btn btn-link">Descargar Liga de Pago</a>
                                        @endif
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="comprobante_alumno">Comprobante de Alumno:</label>
                                        @if($formulario->comprobante_alumno)
                                            <a href="{{ route('finanzas.downloadComprobanteAlumno', ['id' => $formulario->id]) }}" target="_blank" class="btn btn-link">Descargar Comprobante de Alumno</a>
                                        @else
                                            <p>Sin comprobante de alumno</p>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
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
