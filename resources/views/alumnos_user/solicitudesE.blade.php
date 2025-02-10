{{-- 

    Esta plantilla Blade extiende el diseño 'tablar::page' y define el contenido para la página 'Solicitudes E'.
    Incluye un encabezado de página, un formulario de filtro y una tabla para mostrar las solicitudes.

    Secciones:
    - title: Establece el título de la página a 'Solicitudes E'.
    - content: Contiene el contenido principal de la página, incluyendo el encabezado, el formulario de filtro y la tabla.

    JavaScript:
    - fetchFilteredData(url, data, showAll): Obtiene datos filtrados usando AJAX y actualiza el cuerpo de la tabla.
    - $('#filterButton').on('click'): Maneja el evento de clic del botón de filtro para obtener datos filtrados.
    - $('#resetButton').on('click'): Maneja el evento de clic del botón de reinicio para obtener todos los registros y restablecer el formulario.
--}}

{{-- 
    Función: fetchFilteredData
    Descripción: Obtiene datos filtrados usando AJAX y actualiza el cuerpo de la tabla.
    Parámetros:
    - url (string): La URL a la que se enviará la solicitud AJAX.
    - data (object): Los datos que se enviarán con la solicitud AJAX.
    - showAll (boolean): Si se deben obtener todos los registros (true) o solo los registros filtrados (false).
--}}

{{-- 
    Manejador de Eventos: $('#filterButton').on('click')
    Descripción: Maneja el evento de clic del botón de filtro para obtener datos filtrados.
    Previene el envío predeterminado del formulario y envía una solicitud AJAX con los datos del formulario.
--}}

{{-- 
    Manejador de Eventos: $('#resetButton').on('click')
    Descripción: Maneja el evento de clic del botón de reinicio para obtener todos los registros y restablecer el formulario.
    Previene la acción predeterminada del botón, restablece el formulario y envía una solicitud AJAX para obtener todos los registros.
--}}
@extends('tablar::page')

@section('title')
    Solicitudes E
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle"></div>
                    <h2 class="page-title">
                        {{ __('Solicitudes ') }}
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
                            <form id="filterForm" method="GET">
                                <div class="d-flex flex-wrap align-items-center">
                                    <div class="me-2">
                                        <label for="materias" class="form-label">Materias</label>
                                        <select id="materias" name="materias" class="form-control">
                                            <option value="">Todas</option>
                                            @foreach ($materias as $materia)
                                                <option value="{{ $materia }}">{{ $materia }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="me-2">
                                        <label for="tipo_pago" class="form-label">Seleccione el tipo de pago</label>
                                        <select id="tipo_pago" name="tipo_pago" class="form-control">
                                            <option value="">Todos</option>
                                            <option value="recuperacion">Recuperación (R2) Todas las Asignaturas</option>
                                            <option value="regularizacion">Regularización (3 Asignaturas)</option>
                                            <option value="curso_intensivo">Curso Intensivo (Submódulos)</option>
                                            <option value="titulo_suficiencia">Título Suficiencia</option>
                                            <option value="segundo_curso_intensivo">2º Curso Intensivo (Submódulos)</option>
                                        </select>
                                    </div>
                                    <div class="me-2">
                                        <label for="fecha_pago" class="form-label">Fecha de Pago</label>
                                        <input type="date" id="fecha_pago" name="fecha_pago" class="form-control" value="{{ request('fecha_pago') }}">
                                    </div>
                                    <div class="me-2 align-self-end">
                                        <button type="submit" id="filterButton" class="btn btn-primary">Filtrar</button>
                                    </div>
                                    <div class="me-2">
                                        <label for="buscar" class="form-label">Buscar</label>
                                        <input type="text" id="buscar" name="buscar" class="form-control" value="{{ request('buscar') }}">
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
                                        {{-- <th>Número de Control</th>
                                        <th>Especialidad</th> --}}
                                        <th>Grupo</th>
                                        <th>Tipo de Pago</th>
                                        <th>Fecha de Pago</th>
                                        <th>Materias</th>
                                        <th>Status</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @forelse ($formularios as $formulario)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $formulario->nombre }}</td>
                                            {{-- <td>{{ $formulario->numero_control }}</td>
                                            <td>{{ $formulario->especialidad }}</td> --}}
                                            <td>{{ $formulario->grupo }}</td>
                                            <td>{{ $formulario->tipo_pago }}</td>
                                            <td>{{ $formulario->fecha_pago }}</td>
                                            <td>
                                                @php
                                                    $materiasArray = array_column(json_decode($formulario->materias, true), 'nombre');
                                                    $materiasText = implode(', ', $materiasArray);
                                                @endphp
                                                @if (count($materiasArray) > 1)
                                                    <span data-bs-toggle="tooltip" title="{{ $materiasText }}">
                                                        {{ $materiasArray[0] }}, ...
                                                    </span>
                                                @else
                                                    {{ $materiasText }}
                                                @endif
                                            </td>
                                            <td>
                                                <span data-bs-toggle="tooltip" title="{{ $formulario->comentario }}">
                                                    {{ $formulario->status }}
                                                </span>
                                            </td>
                                            
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">Acciones</button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <form action="{{ route('solicitudesE.destroy', $formulario->id) }}" method="POST" class="delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-red delete-button">
                                                                    <i class="fa fa-fw fa-trash"></i> Eliminar
                                                                </button>
                                                            </form>
                                                
                                                            @if($formulario->liga_de_pago)
                                                                <a href="{{ route('formularios.downloadLigaDePago', $formulario->id) }}" target="_blank" class="dropdown-item">
                                                                    <i class="fa fa-fw fa-download"></i> Descargar Liga de Pago
                                                                </a>
                                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#cargarComprobanteModal{{ $formulario->id }}">
                                                                    <i class="fa fa-fw fa-upload"></i> Cargar Comprobante del Alumno
                                                                </a>
                                                            @endif
                                                
                                                            @if($formulario->comprobante)
                                                                <a href="{{ route('formularios.downloadStudentReceipt', $formulario->id) }}" target="_blank" class="dropdown-item">
                                                                    <i class="fa fa-fw fa-download"></i> Descargar Comprobante
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <!-- Modal para cargar comprobante -->
                                                @foreach ($formularios as $formulario)
                                                    <div class="modal fade" id="cargarComprobanteModal{{ $formulario->id }}" tabindex="-1" aria-labelledby="cargarComprobanteModalLabel{{ $formulario->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="cargarComprobanteModalLabel{{ $formulario->id }}">Cargar Comprobante</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('formularios.uploadComprobanteAlumno', $formulario->id) }}" method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            <label for="comprobante_alumno" class="form-label">Seleccionar archivo</label>
                                                                            <input type="file" class="form-control" id="comprobante_alumno" name="comprobante_alumno" required>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                            <button type="submit" class="btn btn-primary">Cargar</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                
                                                @section('scripts')
                                                    <script>
                                                        // Inicializar tooltips
                                                        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                                                        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                                                            return new bootstrap.Tooltip(tooltipTriggerEl);
                                                        });
                                                    </script>
                                                @endsection
                                                
                                                
                                                
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10">Sin información</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            $(document).ready(function() {
                function fetchFilteredData(url, data, showAll = false) {
                    if (showAll) {
                        data = {}; // Clear the data to fetch all records
                    }
                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: data,
                        success: function(response) {
                            var newTableBody = $(response).find('#tableBody').html();
                            $('#tableBody').html(newTableBody);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error: ' + error);
                        }
                    });
                }

                // Filtrar utilizando AJAX
                $('#filterButton').on('click', function(event) {
                    event.preventDefault();
                    var data = $('#filterForm').serialize();
                    fetchFilteredData('{{ route("formularios.index") }}', data);
                });
                // Mostrar todos los registros
                $('#resetButton').on('click', function(event) {
                    event.preventDefault();
                    $('#filterForm').trigger('reset');
                    fetchFilteredData('{{ route("formularios.index") }}', {}, true);
                });
            });
        </script>
    @endsection