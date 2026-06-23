<?php

namespace App\Http\Controllers;

use App\Models\Lote;

class DashboardController extends Controller
{
    public function show()
    {
        $grouped = Lote::query()
            ->selectRaw('estado, COUNT(*) as total')
            ->groupBy('estado')
            ->pluck('total', 'estado');

        $byEstado = [];
        $totalLotes = array_sum($grouped->map(fn ($value) => (int) $value)->all());

        foreach (Lote::LABELS as $estado => $label) {
            $totalEstado = (int) ($grouped[$estado] ?? 0);

            $byEstado[$estado] = [
                'label' => $label,
                'total' => $totalEstado,
                'percentage' => $totalLotes > 0
                    ? round(($totalEstado / $totalLotes) * 100, 1)
                    : 0,
                'color' => Lote::COLORS[$estado],
            ];
        }

        $lotesConAdquiriente = Lote::query()
            ->whereNotNull('nombre_adquiriente')
            ->count();

        $cambiosHoy = Lote::query()
            ->whereDate('fecha_cambio_estado', now()->toDateString())
            ->count();

        $ultimosCambios = Lote::query()
            ->whereNotNull('fecha_cambio_estado')
            ->orderByDesc('fecha_cambio_estado')
            ->limit(8)
            ->get(['codigo', 'estado', 'fecha_cambio_estado', 'nombre_adquiriente']);

        $pendientesRecientes = Lote::query()
            ->where('estado', Lote::ESTADO_PENDIENTE_ENGANCHE)
            ->orderByDesc('fecha_cambio_estado')
            ->limit(8)
            ->get(['codigo', 'fecha_cambio_estado', 'nombre_adquiriente']);

        return view('dashboard', [
            'totalLotes' => $totalLotes,
            'byEstado' => $byEstado,
            'lotesConAdquiriente' => $lotesConAdquiriente,
            'cambiosHoy' => $cambiosHoy,
            'ultimosCambios' => $ultimosCambios,
            'pendientesRecientes' => $pendientesRecientes,
        ]);
    }
}
