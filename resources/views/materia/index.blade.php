@extends('tablar::page')

@section('title')
    Materia
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Lista
                    </div>
                    <h2 class="page-title">
                        {{ __('Materia ') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('materias.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Crear Materia
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
                            <h3 class="card-title">Materia</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            {{-- <form method="GET" action="{{ route('materias.index') }}">
                                <div class="d-flex align-items-center">
                                    <div class="text-muted me-3">
                                        <label class="form-label d-none d-sm-inline-block">Buscar:</label>
                                        <input type="text" name="search" class="form-control form-control-sm" id="searchInput" aria-label="Search invoice" value="{{ request()->input('search') }}">
                                    </div>
                                    <div class="text-muted me-3">
                                        <label class="form-label d-none d-sm-inline-block">Semestre:</label>
                                        <select name="semester" class="form-control form-control-sm" id="semesterFilter">
                                            <option value="">Todos</option>
                                            <option value="1" {{ request()->input('semester') == 1 ? 'selected' : '' }}>Semestre 1</option>
                                            <option value="2" {{ request()->input('semester') == 2 ? 'selected' : '' }}>Semestre 2</option>
                                            <option value="3" {{ request()->input('semester') == 3 ? 'selected' : '' }}>Semestre 3</option>
                                            <option value="4" {{ request()->input('semester') == 4 ? 'selected' : '' }}>Semestre 4</option>
                                            <option value="5" {{ request()->input('semester') == 5 ? 'selected' : '' }}>Semestre 5</option>
                                            <option value="6" {{ request()->input('semester') == 6 ? 'selected' : '' }}>Semestre 6</option>
                                        </select>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-sm">filtrar</button>
                                    </div>
                                </div>
                            </form> --}}
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
                                    
                                        <th>Materia</th>
                                        <th>Semestre</th>
                                        <th>Especialidad</th>

                                    <th class="w-1"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse ($materias as $materia)
                                    <tr>
                                        <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                   aria-label="Select materia"></td>
                                        <td>{{ ++$i }}</td>
                                        
                                            <td>{{ $materia->materia }}</td>
                                            <td>{{ $materia->semestre }}</td>
                                            <td>{{ $materia->especialidad }}</td>

                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top"
                                                            data-bs-toggle="dropdown">
                                                        Acciones
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                           href="{{ route('materias.show',$materia->id) }}">
                                                            Ver
                                                        </a>
                                                        <a class="dropdown-item"
                                                           href="{{ route('materias.edit',$materia->id) }}">
                                                            Editar
                                                        </a>
                                                        <form
                                                            action="{{ route('materias.destroy',$materia->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    onclick="if(!confirm('¿Desea proceder?')){return false;}"
                                                                    class="dropdown-item text-red"><i
                                                                    class="fa fa-fw fa-trash"></i>
                                                                Eliminar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <td>No se encontraron datos</td>
                                @endforelse
                                </tbody>

                            </table>
                        </div>
                       <div class="card-footer d-flex align-items-center">
                            {!! $materias->links('tablar::pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
