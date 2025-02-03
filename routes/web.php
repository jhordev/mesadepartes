<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExpedientesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AreasController;
use App\Http\Controllers\ExpedienteadminController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\ExpedientedetailsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\PreventBackHistory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

// ========================
// RUTAS PÚBLICAS
// ========================
Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/', [HomeController::class, 'store']);
    Route::get('/expedientes', [ExpedientesController::class, 'index'])->name('index');
    Route::post('/expedientes', [ExpedientesController::class, 'store'])->name('expedientes.store');
    Route::post('/expedientes/consultar', [ExpedientesController::class, 'consultarPorNumeroYClave'])
        ->name('expedientes.consultar');
    Route::get('/expediente/ver-pdf/{nombreDocumento}', [SeguimientoController::class, 'verPDF'])->name('expediente.verPDF');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

// ========================
// RUTAS DE AUTENTICACIÓN
// ========================
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ========================
// RUTAS PROTEGIDAS (Requieren Autenticación y Deshabilitan Caché)
// ========================
Route::middleware(['auth', PreventBackHistory::class])->group(function () {

    Route::get('/api/count-areas', [AreasController::class, 'countAreas'])->name('api.countAreas');
    Route::get('/api/count-users', [UsersController::class, 'countUsers'])->name('api.countUsers');
    Route::get('/api/count-expedientes', [ExpedienteadminController::class, 'countExpedientes'])->name('api.countExpedientes');
    Route::get('/api/count-expedientes-por-estado', [ExpedienteadminController::class, 'countExpedientesPorEstado'])->name('api.countExpedientesPorEstado');

    Route::get('/api/user/count-expedientes', [ExpedienteadminController::class, 'countUserExpedientes'])->name('api.user.countExpedientes');
    Route::get('/api/user/count-expedientes-pendientes', [ExpedienteadminController::class, 'countUserExpedientesPendientes'])->name('api.user.countExpedientesPendientes');
    Route::get('/api/user/count-expedientes-en-tramite', [ExpedienteadminController::class, 'countUserExpedientesEnTramite'])->name('api.user.countExpedientesEnTramite');
    Route::get('/api/user/count-expedientes-atendidos', [ExpedienteadminController::class, 'countUserExpedientesAtendidos'])->name('api.user.countExpedientesAtendidos');

    // ------------------------
    // Rutas comunes para todos los roles
    // ------------------------

    Route::get('/dashboard/perfil', [ProfileController::class, 'index'])->name('perfil.index');
    Route::get('/expedientes/{id}/detalle', [ExpedientedetailsController::class, 'detalle'])->name('expedientes.detalle');
    Route::post('/expedientes/{idExpediente}/actualizar-estado', [ExpedientedetailsController::class, 'actualizarEstado'])->name('expedientes.actualizarEstado');
    Route::post('/expedientes/{idExpediente}/actualizar-responsable', [ExpedientedetailsController::class, 'actualizarResponsable'])
        ->name('expedientes.actualizarResponsable');


    Route::get('/dashboard/expedientes/user', [ExpedienteadminController::class, 'expedientesPorResponsable'])
        ->name('expedientes.propios');
    Route::get('/expedientes/ver/{nombreDocumento}', [ExpedientedetailsController::class, 'verPDF'])->name('expedientes.ver');

    Route::get('/expedientes/exportar-excel', [ExpedienteadminController::class, 'exportarExcel'])
        ->name('expedientes.exportarExcel');

    Route::get('/documento/descargar/{nombreDocumento}', [ExpedientedetailsController::class, 'descargarDocumento'])
        ->name('documento.descargar');

    //SEGUIMIENTO
    Route::post('/seguimiento/{idExpediente}/agregar-basico', [SeguimientoController::class, 'agregarBasico'])->name('seguimiento.agregarBasico');

    Route::get('/seguimiento/ver-pdf/{nombreDocumento}', [SeguimientoController::class, 'verPDF'])->name('seguimientos.verPDF');

    // ------------------------
    // Rutas exclusivas para Admin (superadmin)
    // ------------------------
    Route::middleware(['can:admin-access'])->group(function () {
        Route::resource('/dashboard/expedientes', ExpedienteadminController::class)->only(['index']);

        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.inicio');


        Route::resource('dashboard/areas', AreasController::class)->only(['index', 'store', 'destroy', 'update']);
        Route::get('dashboard/areas/search', [AreasController::class, 'search'])->name('areas.search');


        Route::resource('dashboard/usuarios', UsersController::class)->only(['index','edit','destroy', 'store', 'update', 'search']);
        Route::get('/usuarios/search', [UsersController::class, 'search'])->name('usuarios.search');


    });

    // ------------------------
    // Rutas exclusivas para Usuario
    // ------------------------
    Route::middleware(['can:user-access'])->group(function () {
        Route::get('/usuario/dashboard/{area?}', function ($area = null) {
            return view('user.inicio', compact('area'));
        })->name('user.inicio');


    });
});
