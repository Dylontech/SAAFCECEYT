<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WhatsappSettingsController;
use App\Http\Controllers\FormularioEController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\ControlUserController; // Importa el controlador
use App\Http\Controllers\GestionSController; // Importa el nuevo controlador
use App\Http\Controllers\FinanzasUserController; // Importa el nuevo controlador
use App\Http\Controllers\GestionEController;

// Página principal
Route::get('/', function () {
    return redirect('/login');
});

// Rutas de autenticación (sin Auth::routes())
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Rutas de restablecimiento de contraseña
Route::get('/password/reset', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

// Rutas para usuarios autenticados
Route::middleware(['auth:web'])->group(function () {
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/alumnos', AlumnoController::class);
    
   
    Route::resource('/solicitudes', \App\Http\Controllers\SolicitudeController::class);
    Route::get('/search', [\App\Http\Controllers\SearchController::class, 'search'])->name('search');
    Route::get('/configuracion', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/configuracion/asignar', [RoleController::class, 'assignRoles'])->name('roles.assign');
    Route::resource('users', UserController::class);

    // Ruta para búsqueda de alumnos
    Route::get('/search/alumnos', [AlumnoController::class, 'search'])->name('search.alumnos');
});

// Rutas para alumnos autenticados
Route::middleware(['auth:alumno'])->group(function () {
    Route::get('/alumnos_user', function () {
        return view('alumnos_user.index');
    })->name('alumnos_user.index');

    // Ruta para el formulario independiente
    Route::get('/formulario', [FormularioEController::class, 'create'])->name('formulario');

    // Rutas para el controlador FormularioEController
    Route::get('/formulario/create', [FormularioEController::class, 'create'])->name('formulario.create');
    Route::post('/formulario/store', [FormularioEController::class, 'store'])->name('formulario.store');
    Route::delete('/formulario/{id}', [FormularioEController::class, 'destroy'])->name('formulario.destroy');

    // Ruta para la vista de solicitudesE
    Route::get('/solicitudesE', [FormularioEController::class, 'solicitudesE'])->name('solicitudesE.index');

    // Ruta para la vista de servicios
    Route::get('/servicios', function () {
        return view('alumnos_user.servicios');
    })->name('servicios');

    // Ruta para la vista del editor
    Route::get('/editor', function () {
        return view('alumnos_user.editor');
    })->name('editor');

    // Rutas para FormularioController
    Route::get('/formularios', [FormularioController::class, 'index'])->name('formularios.index'); // Ruta para ver las solicitudes
    Route::post('/ruta-de-envio', [FormularioController::class, 'store']); // Ruta para enviar el formulario
    Route::patch('/formularios/{id}/status', [FormularioController::class, 'updateStatus'])->name('formularios.updateStatus'); // Ruta para actualizar el estado de la solicitud

    // Rutas para subir y descargar archivos
    Route::post('/formularios/upload', [FormularioController::class, 'upload'])->name('formularios.upload');
    Route::get('/formularios/download-liga/{id}', [FormularioController::class, 'downloadLigaDePago'])->name('formularios.downloadLigaDePago');
    Route::get('/formularios/download-comprobante/{id}', [FormularioController::class, 'downloadComprobanteAlumno'])->name('formularios.downloadComprobanteAlumno');
    Route::post('/formularios/upload-comprobante-alumno/{id}', [FormularioController::class, 'uploadComprobanteAlumno'])->name('formularios.uploadComprobanteAlumno'); // Nueva ruta añadida

    // Ruta para eliminar una solicitud
    Route::delete('/formularios/{id}', [FormularioController::class, 'destroy'])->name('formulario.destroy');
});

// Ruta para la vista de administración sin bloqueo de rol
Route::get('/admin/index', function () {
    $tables = \Illuminate\Support\Facades\DB::select('SHOW TABLES');
    $tables = array_map('current', $tables); // Convertir objetos stdClass a array simple
    return view('admin.index', compact('tables'));
})->name('admin.index');

Route::post('/admin/download-backup-database', [AdminController::class, 'downloadBackupDatabase'])->name('admin.download-backup-database');
Route::post('/admin/download-backup-table', [AdminController::class, 'downloadBackupTable'])->name('admin.download-backup-table');

// Rutas para la configuración de WhatsApp
Route::get('/admin/whatsapp-settings', [WhatsappSettingsController::class, 'edit'])->name('edit.whatsapp.settings');
Route::post('/admin/update-whatsapp-settings', [WhatsappSettingsController::class, 'update'])->name('update.whatsapp.settings');

// Ruta temporal sin autenticación para prueba
Route::get('/control_user_temp', [ControlUserController::class, 'index'])->name('control_user.index'); // Actualiza la ruta para usar el controlador y define el nombre

// Nuevas rutas para GestionSController
Route::get('/gestions', [GestionSController::class, 'index'])->name('gestions.index'); // Ruta para la vista principal
Route::get('/formularios/{id}', [GestionSController::class, 'show'])->name('formularios.show'); // Ruta para ver la solicitud
Route::patch('/formularios/{id}/status', [GestionSController::class, 'updateStatus'])->name('gestions.updateStatus'); // Corregida la ruta para actualizar el estado de la solicitud

// Rutas para la vista de finanzas sin protección de middleware
Route::get('/finanzas', [FinanzasUserController::class, 'index'])->name('finanzas.index');
Route::get('/finanzas/comprobantes/{id}', [FinanzasUserController::class, 'show'])->name('finanzas.show');
Route::get('/finanzas/comprobantes/subir', [FinanzasUserController::class, 'create'])->name('finanzas.create');
Route::post('/finanzas/comprobantes/subir', [FinanzasUserController::class, 'store'])->name('finanzas.store');

// Rutas para descargar archivos
Route::get('/finanzas/comprobantes/descargar-liga/{id}', [FinanzasUserController::class, 'downloadLigaDePago'])->name('finanzas.downloadLigaDePago');
Route::get('/finanzas/comprobantes/descargar-comprobante/{id}', [FinanzasUserController::class, 'downloadComprobanteAlumno'])->name('finanzas.downloadComprobanteAlumno');

// Rutas para FormularioController
Route::get('/download/comprobante/{id}', [FormularioController::class, 'downloadComprobante'])->name('formularios.downloadComprobante');

// Rutas para GestionSController
Route::get('/gestions/{id}', [GestionSController::class, 'show'])->name('gestions.show');
Route::get('/gestions/comprobante-alumno/{id}', [GestionSController::class, 'downloadComprobanteAlumno'])->name('gestions.downloadComprobanteAlumno');
Route::post('/gestions/upload-comprobante/{id}', [GestionSController::class, 'uploadComprobante'])->name('gestions.uploadComprobante');

// Ruta para la nueva vista ExpedienteSS
Route::get('/expediente', [FormularioController::class, 'expediente'])->name('formularios.expediente'); // Ruta para la nueva vista
Route::get('alumnos/search', [AlumnoController::class, 'search'])->name('alumnos.search');
// Rutas para descargar archivos_comprobante_oficial
Route::get('gestions/downloadComprobanteOficial/{id}', [GestionSController::class, 'downloadComprobanteOficial'])->name('gestions.downloadComprobanteOficial');
//ruta para revision
Route::get('finanzas/downloadComprobanteOficial/{id}', [App\Http\Controllers\FinanzasUserController::class, 'downloadComprobanteOficial'])->name('finanzas.downloadComprobanteOficial');
// Rutas para la vista de expedientes finalizados para control escolar
Route::get('control_user/expedientes-finalizados', [App\Http\Controllers\GestionSController::class, 'expedientesFinalizados'])->name('control_user.expedientesFinalizados');
Route::get('control_user/{id}', [App\Http\Controllers\GestionSController::class, 'show'])->name('control_user.show');
Route::get('gestions/downloadComprobante/{id}', [App\Http\Controllers\GestionSController::class, 'downloadComprobante'])->name('gestions.downloadComprobante');


Route::resource('/materias', App\Http\Controllers\MateriaController::class);
// Rutas para el controlador FormularioEController
Route::get('/formulario/{id}/edit', [FormularioEController::class, 'edit'])->name('formulario.edit');
Route::put('/formulario/{id}', [FormularioEController::class, 'update'])->name('formulario.update');





// Ruta para mostrar una solicitud específica
Route::get('/gestions/{id}', [GestionEController::class, 'show'])->name('gestions.gestionE');

// Ruta para actualizar el estado de una solicitud específica
Route::patch('/gestions/{id}/updateStatus', [GestionEController::class, 'updateStatus'])->name('gestions.updateStatus');

// Ruta para subir un comprobante para una solicitud específica
Route::post('/gestions/{id}/uploadComprobante', [GestionEController::class, 'uploadComprobante'])->name('gestions.uploadComprobante');

// Ruta para descargar un comprobante de una solicitud específica
Route::get('/gestions/{id}/downloadComprobante/{type}', [GestionEController::class, 'downloadComprobante'])->name('gestions.downloadComprobante');

Route::get('/control_user.index', [GestionEController::class, 'index'])->name('control_user.index');

// Ruta para la gestión de solicitudes
Route::get('/gestionS', [GestionSController::class, 'index'])->name('Control_user.GestionS');

