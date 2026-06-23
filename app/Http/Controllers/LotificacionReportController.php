<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LotificacionReportController extends Controller
{
    use AuthorizesRequests;

    public function showReport()
    {
        $this->authorize('viewAny', Lote::class);

        $lotes = Lote::query()
            ->orderBy('codigo')
            ->get();

        $grouped = $lotes->groupBy('estado');

        $totales = [
            'total' => $lotes->count(),
            'disponible' => $grouped->get(Lote::ESTADO_DISPONIBLE, collect())->count(),
            'vendido' => $grouped->get(Lote::ESTADO_VENDIDO, collect())->count(),
            'reserva' => $grouped->get(Lote::ESTADO_RESERVA, collect())->count(),
            'pendiente_enganche' => $grouped->get(Lote::ESTADO_PENDIENTE_ENGANCHE, collect())->count(),
        ];

        return view('lotificacion.reporte', [
            'lotes' => $lotes,
            'grouped' => $grouped,
            'totales' => $totales,
        ]);
    }

    public function downloadReport()
    {
        $this->authorize('viewAny', Lote::class);

        $lotes = Lote::query()
            ->orderBy('codigo')
            ->get();

        $grouped = $lotes->groupBy('estado');

        $totales = [
            'total' => $lotes->count(),
            'disponible' => $grouped->get(Lote::ESTADO_DISPONIBLE, collect())->count(),
            'vendido' => $grouped->get(Lote::ESTADO_VENDIDO, collect())->count(),
            'reserva' => $grouped->get(Lote::ESTADO_RESERVA, collect())->count(),
            'pendiente_enganche' => $grouped->get(Lote::ESTADO_PENDIENTE_ENGANCHE, collect())->count(),
        ];

        $pdf = Pdf::loadView('lotificacion.reporte-pdf', [
            'lotes' => $lotes,
            'grouped' => $grouped,
            'totales' => $totales,
        ])
            ->setPaper('a4', 'landscape')
            ->setOption('margin-top', 10)
            ->setOption('margin-right', 10)
            ->setOption('margin-bottom', 10)
            ->setOption('margin-left', 10);

        return $pdf->download('reporte-lotificacion-'.now('America/Guatemala')->format('d-m-Y').'.pdf');
    }
}
