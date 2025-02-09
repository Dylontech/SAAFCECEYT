@extends('tablar::page')

@section('title', 'Ver Solicitud')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Financieros
                    </div>
                    <h2 class="page-title">
                        Detalles de la Solicitud
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detalles de la Solicitud</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <strong>Nombre del Alumno:</strong> {{ $formulario->nombre }}
                            </div>
                            <div class="form-group">
                                <strong>Número de Control:</strong> {{ $formulario->numero_control }}
                            </div>
                            <div class="form-group">
                                <strong>CURP:</strong> {{ $formulario->curp }}
                            </div>
                            <div class="form-group">
                                <strong>Grupo:</strong> {{ $formulario->grupo }}
                            </div>
                            <div class="form-group">
                                <strong>Especialidad:</strong> {{ $formulario->especialidad }}
                            </div>
                            
                            <div class="form-group">
                                <strong>Materias:</strong>
                                @if($formulario->materias)
                                    <?php $materias = json_decode($formulario->materias, true); ?>
                                    @if(is_array($materias))
                                        @php
                                            $materiasFiltradas = array_filter(array_column($materias, 'nombre'));
                                        @endphp
                                        @if(count($materiasFiltradas) > 0)
                                            {{ implode(', ', $materiasFiltradas) }}
                                        @else
                                            No hay materias disponibles.
                                        @endif
                                    @else
                                        No hay materias disponibles.
                                    @endif
                                @else
                                    No hay materias disponibles.
                                @endif
                            </div>
                            
                            
                            <div class="form-group">
                                <strong>Fecha:</strong> {{ $formulario->fecha_pago }}
                            </div>
                            
                            <div class="form-group">
                                <strong>Tipo de Servicio:</strong> {{ $formulario->tipo_pago }}
                            </div>
                            <div class="form-group">
                                <strong>Status:</strong> {{ $formulario->status }}
                            </div>

                            <div class="form-group mt-3">
                                <strong>Comentario a Servicio Financiero:</strong>
                                <textarea class="form-control" readonly>{{ $formulario->comentario_financiero }}</textarea>
                            </div>

                            <div class="form-group mt-3">
                                <form action="{{ route('formularios.uploadLigaDePago', $formulario->id) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                                    @csrf
                                    <div class="form-group">
                                        <label for="liga_de_pago">Subir Liga de Pago:</label>
                                        <input type="file" class="form-control" name="liga_de_pago" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Subir</button>
                                </form>
                            
                                <strong>Liga de Pago:</strong>
                                @if($formulario->liga_de_pago)
                                    <a href="{{ route('formularios.downloadLigaDePago', $formulario->id) }}" target="_blank" class="btn btn-link">Descargar Liga de Pago</a>
                                @else
                                    <p>Sin Liga de Pago</p>
                                @endif
                            </div>
                            
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const downloadLink = document.querySelector('a.btn.btn-link');
                                    if (!downloadLink) {
                                        document.querySelector('a.btn.btn-link').style.display = 'none';
                                    }
                                });
                            </script>
                            
                            <div class="form-group mt-3">
                                <strong>Comprobante de Alumno:</strong>
                                @if($formulario->comprobante_alumno)
                                    <a href="{{ route('formularios.downloadComprobanteAlumno', $formulario->id) }}" target="_blank" class="btn btn-link">Descargar Comprobante de Alumno</a>
                                @else
                                    Sin Comprobante de Alumno
                                @endif
                            </div>
                            
                            @if($formulario->comprobante_alumno)
                                <div class="form-group mt-3">
                                    <form action="{{ route('formularios.uploadComprobanteOficial', $formulario->id) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                                        @csrf
                                        <div class="form-group">
                                            <label for="comprobante_oficial">Subir Comprobante Oficial:</label>
                                            <input type="file" class="form-control" name="comprobante_oficial" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Subir</button>
                                    </form>
                            
                                    <strong>Comprobante Oficial:</strong>
                                    @if($formulario->comprobante_oficial)
                                        <a href="{{ route('formularios.downloadComprobanteOficial', $formulario->id) }}" target="_blank" class="btn btn-link">Descargar Comprobante Oficial</a>
                                    @else
                                        Sin Comprobante Oficial
                                    @endif
                                </div>
                            @endif
                            <div class="form-group mt-3">
                                <button type="button" class="btn btn-primary" onclick="window.print();">Imprimir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection