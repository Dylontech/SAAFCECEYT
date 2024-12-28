<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SolicitudController;

// Página principal
Route::get('/', function () {
    return redirect('/login');
});

// Rutas de autenticación (sin Auth::routes())
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rutas de restablecimiento de contraseña
Route::get('/password/reset', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

// Rutas para usuarios autenticados
Route::middleware(['auth:web'])->group(function () {
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/alumnos', \App\Http\Controllers\AlumnoController::class);
    Route::resource('/materias', \App\Http\Controllers\MateriaController::class);
    Route::resource('/especialidades', \App\Http\Controllers\EspecialidadeController::class);
    Route::resource('/solicitudes', \App\Http\Controllers\SolicitudeController::class);

    Route::get('/search', [\App\Http\Controllers\SearchController::class, 'search'])->name('search');
    Route::get('/configuracion', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/configuracion/asignar', [RoleController::class, 'assignRoles'])->name('roles.assign');
    Route::resource('users', UserController::class);
});

// Rutas para alumnos autenticados
Route::middleware(['auth:alumno'])->group(function () {
    Route::get('/alumnos_user', function () {
        return view('alumnos_user.index');
    })->name('alumnos_user.index');

    // Ruta para el formulario independiente
    Route::get('/formulario', function () {
        return view('alumnos_user.formulario');
    })->name('formulario');
});


