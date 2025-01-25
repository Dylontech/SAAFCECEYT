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
                        <label class="label label-primary">{{ Auth::user()->name }}</label>
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
                        <div id="carousel-sample" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                              <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="0" class="active"></button>
                              <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="1"></button>
                              <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="2"></button>
                              <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="3"></button>
                              <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="4"></button>
                            </div>
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img class="d-block w-100" alt="" src="assets/plantel.jpg" />
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" alt="" src="assets/plantel.jpg" />
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" alt="" src="assets/plantel.jpg" />
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" alt="" src="assets/plantel.jpg" />
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" alt="" src="assets/plantel.jpg" />
                              </div>
                            </div>
                            <a class="carousel-control-prev" data-bs-target="#carousel-sample" role="button" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" data-bs-target="#carousel-sample" role="button" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                            </a>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection