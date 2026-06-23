<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LotificacionViewController;
use App\Http\Controllers\LotificacionReportController;
use App\Livewire\Lotificacion\LotificacionIndex;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login')->name('home');

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
