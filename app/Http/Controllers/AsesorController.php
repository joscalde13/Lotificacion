<?php

namespace App\Http\Controllers;

use App\Models\Lote;

class AsesorController extends Controller
{
    /**
     * Página de inicio del asesor (selección de vistas).
     */
    public function inicio()
    {
        return view('VistaAsesor.inicio');
    }

    /**
     * Lista de lotes (vendidos, reserva, pendiente de enganche).
     */
    public function lista()
    {
        $lotes = Lote::query()
            ->whereIn('estado', [Lote::ESTADO_VENDIDO, Lote::ESTADO_RESERVA, Lote::ESTADO_PENDIENTE_ENGANCHE])
            ->orderBy('codigo')
            ->get();

        return view('VistaAsesor.lista', [
            'lotes' => $lotes,
        ]);
    }

    /**
     * Listado interactivo de todos los lotes con colores por estado.
     */
    public function index()
    {
        $filteredLotes = Lote::query()
            ->get()
            ->sortBy('codigo', SORT_NATURAL)
            ->mapWithKeys(fn (Lote $lote): array => [
                $lote->codigo => [
                    'codigo'      => $lote->codigo,
                    'estado'      => $lote->estado,
                    'color'       => $lote->color(),
                    'estado_label' => $lote->estadoLabel(),
                ],
            ])
            ->all();

        $groupedLotes = [];
        foreach ($filteredLotes as $codigo => $lote) {
            preg_match('/[a-zA-Z]+/', (string) $codigo, $matches);
            $letter = strtoupper($matches[0] ?? '#');
            $groupedLotes[$letter][$codigo] = $lote;
        }
        ksort($groupedLotes);

        return view('VistaAsesor.lotificacion-index', [
            'groupedLotes' => $groupedLotes,
        ]);
    }

    /**
     * Vista del mapa / plano PDF.
     */
    public function mapa()
    {
        return view('VistaAsesor.mapa');
    }
}
