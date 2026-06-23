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
        $lotes = Lote::query()
            ->orderBy('codigo')
            ->get()
            ->mapWithKeys(fn (Lote $lote): array => [
                $lote->codigo => [
                    'codigo'      => $lote->codigo,
                    'estado'      => $lote->estado,
                    'color'       => $lote->color(),
                    'estado_label' => $lote->estadoLabel(),
                ],
            ])
            ->all();

        return view('VistaAsesor.lotificacion-index', [
            'lotes' => $lotes,
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
