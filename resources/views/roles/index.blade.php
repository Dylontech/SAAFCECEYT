@extends('tablar::page')

@section('content')
    <div class="container mt-5">
        <h2>Asignar Roles a Usuarios</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('roles.assign') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="role_id">Rol</label>
                <select name="role_id" class="form-control" required>
                    @foreach($roles as $role)
                        @if(in_array($role->name, ['admin', 'control_escolar', 'servicio_financiero']))
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="user_ids">Usuarios</label>
                <div class="accordion" id="usersAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-users">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-users" aria-expanded="false" aria-controls="collapse-users">
                                Seleccionar Usuarios
                            </button>
                        </h2>
                        <div id="collapse-users" class="accordion-collapse collapse" aria-labelledby="heading-users" data-bs-parent="#usersAccordion">
                            <div class="accordion-body">
                                @foreach($users as $user)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="user_ids[]" value="{{ $user->id }}" id="user-checkbox-{{ $user->id }}">
                                        <label class="form-check-label" for="user-checkbox-{{ $user->id }}">
                                            {{ $user->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Asignar Roles</button>
        </form>

        <!-- Lista de Roles y Usuarios Asignados con Menús Desplegables -->
        <div class="mt-5">
            <h3>Lista de Roles y Usuarios Asignados</h3>
            <div class="accordion" id="rolesAccordion">
                @foreach($roles as $role)
                    @if(in_array($role->name, ['admin', 'control_escolar', 'servicio_financiero']))
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-{{ $role->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $role->id }}" aria-expanded="false" aria-controls="collapse-{{ $role->id }}">
                                    {{ $role->name }}
                                </button>
                            </h2>
                            <div id="collapse-{{ $role->id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $role->id }}" data-bs-parent="#rolesAccordion">
                                <div class="accordion-body">
                                    <ul class="list-group mb-3">
                                        @foreach($role->users as $user)
                                            <li class="list-group-item">{{ $user->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Paginación para Usuarios -->
        @if ($users->hasPages())
            <div class="d-flex align-items-center mt-4">
                <p class="m-0 text-muted">Mostrando <span>{{ $users->firstItem() }}</span> a <span>{{ $users->lastItem() }}</span> de <span>{{ $users->total() }}</span> entradas</p>
                <ul class="pagination m-0 ms-auto">
                    @if ($users->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <polyline points="15 6 9 12 15 18"/>
                                </svg>
                                Anterior
                            </a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $users->previousPageUrl() }}" tabindex="-1" aria-disabled="true">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <polyline points="15 6 9 12 15 18"/>
                                </svg>
                                Anterior
                            </a>
                        </li>
                    @endif

                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                        @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $users->currentPage())
                                    <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    @if ($users->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $users->nextPageUrl() }}">
                                Siguiente
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <polyline points="9 6 15 12 9 18"/>
                                </svg>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#">
                                Siguiente
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <polyline points="9 6 15 12 9 18"/>
                                </svg>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        @endif
    </div>
@stop
