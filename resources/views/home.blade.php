@extends('tablar::page')

@section('content')
<<<<<<< Updated upstream
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Bienvenido a SAAFCECEYT
=======
    <style>
        .carousel-item img {
            max-width: 1440px;
            max-height: 960px;
            width: auto;
            height: auto;
            margin: 0 auto; /* Center the image */
        }
    </style>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        Bienvenido
            
>>>>>>> Stashed changes
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