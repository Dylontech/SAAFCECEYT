@extends('tablar::page')

@section('content')
<div class="container mt-5">
    <h2>Administración de la Base de Datos</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Formulario para hacer respaldo de toda la base de datos -->
    <form action="{{ route('admin.download-backup-database') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="database">Base de Datos:</label>
            <input type="text" name="database" id="database" class="form-control" value="{{ env('DB_DATABASE') }}" readonly>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Descargar Respaldo Completo</button>
    </form>

    <!-- Formulario para hacer respaldo de una tabla específica -->
    <form action="{{ route('admin.download-backup-table') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="table">Nombre de la Tabla:</label>
            <select name="table" id="table" class="form-control" required>
                @foreach($tables as $table)
                    <option value="{{ $table }}">{{ $table }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Descargar Respaldo de la Tabla</button>
    </form>
</div>
@endsection

