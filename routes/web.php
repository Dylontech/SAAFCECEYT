<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/alumnos', App\Http\Controllers\AlumnoController::class);
Route::resource('/materias', App\Http\Controllers\MateriaController::class);
Route::resource('/especialidades', App\Http\Controllers\EspecialidadeController::class);
Route::resource('/solicitudes', App\Http\Controllers\SolicitudeController::class);

// Modificación de la ruta de búsqueda
Route::get('/search', [\App\Http\Controllers\SearchController::class, 'search'])->name('search');

