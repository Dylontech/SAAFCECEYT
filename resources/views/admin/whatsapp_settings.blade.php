@extends('tablar::page')

@section('title', 'Configuración de WhatsApp')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Configuración
                    </div>
                    <h2 class="page-title">
                        {{ __('Configuración de WhatsApp') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Actualizar Botón de WhatsApp</h3>
                </div>
                <div class="card-body">
                    <form id="whatsappForm" action="{{ route('update.whatsapp.settings') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Número de WhatsApp:</label>
                            <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" value="{{ $settings->phone_number ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Mensaje (opcional):</label>
                            <input type="text" id="message" name="message" class="form-control" value="{{ $settings->message ?? '' }}">
                            <small class="form-text text-muted">Puedes dejar este campo vacío si no deseas enviar un mensaje.</small>
                        </div>
                        <div class="form-footer">
                            <input type="submit" value="Actualizar" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
