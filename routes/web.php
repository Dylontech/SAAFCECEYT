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
Route::resource('/alumno', App\Http\Controllers\AlumnoController::class);
Route::resource('/materia', App\Http\Controllers\MateriaController::class);
Route::resource('/especialidad', App\Http\Controllers\EspecialidadController::class);
Route::resource('/usuarios', App\Http\Controllers\UsuarioController::class);
Route::resource('/solicitudes', App\Http\Controllers\SolicitudeController::class);
Route::get('/filtrar', function () {
    return view('alumno.filtrar');
})->name('filtrar');
