@extends('tablar::page')

@section('title')
    Especialidad
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        List
                    </div>
                    <h2 class="page-title">
                        {{ __('Especialidad ') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('filtrar') }}" class="btn btn-secondary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Filtrar
                        </a>
                        <a href="{{ route('especialidad.create') }}" class="btn btn-warning d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Alta Especialidad
                        </a>
                    </div>
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
                            <h3 class="card-title">Especialidad</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-muted">
                                    Mostrar
                                    <div class="mx-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm" value="10" size="3"
                                               aria-label="Invoices count">
                                    </div>
                                    Filtrar
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
                                    
										<th>Nombre</th>
										<th>Tipo</th>

                                    <th class="w-1"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse ($especialidads as $especialidad)
                                    <tr>
                                        <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                   aria-label="Select especialidad"></td>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $especialidad->Nombre }}</td>
											<td>{{ $especialidad->Tipo }}</td>

                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top"
                                                            data-bs-toggle="dropdown">
                                                        Acciones
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                           href="{{ route('especialidads.show',$especialidad->id) }}">
                                                            Ver
                                                        </a>
                                                        <a class="dropdown-item"
                                                           href="{{ route('especialidads.edit',$especialidad->id) }}">
                                                            Editar
                                                        </a>
                                                        <!DOCTYPE html>
                                                        <html lang="es">
                                                        <head>
                                                            <meta charset="UTF-8">
                                                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                                            <title>Eliminar Registro</title>
                                                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                                                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                            <script>
                                                                function cancelarRegistro(event) {
                                                                    event.preventDefault(); // Evita el comportamiento predeterminado del botón
                                                        
                                                                    const swalWithBootstrapButtons = Swal.mixin({
                                                                        customClass: {
                                                                            confirmButton: "btn btn-success",
                                                                            cancelButton: "btn btn-danger"
                                                                        },
                                                                        buttonsStyling: false
                                                                    });
                                                        
                                                                    swalWithBootstrapButtons.fire({
                                                                        title: "¿Estas seguro de eliminar el registro?",
                                                                        text: "¡Esta accion no es reversible!",
                                                                        icon: "warning",
                                                                        showCancelButton: true,
                                                                        confirmButtonText: "¡Si, eliminalo!",
                                                                        cancelButtonText: "¡Cancelar!",
                                                                        reverseButtons: true
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            // Si se confirma la eliminación, envía el formulario
                                                                            document.getElementById("eliminarForm").submit();
                                                                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                                                                            swalWithBootstrapButtons.fire({
                                                                                title: "Accion cancelada",
                                                                                text: "Tu archivo esta a salvo :)",
                                                                                icon: "error"
                                                                            });
                                                                        }
                                                                    });
                                                                }
                                                            </script>
                                                        </head>
                                                        <body>
                                                            <form id="eliminarForm" action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="cancelarRegistro(event)" class="dropdown-item text-red">
                                                                    <i class="fa fa-fw fa-trash"></i> Eliminar
                                                                </button>
                                                            </form>
                                                        </body>
                                                        </html>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <td>No Data Found</td>
                                @endforelse
                                </tbody>

                            </table>
                        </div>
                       <div class="card-footer d-flex align-items-center">
                            {!! $especialidads->links('tablar::pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
