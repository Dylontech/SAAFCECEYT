@extends('tablar::page')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Bienvenido a SAAFCECEYT
                    </div>
                    <h2 class="page-title">
                        ADMIN
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Novedades</h3>
                        </div>                   
                        <img src="{{ asset('assets/plantel.jpg') }}" alt="Imagen del Plantel">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection