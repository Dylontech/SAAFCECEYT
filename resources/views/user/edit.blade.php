@extends('tablar::page')

@section('title', 'Editar Usuario')

@section('content')
<div class="container">
    <h2 class="my-4">Editar Usuario</h2>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Regresar a la vista principal</a>
    </div>
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Correo Electrónico</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        @if (auth()->user()->hasRole('admin'))
        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Deja en blanco si no deseas cambiarla">
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirma tu contraseña">
            @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        @endif
        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
    </form>
    @if (!auth()->user()->hasRole('admin'))
        <div class="alert alert-danger mt-3" role="alert">
            No tienes permiso para editar usuarios.
        </div>
    @endif
</div>
@endsection



