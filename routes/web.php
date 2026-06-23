<?php

use App\Http\Controllers\AsesorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LotificacionViewController;
use App\Http\Controllers\LotificacionReportController;
use App\Livewire\Lotificacion\LotificacionIndex;
use Illuminate\Support\Facades\Route;

// Página de inicio pública → Vista del Asesor
Route::get('/', [AsesorController::class, 'inicio'])->name('home');

// Vistas públicas del asesor (sin autenticación)
Route::get('asesor/lista',  [AsesorController::class, 'lista'])->name('asesor.lista');
Route::get('asesor/index',  [AsesorController::class, 'index'])->name('asesor.index');
Route::get('asesor/mapa',   [AsesorController::class, 'mapa'])->name('asesor.mapa');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'show'])->name('dashboard');

    Route::livewire('lotificacion', LotificacionIndex::class)
        ->middleware('role:asesor,oficina')
        ->name('lotificacion.index');

    Route::get('lotificacion/lista', [LotificacionViewController::class, 'lista'])
        ->middleware('role:asesor,oficina')
        ->name('lotificacion.lista');

    Route::get('lotificacion/mapa', [LotificacionViewController::class, 'mapa'])
        ->middleware('role:asesor,oficina')
        ->name('lotificacion.mapa');

    Route::get('lotificacion/reporte', [LotificacionReportController::class, 'showReport'])
        ->middleware('role:asesor,oficina')
        ->name('lotificacion.reporte');

    Route::get('lotificacion/reporte/descargar', [LotificacionReportController::class, 'downloadReport'])
        ->middleware('role:asesor,oficina')
        ->name('lotificacion.reporte.descargar');
});

require __DIR__.'/settings.php';
