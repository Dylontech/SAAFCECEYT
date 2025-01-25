@extends('tablar::page')

@section('title')
    Alumnos
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
                        {{ __('Alumnos ') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('alumnos.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Registrar Nuevo Alumno
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
                            <h3 class="card-title">Alumnos</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <form method="GET" action="{{ route('alumnos.index') }}">
                                <div class="d-flex align-items-center">
                                    <div class="text-muted me-3">
                                        <label for="search" class="form-label">Grupos</label>
                                        <div class="mx-2 d-inline-block">
                                            <select class="form-control form-control-sm" name="grupo">
                                                <option value="">Todos</option>
                                                @foreach($grupos as $grupo)
                                                    <option value="{{ $grupo }}" {{ request('grupo') == $grupo ? 'selected' : '' }}>{{ $grupo }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-muted me-3">
                                        <label for="search" class="form-label">Especialidad</label>
                                        <div class="mx-2 d-inline-block">
                                            <select class="form-control form-control-sm" name="especialidad">
                                                <option value="">Todas</option>
                                                @foreach($especialidades as $especialidad)
                                                    <option value="{{ $especialidad }}" {{ request('especialidad') == $especialidad ? 'selected' : '' }}>{{ $especialidad }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-muted me-3">
                                        <label for="search" class="form-label">Buscar</label>
                                        <div class="mx-2 d-inline-block">
                                            <input type="text" class="form-control form-control-sm" name="search" value="{{ request('search') }}" aria-label="Search invoice">
                                        </div>
                                    </div>
                                    <div class="ms-2">
                                        <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive min-vh-100">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                <tr>
                                    <th>Numero de Control</th>
                                    <th>Curp</th>
                                    <th>Especialidad</th>
                                    <th>Semestre</th> <!-- Añadido -->
                                    <th>Grupo</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Estatus</th>

                                    <th class="w-1"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse ($alumnos as $alumno)
                                    <tr>
                                        <td>{{ $alumno->numero_control }}</td>
                                        <td>{{ $alumno->CURP }}</td>
                                        <td>{{ $alumno->especialidad }}</td>
                                        <td>{{ $alumno->semestre }}</td> <!-- Añadido -->
                                        <td>{{ $alumno->Grupo }}</td>
                                        <td>{{ $alumno->Nombre }}</td>
                                        <td>{{ $alumno->email }}</td>
                                        <td>{{ $alumno->estatus }}</td>

                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top"
                                                            data-bs-toggle="dropdown">
                                                        Acciones
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                           href="{{ route('alumnos.show',$alumno->id) }}">
                                                            Vista general
                                                        </a>
                                                        <a class="dropdown-item"
                                                           href="{{ route('alumnos.edit',$alumno->id) }}">
                                                            Editar
                                                        </a>
                                                        <form
                                                            action="{{ route('alumnos.destroy',$alumno->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="dropdown-item text-red" onclick="confirmDelete(event)">
                                                                    <i class="fa fa-fw fa-trash"></i> Eliminar
                                                                </button>
                                                            </form>
                                                            
                                                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                            <script>
                                                                function confirmDelete(event) {
                                                                    event.preventDefault();
                                                                    Swal.fire({
                                                                        title: "¿Estás seguro?",
                                                                        text: "¡No podrás revertir esto!",
                                                                        icon: "warning",
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: "#3085d6",
                                                                        cancelButtonColor: "#d33",
                                                                        confirmButtonText: "Sí, elimínalo",
                                                                        cancelButtonText: "Cancelar"
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            event.target.closest('form').submit();
                                                                            Swal.fire({
                                                                                title: "¡Eliminado!",
                                                                                text: "Tu archivo ha sido eliminado.",
                                                                                icon: "success"
                                                                            });
                                                                        }
                                                                    });
                                                                }
                                                            </script>
                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <td>Sin informacion</td>
                                @endforelse
                                </tbody>

                            </table>
                        </div>
                       <div class="card-footer d-flex align-items-center">
                            {!! $alumnos->links('tablar::pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection