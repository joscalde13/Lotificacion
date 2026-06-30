<?php

namespace App\Http\Controllers;

use App\Models\Lote;

class LotificacionViewController extends Controller
{
    public function lista()
    {
        $lotes = Lote::query()
            ->whereIn('estado', [Lote::ESTADO_VENDIDO, Lote::ESTADO_RESERVA, Lote::ESTADO_PENDIENTE_ENGANCHE])
            ->get()
            ->sortBy('codigo', SORT_NATURAL)
            ->values();

        return view('lotificacion.lista', [
            'lotes' => $lotes,
        ]);
    }

    public function mapa()
    {
        return view('lotificacion.mapa');
    }
}
