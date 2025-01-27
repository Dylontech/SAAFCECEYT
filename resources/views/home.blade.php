@extends('tablar::page')

@section('title', 'Home')

@section('content')
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
            
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                              @foreach($carrusels as $index => $carrusel)
                                  <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></button>
                              @endforeach
                          </div>
                          <div class="carousel-inner">
                              @foreach($carrusels as $index => $carrusel)
                                  <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                      <img class="d-block w-100" alt="{{ $carrusel->Description }}" src="{{ $carrusel->Urlfoto }}" />
                                  </div>
                              @endforeach
                          </div>
                          <a class="carousel-control-prev" data-bs-target="#carousel-sample" role="button" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                          </a>
                          <a class="carousel-control-next" data-bs-target="#carousel-sample" role="button" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                          </a>
                      </div>>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection